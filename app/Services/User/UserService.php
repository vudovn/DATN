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
            //lỗi ở đây
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
        
        // thêm nhiều dữ liệu vào nhiều bảng khác nhau
        // ví dụ : tạo mới user và gắn quyền cho hắn 
        // tạo user xong rồi mà gắn quyền hắn lỗi trất
                // User::create($data); chạy oke
                // Role::create($user); chạy lỗi mọe trất
        // Là thằn user nó được tạo trong databsae rồi nhưng trong bảng role thì chưa có quyền của thằn user đó 
        // => lỗi :v, mất dữ liệu
        // => giải pháp : dùng transaction
        // đang chạy trong 1 transaction, nếu có lỗi thì rollback lại hết (reset lại như chưa từng chạy)
        
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $user = $this->userRepository->update($id, $payload);
            // User::create($data); chạy oke
            // Role::create($user); chạy lỗi mọe trất
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