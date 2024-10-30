<?php  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller{

    public function __contruct(

    ){

    }


    public function index(){

        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        // data total - ân
        $totalOrder = Order::count();
        $totalReview = Review::count();
        $totalUser = User::count();
        $totalProduct = Product::count();
        // data total - ân
        return view('admin.pages.dashboard.index', compact(
            'config',
            'totalOrder',
            'totalUser',
            'totalProduct',
            'totalReview'
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