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
            $cart = $this->cartRepository->findByField('user_id', $payload['user_id'])->get();
            $found = false;
            foreach ($cart as $value) {
                if ($value->sku === $payload['sku']) {
                    $value->quantity += $payload['quantity'];
                    $value->save();
                    $found = true;
                    break;
                }
            }
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
            $payload = $request->except(['_token', 'send', '_method', 'idCart']);
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
    public function getCart($carts){
        $products = [];
        foreach ($carts as $key => $value) {
            $data = $this->productRepository->findByField('sku', $value->sku)->first();
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $value->sku)->first();
            }
            $products[] = $data;
        }
        return $products;
    }
    public function fetchCartData($carts){
        $products = [];
        $total = 0;
        foreach ($carts as $value) {
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
            $cart[] = $data;
            $total += ($data->price - ($data->price * $data->discount) / 100) * $data->quantityCart;
        }
        return ['cart' => $cart, 'total' => $total];
    }
    public function getProduct($item)
    {
        if (isset($item)) {
            $data = $this->productRepository->findByField('sku', $item->sku)->first();
            if (isset($data)) {
                $data->idCart = $item->id ?? "";
                $data->quantityCart = $item->quantity ?? '';
            }
            if (empty($data)) {
                $data = $this->productVariantRepository->findByField('sku', $item->sku)->first();
                $data->idCart = $item->id ?? '';
                $data->quantityCart = $item->quantity ?? '';
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
        }
        return $data;
    }
 
    public function getTotalCart($carts){
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

}
