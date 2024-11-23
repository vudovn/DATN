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
use App\Repositories\Discount\DiscountCodeRepository;

class CartController extends Controller
{
    protected $cartRepository;
    protected $cartService;
    protected $productRepository;

    protected $productService;
    protected $productVariantRepository;
    protected $discountCodeRepository;

    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
        ProductRepository $productRepository,
        ProductService $productService,
        ProductVariantRepository $productVariantRepository,
        DiscountCodeRepository $discountCodeRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->productVariantRepository = $productVariantRepository;
        $this->discountCodeRepository = $discountCodeRepository;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $products = [];
        foreach ($carts as $key => $value) {
            $data = $this->productRepository->findByField('sku', $value->sku)->first();
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $value->sku)->first();
                $products[] = $data;
            }
        }
        return view('client.pages.cart.index', compact('config', 'products'));
    }
    public function listCart(Request $request)
    {
        $data = $this->cartRepository->findByField('user_id', Auth::id())->get();
        return $data;
    }
    public function getProduct(Request $request)
    {
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $z = 1000;
        $cart = $this->cartRepository->findById($request->id);
        if (isset($cart)){
            $zIndex = $z - $cart->id;
        $data = $this->productRepository->findByField('sku', $cart->sku)->first();
        if (isset($data)) {
            $data->idCart = $cart->id ?? "";
            $data->quantityCart = $cart->quantity ?? '';
        }
        if (empty($data)) {
            $data = $this->productVariantRepository->findByField('sku', $cart->sku)->first();
            $data->idCart = $cart->id ?? '';
            $data->quantityCart = $cart->quantity ?? '';
            $data->discount = $data->product->discount ?? '';
            $data->name = $data->product->name ?? '';
            $data->slug = $data->product->slug ?? '';
            if (isset($data->albums) && !empty($data->albums)) {
                $albums = json_decode($data->albums, true);
                if (isset($albums) && !empty($albums)) {
                    $data->thumbnail = explode(',', $albums)[0] ?? '';
                }
            }
            $category = $data->product->categories->where('is_room', 2)->first();
            $data->category = $category ? strtolower($category->name) : '';
        }
        $product = $data;
        return view('client.pages.cart.components.item', compact('product', 'carts', 'zIndex'))->render();
    }
    }
    public function count()
    {
        $data = $this->cartRepository->findByField('user_id', Auth::id())->get();
        return count($data);
    }
    public function store(Request $request)
    {
        $data = $this->cartService->create($request);
    }
    public function remove(Request $request)
    {
        $this->cartService->delete($request->id);
    }
    public function changeVariant(Request $request)
    {
        $id = $request->idCart;
        $data = $this->cartService->update($request, $id);
        return $id;
    }
    public function updateQuantity(Request $request)
    {
        $id = $request->idCart;
        $data = $this->cartService->update($request, $id);
    }
    public function addDiscount(Request $request)
    {
        $code = $request->code;
        $discountCode = $this->discountCodeRepository->findByField('code', $code)->first();
        if ($discountCode && strcmp($discountCode->code, $code) === 0) {
            if (checkExpiredDate($discountCode->end_date)) {
                return false;
            } else {
                return $discountCode;
            }
        }
    }
    public function applyDiscount(Request $request)
    {
        $codes = $request->code;
        foreach ($codes as $code) {
            $discountCode = $this->discountCodeRepository->findByField('code', $code)->first();
            if ($discountCode && strcmp($discountCode->code, $code) === 0) {
                if (checkExpiredDate($discountCode->end_date)) {
                    return false;
                } else {
                    $data[] = $discountCode;
                }
            }
        }
        return $data;
    }
    public function totalCart(Request $request)
    {
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $total = 0;
        foreach ($carts as $value) {
            $data = $this->productRepository->findByField('sku', $value->sku)->first();
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $value->sku)->first();
            }
            $discount = $data->discount ?? $data->product->discount;
            $total += ((int) $data->price - ((int) $data->price * $discount) / 100) * (int) $value->quantity;
        }
        return $total;
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
