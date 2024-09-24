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


    private function paginateAgrument($request){
        return [
            'keyword' => [
                'search' => $request->input('keyword'),
                'field' => ['name', 'email', 'phone', 'address']
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
                'user_catalogue_id' => $request->integer('user_catalogue_id'),
            ],
            'sort' => $request->input('sort') 
                ? array_map('trim', explode(',', $request->input('sort')))  
                : ['id', 'desc'],
            'perpage' => $request->integer('perpage') ?? 20,
        ];
    }

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        $users = $this->userRepository->pagination($agruments);
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