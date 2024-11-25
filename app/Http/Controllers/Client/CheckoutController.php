<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepository;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use App\Repositories\User\UserRepository;
use App\Repositories\Discount\DiscountCodeRepository;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    protected $cartRepository;
    protected $cartService;
    protected $orderService;
    protected $userRepository;
    protected $discountCodeRepository;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;

    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
        OrderService $orderService,
        UserRepository $userRepository,
        DiscountCodeRepository $discountCodeRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository,
    ) {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
        $this->discountCodeRepository = $discountCodeRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        if(Auth::id()){
            $user = $this->userRepository->findById(Auth::id());
        }
        $carts = $this->cartRepository->findByField('user_id', Auth::id())->get();
        $products = $this->cartService->fetchCartData($carts)['cart'];
        $total = $this->cartService->fetchCartData($carts)['total'];
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
    public function addDiscount(Request $request)
    {
        $discountCode = $this->discountCodeRepository->findByField('code', $request->code)->first();
        return successResponse(($discountCode && !checkExpiredDate($discountCode->end_date)) ? $discountCode : false);
    }

    public function applyDiscount(Request $request)
    {
        $data = [];
        foreach ($request->code as $code) {
            $discountCode = $this->discountCodeRepository->findByField('code', $code)->first();
            if ($discountCode && !checkExpiredDate($discountCode->end_date)) {
                $data[] = $discountCode;
            }
        }
        return $data;
    }
    public function store(Request $request) {

        $order = $this->orderService->create($request);
        if ($order) {
            return redirect()->route('order.index')->with('success', 'Tạo đơn hàng mới thành công');
        } 
        return redirect()->route('order.index')->with('Error', 'Tạo đơn hàng mới thất bại');
    }
    private function config()
    {
        return [
            'css' => [
                
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                'admin_asset/library/location.js',
                "client_asset/custom/js/cart/checkout.js",
            ],
            'model' => 'checkout'
        ];
    }
}
