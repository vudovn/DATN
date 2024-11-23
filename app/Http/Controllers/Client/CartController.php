<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepository;
use App\Services\Cart\CartService;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use App\Repositories\Product\ProductVariantRepository;

class CartController extends Controller
{
    protected $cartRepository;
    protected $cartService;
    protected $productRepository;

    protected $productService;
    protected $productVariantRepository;

    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
        ProductRepository $productRepository,
        ProductService $productService,
        ProductVariantRepository $productVariantRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        $cart = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $products = [];
        foreach ($cart as $key => $value) {
            $data = $this->productRepository->findByField('sku', $value->sku)->first();
            if (isset($data)) {
                $data->idCart = $value->id ?? "";
            }
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $value->sku)->first();
                $data->idCart = $value->id ?? '';
                $data->discount = $data->product->discount ?? '';
                $data->name = $data->product->name ?? '';
                $data->slug = $data->product->slug ?? '';
                $data->thumbnail = explode(',', json_decode($data->albums))[0] ?? '';
                $category = $data->product->categories->where('is_room', 2)->first();
                $data->category = $category ? strtolower($category->name) : '';
            }
            $products[] = $data;
        }
        return view('client.pages.cart.index', compact('config', 'products'));
    }
    public function count()
    {
        $data = $this->cartRepository->findByField('user_id', Auth::id());
        return $data;
    }
    public function store(Request $request)
    {
        $data = $this->cartService->create($request);
    }
    public function remove(Request $request)
    {
        $this->cartService->delete($request->id);
    }
    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/cart.css',
                'client_asset/custom/css/checkbox.css',
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                "client_asset/custom/js/cart/cart.js",
            ],
            'model' => 'cart'
        ];
    }

    private function breadcrumb()
    {
        return [
            "detail" => [
                "title" => "Product Detail",
                "url" => route('client.product.detail')
            ]
        ];
    }


}
