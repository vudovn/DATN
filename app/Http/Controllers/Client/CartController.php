<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use App\Services\Cart\CartService;
class CartController extends Controller
{
    protected $cartRepository;
    protected $cartService;
    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
        )   
    {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        return view('client.pages.cart.index',compact('config'));
    }
    public function store(Request $request)
    {
        $data = $this->cartService->create($request);
    }
    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/cart.css',
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
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
