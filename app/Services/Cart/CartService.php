<?php

namespace App\Services\Cart;

use App\Services\BaseService;
use App\Repositories\Cart\CartRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductVariantRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\ForbiddenWord;


class CartService extends BaseService
{
    protected $cartRepository;
    protected $userRepository;
    protected $productRepository;
    protected $productVariantRepository;

    public function __construct(
        CartRepository $cartRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    private function paginateAgrument($request)
    {
        return [
            'keyword' => [
                'search' => $request['keyword'] ?? '',
                'field' => ['content']
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
            ],
            'sort' => isset($request['sort']) && $request['sort'] != 0
                ? explode(',', $request['sort'])
                : ['id', 'asc'],
            'perpage' => $request->integer('perpage') ?? 20,
        ];
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send']);
            $payload['user_id'] = Auth::id();
            $payload['quantity'] = (int) $payload['quantity'];
            $payload['id'] = (int) $payload['id'];
            $payload['price'] = (int) $payload['price'];
            // Tìm giỏ hàng của người dùng
            $cart = $this->cartRepository->findByField('user_id', $payload['user_id'])->get();
            // Biến cờ để kiểm tra sản phẩm đã tồn tại hay chưa
            $found = false;
            foreach ($cart as $value) {
                if ($value->sku === $payload['sku']) {
                    // Nếu sản phẩm đã tồn tại, cộng dồn số lượng
                    $value->quantity += $payload['quantity'];
                    $value->save();
                    $found = true; // Đánh dấu đã xử lý
                    break; // Thoát khỏi vòng lặp sau khi tìm thấy
                }
            }
            // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
            if (!$found) {
                $this->cartRepository->create($payload);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
        }
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $comment = $this->cartRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log($e);
            return false;
        }
    }



    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->cartRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log($e);
            return false;
        }
    }
}
