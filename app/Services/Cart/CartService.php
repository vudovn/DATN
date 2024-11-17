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
    protected $ProductVariantRepository;

    public function __construct(
        CartRepository $cartRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        ProductRepository $ProductVariantRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->ProductVariantRepository = $ProductVariantRepository;
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
            // $payload = $request->except(['_token', 'send']);
            $payload = $request->all();
            $payload['user_id'] = Auth::id();
            $payload['quantity'] = (int) $payload['quantity'];
            $payload['id'] = (int) $payload['id'];
            $payload['price'] = (int) $payload['price'];
            $payload['total_price'] = (int) $payload['price'] * $payload['quantity'];
            $product = $this->productRepository->findByField('sku', $payload['sku'])->first();
            dd($payload);

            dd($payload);
            $cart = $this->cartRepository->create($payload);
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
            $comment = $this->commentRepository->update($id, $payload);
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
            $this->commentRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log($e);
            return false;
        }
    }
}
