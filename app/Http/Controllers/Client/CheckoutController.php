<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepository;
use App\Services\Cart\CartService;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Discount\DiscountCodeRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;
use App\Services\User\UserService;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CheckoutController extends Controller
{
    protected $cartRepository;
    protected $cartService;
    protected $productRepository;
    protected $productService;
    protected $productVariantRepository;
    protected $discountCodeRepository;
    protected $order;
    protected $userService;
    protected $userRepository;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;
    protected $categoryRepository;

    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
        ProductRepository $productRepository,
        ProductService $productService,
        ProductVariantRepository $productVariantRepository,
        DiscountCodeRepository $discountCodeRepository,
        UserService $userService,
        UserRepository $userRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository,
        CategoryRepository $categoryRepository,
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        if(Auth::id()){
            $user = $this->userRepository->findById(Auth::id());
        }
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $products = [];
        $total = 0;
        foreach ($carts as $key => $value) {
            $data = $this->productRepository->findByField('sku', $value->sku)->first();
            if (isset($data)) {
                $data->quantityCart = $value->quantity ?? '';
            }
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $value->sku)->first();
                $data->discount = $data->product->discount;
                $data->name = $data->product->name;
                $data->quantityCart = $value->quantity;
                if (isset($data->albums) && !empty($data->albums)) {
                    $albums = json_decode($data->albums, true);
                    if (isset($albums) && !empty($albums)) {
                        $data->thumbnail = explode(',', $albums)[0] ?? '';
                    }
                }
            }
            $products[] = $data;
            $total += ($data->price - ($data->price * $data->discount) / 100) * $data->quantityCart;
        }
        $provinces = $this->provinceRepository->getAllProvinces();
        $districts = $this->districtRepository->getAllDistricts();
        $wards = $this->wardRepository->getAllWards();
        $config = $this->config();
        $address = $order->address ?? $order->user->address ?? '';
        return view('client.pages.cart.checkout', compact(
            'user',
            'provinces',
            'districts',
            'wards',
            'address',
            'products',
            'total',
            'config'
        ));
    }
    private function config()
    {
        return [
            'css' => [
                
            ],
            'js' => [
                'admin_asset/library/location.js',
                "client_asset/custom/js/cart/checkout.js",
            ],
            'model' => 'checkout'
        ];
    }
}
