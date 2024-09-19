<?php  
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\User\UserService;


class UserController extends Controller{

    protected $userService;

    public function __construct(
        UserService $userService
    ){
        $this->userService = $userService;
    }


    public function index(){

        $users = $this->userService->paginate();
        $breadcrumb['name'] = 'User Management';
        $breadcrumb['list'] = ['User', 'List'];
        $config = $this->config();
        return view('backend.user.user.index', compact(
            'config',
            'breadcrumb',
            'users'
        ));
    }

    public function create(){

        $userCatalogues = [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Collaborator'],
        ];
        $breadcrumb['name'] = 'Create User';
        $breadcrumb['list'] = ['User', 'Create User'];
        return view('backend.user.user.create', compact(
            'breadcrumb',
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

    private function config(){
        return [
            'css' => [
                'backend/css/plugins/switchery/switchery.css'
            ],
            'js' => [
                'backend/js/plugins/switchery/switchery.js'
            ] 
        ];
    }

}