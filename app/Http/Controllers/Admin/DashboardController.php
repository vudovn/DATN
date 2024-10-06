<?php  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

    public function __contruct(

    ){

    }


    public function index(){

        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.dashboard.index', compact(
            'config'
        ));
    }

    private function breadcrumb($key){
        $breadcrumb = [
            'index' => [
                'name' => 'Dashboard',
                'list' => []
            ],
        ];
        return $breadcrumb[$key];
    }

    private function config(){
        return [
            'css' => [],
            'js' => [] 
        ];
    }

}