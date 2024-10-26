<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use App\Repositories\Attribute\AttributeCategoryRepository;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Traits\HasDynamicMiddleware;
class ProductController extends Controller implements HasMiddleware
{
    use HasDynamicMiddleware;
    public static function middleware(): array
    {
        return self::getMiddleware('Product'); 
    }
    protected $productRepository;
    protected $productService;
    protected $attributeCategoryRepository;
    function __construct(
        ProductRepository $productRepository,
        ProductService $productService,
        AttributeCategoryRepository $attributeCategoryRepository
    ){
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->attributeCategoryRepository = $attributeCategoryRepository;
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
    public function getData($request)
    {
        $products = $this->productService->paginate($request);
        $config = $this->config();
        return view('admin.pages.product.product.components.table',compact('products','config'));
    }
    public function create(){
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        $attributes = $this->attributeCategoryRepository->getAll();
        $categories = $this->categories();
        // dd($attributes);
        return view('admin.pages.product.product.save', compact(
            'config',
            'attributes',
            'categories'
        ));
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required|not_in:0',
            'category_id' => 'required|array|min:1|not_in:0',
            'category_id.*' => 'required',
            'attributes' => 'required'
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Giá sản phẩm không được để trống',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'category.required' => 'Danh mục không được để trống',
            'category.not_in' => 'Danh mục không hợp lệ',
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.min' => 'Danh mục không hợp lệ',
            'category_id.*.required' => 'Danh mục không được để trống',
        ]);
        // dd($request->all());
    }

    public function categories () {
        return [
            [
                'id' => 1,
                'name' => 'Giường',
                'parent_id' => 0,
                'is_room' => 2
            ],
            [
                'id' => 2,
                'name' => 'Phòng khách',
                'parent_id' => 0,
                'is_room' => 1
            ],
            [
                'id' => 3,
                'name' => 'Phòng Ngủ',
                'parent_id' => 0,
                'is_room' => 1
            ],
            [
                'id' => 4,
                'name' => 'Ghế',
                'parent_id' => 0,
                'is_room' => 2
            ],
            [
                'id' => 5,
                'name' => 'Tủ',
                'parent_id' => 0,
                'is_room' => 2
            ]
        ];
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
                
                'admin_asset/library/variant.js',
                'admin_asset\plugins\nice-select\js\jquery.nice-select.min.js',
                'https://unpkg.com/slim-select@latest/dist/slimselect.min.js'
            ],
            'model' => 'product'
        ];
    }
    public function dataProduct(){
        $products = Product::all();
        return response()->json($products);
    }
    
}
