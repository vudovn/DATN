<?php  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserCatalogueRepository;

use Illuminate\Support\Facades\Redis;




class UserController extends Controller{

    protected $userService;
    protected $userRepository;
    protected $userCatalogueRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        UserCatalogueRepository $userCatalogueRepository,
    ){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }


    public function index(Request $request){ 

        $users = $this->userService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');

        $userCatalogues = $this->userCatalogueRepository->getAll();
        
        return view('admin.pages.user.user.index', compact(
            'config',
            'userCatalogues',
            'users',
        ));
    }

    public function create(){
        $userCatalogues = $this->userCatalogueRepository->getAll();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        return view('admin.pages.user.user.save', compact(
            'config',
            'userCatalogues'
        ));
    }

    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success', 'Tạo người dùng mới thành công');
        }
        return  redirect()->route('user.index')->with('error', 'Tạo người dùng mới thất bại');
    }

    public function update(UpdateUserRequest $request, $id){
        if($this->userService->update($request, $id)){
            return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công.');
        }
        return  redirect()->route('user.index')->with('error', 'Cập nhật người dùng thất bại');
    }


    public function edit($id){
       
        $user  = $this->userRepository->findById($id);       
        $userCatalogues = $this->userCatalogueRepository->getAll();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $config['method'] = 'edit';
        return view('admin.pages.user.user.save', compact(
            'config',
            'userCatalogues',
            'user'
        ));
    }

    public function delete($id){

        $user = $this->userRepository->findById($id);

        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('delete');
        $config['method'] = 'delete';
        return view('admin.pages.user.user.delete', compact(
            'config',
            'user'
        ));
    }

    public function destroy($id){
        if($this->userService->delete($id)){
            return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
        }
        return  redirect()->route('user.index')->with('error', 'Xóa người dùng thất bại');
    }

    private function breadcrumb($key){
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý người dùng',
                'list' => ['Người dùng', 'Danh sách']
            ],
            'create' => [
                'name' => 'Tạo người dùng',
                'list' => ['User', 'Create User']
            ],
            'update' => [
                'name' => 'Update User',
                'list' => ['User', 'Update User']
            ],
            'delete' => [
                'name' => 'Delete User',
                'list' => ['User', 'Delete User']
            ]
        ];
        return $breadcrumb[$key];
    }

    private function config(){
        return [
            'css' => [
            ],
            'js' => [
            ],
            'model' => 'user'
        ];
    }

}