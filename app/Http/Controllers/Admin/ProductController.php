<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use App\Repositories\Attribute\AttributeRepository;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productService;
    protected $attributeRepository;
    function __construct(
        ProductRepository $productRepository,
        ProductService $productService,
        AttributeRepository $attributeRepository
    ){
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->attributeRepository = $attributeRepository;
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
        $attributes = $this->attributeRepository->getAll();
        // dd($attributes);
        return view('admin.pages.product.product.save', compact(
            'config',
            'attributes'
        ));
    }

    public function store(Request $request){
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
                'admin_asset\plugins\nice-select\css\nice-select.css',
                'https://unpkg.com/slim-select@latest/dist/slimselect.css'
            ],
            'js' => [
                'admin_asset/library/attribute.js',
                'admin_asset/library/variant.js',
                'admin_asset\plugins\nice-select\js\jquery.nice-select.min.js',
                'https://unpkg.com/slim-select@latest/dist/slimselect.min.js'
            ],
            'model' => 'product'
        ];
    }
}
