<?php  
namespace App\Services\User;
use App\Services\BaseService;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;


class UserService extends BaseService {

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function paginate(){
       $users = $this->userRepository->pagination();
       return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', 're_password']);
            $user = $this->userRepository->create($payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }

    public function update($request, $id){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $user = $this->userRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $this->userRepository->delete($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }



}