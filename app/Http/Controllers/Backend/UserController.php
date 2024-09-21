<?php  
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use App\Repositories\User\UserRepository;


class UserController extends Controller{

    protected $userService;
    protected $userRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
    ){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }


    public function index(){

        $users = $this->userService->paginate();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('backend.user.user.index', compact(
            'config',
            'users'
        ));
    }

    public function create(){

        $userCatalogues = [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Collaborator'],
        ];
       

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

        $userCatalogues = [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Collaborator'],
        ];
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $config['method'] = 'edit';
        return view('backend.user.user.save', compact(
            'config',
            'userCatalogues',
            'user'
        ));
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
            ]
        ];
        return $breadcrumb[$key];
    }

    private function config(){
        return [
            'css' => [
                'backend/css/plugins/switchery/switchery.css'
            ],
            'js' => [
                'backend/js/plugins/switchery/switchery.js'
            ],
            'model' => 'user'
        ];
    }

}