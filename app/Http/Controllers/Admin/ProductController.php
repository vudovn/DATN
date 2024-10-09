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
                'name' => 'Danh sách sản phẩm',
                'list' => ['Danh sách sản phẩm']
            ],
            'create' => [
                'name' => 'Tạo sản phẩm',
                'list' => ['QL sản phẩm', 'Tạo sản phẩm'] 
            ],
            'update' => [
                'name' => 'Cập nhật sản phẩm',
                'list' => ['QL sản phẩm', 'Cập nhật sản phẩm']
            ],
            'delete' => [
                'name' => 'Xóa sản phẩm',
                'list' => ['QL sản phẩm', 'Xóa sản phẩm']
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
