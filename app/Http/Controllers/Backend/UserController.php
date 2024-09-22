<?php  
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserCatalogueRepository;


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
    

        return view('backend.user.user.index', compact(
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
        return view('backend.user.user.save', compact(
            'config',
            'userCatalogues'
        ));
    }

    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            flash()->success('Update Successfully.');
            return redirect()->route('user.index');
        }

        flash()->error('An issue occurred, Please try again');
        return  redirect()->route('user.index');
    }

    public function update(UpdateUserRequest $request, $id){
        if($this->userService->update($request, $id)){
            flash()->success('Update Successfully.');
            return redirect()->route('user.index');
        }
        flash()->error('An issue occurred, Please try again');
        return  redirect()->route('user.index');
    }


    public function edit($id){
       
        $user  = $this->userRepository->findById($id);       

        $userCatalogues = $this->userCatalogueRepository->getAll();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $config['method'] = 'edit';
        return view('backend.user.user.save', compact(
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
        return view('backend.user.user.delete', compact(
            'config',
            'user'
        ));
    }

    public function destroy($id){
        if($this->userService->delete($id)){
            flash()->success('Delete Successfully.');
            return redirect()->route('user.index');
        }
        flash()->error('An issue occurred, Please try again');
        return  redirect()->route('user.index');
    }

    private function breadcrumb($key){
        $breadcrumb = [
            'index' => [
                'name' => 'User Management',
                'list' => ['User', 'List']
            ],
            'create' => [
                'name' => 'Create User',
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
                'backend/css/plugins/switchery/switchery.css',
                'backend/css/plugins/sweetalert/sweetalert.css'
            ],
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'backend/js/plugins/sweetalert/sweetalert.min.js'
            ],
            'model' => 'user'
        ];
    }

}