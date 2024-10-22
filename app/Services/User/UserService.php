<?php  
namespace App\Services\User;
use App\Services\BaseService;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



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
                'field' => ['name', 'email', 'phone', 'address','created_at'] //Muốn tìm kiếm thêm cột nào thì điền vào
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
            ],
            'sort' => $request->input('sort') 
                ? array_map('trim', explode(',', $request->input('sort')))  
                : ['id', 'desc'],
            'perpage' => $request->integer('perpage') ?? 10,
        ];
    }

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        // dd($agruments);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->userRepository->pagination($agruments);
        return $users;
    }

    public function paginationCustomer($request){
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->userRepository->paginationCustomer($agruments);
        return $users;
    }
    public function paginationAdmin($request){
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->userRepository->paginationAdmin($agruments);
        return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', 're_password']);
            $payload['password'] = Hash::make($request->password);
            $user = $this->userRepository->create($payload);
            if ($request->has('roles')) {
                $user->syncRoles($request->input('roles')); // Đồng bộ vai trò
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();die();
            // $this->log($e);
            // return false;
        }
    }

    public function update($request, $id){
        DB::beginTransaction();  
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $user = $this->userRepository->update($id, $payload); 
            $findUser = $this->userRepository->findById($id);
            $findUser->syncRoles($request->input('roles')); // Đồng bộ vai trò
    
            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            echo $e->getMessage();die();
            // $this->log($e);
            // return false;
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