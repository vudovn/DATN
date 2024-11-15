<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Wishlist\WishlistService;
use App\Repositories\Wishlist\WishlistRepository;
use App\Models\User;

class WishlistController extends Controller
{
    protected $wishlistService;
    protected $wishlistRepository;

    public function __construct(WishlistService $wishlistService, WishlistRepository $wishlistRepository)
    {
        $this->wishlistService = $wishlistService;
        $this->wishlistRepository = $wishlistRepository;
    }

    public function index(Request $request)
    {
        $config = $this->config();
        $user = User::with('wishlists.products')->find(1);
    
        $products = [];
        foreach ($user->wishlists as $wishlist) {
            // dd($wishlist);
        }
        return view('client.pages.wishlist.wish_list', compact(
            'config',
            'products'
        ));
    }
    

    public function add(Request $request)
    {
        // dd($request->all());
        $userId = $request->user()->id;
        if ($this->wishlistService->addWishlist($userId, $request->product_id)) {
            return successResponse(null, 'Đã thêm sản phẩm vào mục yêu thích');
        }
        return errorResponse();
    }

    public function delete(Request $request)
    {
        $userId = $request->user()->id;
        if ($this->wishlistService->removeWishlist($userId, $request->product_id)) {
            return successResponse(null, 'Đã xóa sản phẩm ra khỏi mục yêu thích');
        }
        return errorResponse();
    }

    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/wishlist.css'
            ],
            'js' => [
                'client_asset/custom/js/wishlist.js'
            ],
            'model' => 'user'
        ];
    }
}
