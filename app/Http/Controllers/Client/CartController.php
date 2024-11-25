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
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $products = $this->cartService->fetchCartData($carts)['cart'];
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
        $itemCart = $this->cartRepository->findById($request->id);
        $zIndex = 1000 - $itemCart->id;
        $product = $this->cartService->getProduct($itemCart);
        return view('client.pages.cart.components.item', compact('product', 'carts', 'zIndex'))->render();
    }
    public function count()
    {
        $data = $this->cartRepository->findByField('user_id', Auth::id())->get();
        return count($data);
    }
    public function store(Request $request)
    {
        $data = $this->cartService->create($request);
        if ($data) {
            return successResponse('', 'Thêm sản phẩm vào giỏ hàng thành công');
        }
        return errorResponse('Thêm sản phẩm vào giỏ hàng thất bại');
    }
    public function remove(Request $request)
    {
        $data = $this->cartService->delete($request->id);
        if ($data) {
            return successResponse('', 'xoá sản phẩm thành công');
        }
        return errorResponse('xoá sản phẩm thất bại');
    }
    public function changeVariant(Request $request)
    {
        $id = $request->idCart;
        $data = $this->cartService->update($request, $id);
        if ($data) {
            return successResponse($id, 'Đổi phân loại thành công');
        }
        return errorResponse('Đổi phân loại thất bại');
    }
    public function updateQuantity(Request $request)
    {
        $id = $request->idCart;
        $data = $this->cartService->update($request, $id);
        if ($data) {
            return successResponse('', 'Cập nhật số lượng');
        }
        return errorResponse('Cập nhật số lượng thất bại');
    }


    public function totalCart(Request $request)
    {
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $total = $this->cartService->getTotalCart($carts);
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
}
