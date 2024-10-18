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
            'perpage' => $request->integer('perpage') ?? 20,
        ];
    }

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        // dd($agruments);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        
        $users = $this->userRepository->pagination($agruments);
        return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', 're_password']);
            $payload['password'] = Hash::make($request->password);
            $user = $this->userRepository->create($payload);
            // dd($user); //thử cái này xem nó có ra 1 cục không
            // nó ra 1 cục rồi thì syncRoles luôn
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
        
        // thêm nhiều dữ liệu vào nhiều bảng khác nhau
        // ví dụ : tạo mới user và gắn quyền cho hắn 
        // tạo user xong rồi mà gắn quyền hắn lỗi trất
                // User::create($data); chạy oke
                // Role::create($user); chạy lỗi mọe trất
        // Là thằn user nó được tạo trong bảng Users rồi nhưng trong bảng Roles thì chưa có quyền của thằn user đó 
        // => lỗi :v, mất dữ liệu
        // => giải pháp : dùng transaction => Đảm bảo toàn vẹn dữ liệu
        // đang chạy trong 1 transaction, nếu có lỗi thì rollback lại hết (reset lại như chưa từng chạy)
        // Try Catch để bắt lỗi
            // Bất kể lỗi gì xảy ra trong try thì nó sẽ tự động chạy vào catch
        DB::beginTransaction();  
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $user = $this->userRepository->update($id, $payload); //cái ni nó trả về true, false

            // tìm user rồi add role cho hắn
            $findUser = $this->userRepository->findById($id);

            if ($request->has('roles')) {
                $findUser->syncRoles($request->input('roles')); // Đồng bộ vai trò
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