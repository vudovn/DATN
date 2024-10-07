<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productService;
    function __construct(
        ProductRepository $productRepository,
        ProductService $productService
    ){
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }
    public function index (Request $request) {
        $products = $this->productService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.product.product.index', compact(
            'config',
            'products'
        ));
    }

    public function create(){
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        return view('admin.pages.product.product.save', compact(
            'config'
        ));
    }

    public function store(Request $request){
        // $request->validate([
        //     'content'=> 'required',
        // ]);
        dd($request->all());
    }

    private function breadcrumb($key){
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý người dùng',
                'list' => ['Người dùng', 'Danh sách']
            ],
            'create' => [
                'name' => 'Tạo sản phẩm',
                'list' => ['product', 'create product'] 
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
            'model' => 'product'
        ];
    }
}
