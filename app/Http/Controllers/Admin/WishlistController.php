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
        $user = User::with('wishlists.product')->find(1);
        // dd($products);
        // foreach ($user->wishlists as $wishlist) {
        //     dd($wishlist);
        // }
        return view('client.pages.wishlist.wish_list', compact(
            'config',
            'user'
        ));
    }
    
    public function add(Request $request)
    {
        $user = auth()->user();
        $productId = $request->input('product_id');

        $wishlist = $user->wishlists()->where('product_id', $productId)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['message' => 'Sản phẩm đã được xoá khỏi danh sách yêu thích.']);
        } else {
            $user->wishlists()->create(['product_id' => $productId]);
            return response()->json(['message' => 'Sản phẩm đã được thêm vào danh sách yêu thích.']);
        }
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
