<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;
use DB;
class ProductRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        Product $model
    ) {
        $this->model = $model;
    }
    public function filterProduct(array $params = [])
    {
        return $this->model
            ->relation($params['relation'] ?? [], $this->model)
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            // ->orderBy($params['sort'][0], $params['sort'][1])
            ->paginate($params['perpage'])
        ;
    }

    public function filterProductClient(array $params = [])
    {
        $query = $this->model //Model = Product
            ->condition($params['condition'] ?? [])
            ->keyword($params['keyword'] ?? [])
            ->orderBy($params['sort'][0], $params['sort'][1]);
        if (!empty($params['category_id'])) {
            $query->whereHas('categories', function ($q) use ($params) {
                $q->where('category_id', $params['category_id']);
            });
        }

        // Lọc theo danh sách attribute_id nếu có
        // bảng product_variant_attribute chứa attribute_id và product_variant_id
        // bảng product_variant chứa product_id
        if (!empty($params['attribute_id']) && is_array($params['attribute_id'])) {
            $query->whereHas('productVariants.productVariantAttributes', function ($q) use ($params) {
                $q->whereIn('attribute_id', $params['attribute_id']);
            });
        }


        return $query->paginate($params['perpage']);
    }

    public function totalProduct()
    {
        return $this->model->count();
    }

    public function searchProduct($keyword)
    {
        return $this->model
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('sku', 'like', '%' . $keyword . '%');
            })
            ->where('publish', 1)
            ->get();
    }
    public function getFeatured()
    {
        return $this->model->where('is_featured', 1)->where('publish', 1)->get();
    }
    public function getBestsellers()
    {
        $products = DB::table('products')
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(
                'products.id',
                'products.name',
                'products.thumbnail',
                'products.slug',
                'products.sku',
                'products.short_content',
                'products.price',
                'products.discount',
                'products.albums',
                DB::raw('SUM(CASE WHEN orders.status = "delivered" THEN order_details.quantity ELSE 0 END) as total_quantity'),
                DB::raw('SUM(CASE WHEN orders.status = "delivered" THEN order_details.quantity * order_details.price ELSE 0 END) as total_revenue')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.thumbnail',
                'products.slug',
                'products.sku',
                'products.short_content',
                'products.price',
                'products.discount',
                'products.albums'
            )
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get();

        return $products;
    }

    public function updateQuantity($product_id, $quantity)
    {
        return $this->model->where('id', $product_id)->update(['quantity' => DB::raw('quantity - ' . $quantity)]);
    }


    // Lấy sản phẩm liên quan
    public function getRelatedProduct($product_id, $category_id)
    {
        return $this->model
            ->where('id', '!=', $product_id)
            ->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id);
            })
            ->inRandomOrder()
            ->take(6)
            ->get();
    }

}
