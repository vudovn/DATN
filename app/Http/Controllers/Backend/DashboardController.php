<?php  
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

    public function __contruct(

    ){

    }


    public function index(){


        $config = $this->config();
        return view('backend.dashboard.index', compact(
            'config'
        ));
    }

    private function config(){
        return [
            'css' => [],
            'js' => [] 
        ];
    }

}