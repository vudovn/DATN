<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Attribute\AttributeCategoryRepository;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Product\ProductVariantRepository;
class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $attributeCategoryRepository;
    protected $attributeRepository;
    protected $productVariantRepository;
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        AttributeCategoryRepository $attributeCategoryRepository,
        AttributeRepository $attributeRepository,
        ProductVariantRepository $productVariantRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->attributeCategoryRepository = $attributeCategoryRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function index()
    {
        return view('client.pages.product.index');
    }

    public function detail($slug)
    {
        $config = $this->config();
        $product = $this->productRepository->findByWhereIn('slug', [$slug], ['categories', 'productVariants'], )->first();
        if ($product->has_attribute == 1) {
            $product = $this->getAttribute($product);
        }
        return view('client.pages.product_detail.index', compact(
            'config',
            'product'
        ));
    }

    private function getAttribute($product)
    {
        $attributeCategoryId = array_keys($product->attribute);
        $attrCategory = $this->attributeCategoryRepository->findByWhereIn('id', $attributeCategoryId, ['attributes'], ['id', 'name']);
        $attributeId = array_merge(...$product->attribute);
        $attrs = $this->attributeRepository->findByWhereIn('id', $attributeId, [], ['id', 'value', 'attribute_category_id']);
        if (!is_null($attrCategory)) {
            foreach ($attrCategory as $key => $value) {
                $newData = [];
                foreach ($attrs as $attr) {
                    if ($value->id == $attr->attribute_category_id) {
                        $newData[] = $attr;
                    }
                }
                $value->attributes = $newData;
            }
        }
        $product->attribute_category = $attrCategory;
        return $product;
    }

    public function getVariant(Request $request)
    {
        $attribute_id = $request->attribute_id;
        sort($attribute_id, SORT_NUMERIC);
        $attribute_id = implode(', ', $attribute_id);
        $variant = $this->productVariantRepository->findVariant($request->product_id, $attribute_id);
        $product = $this->productRepository->findById($request->product_id, ['productVariants'], ['albums', 'name', 'discount']);
        $variant->name = $product->name;
        $variant->discount = $product->discount;
        $variant->albums = view('client.pages.product_detail.components.api.albums', compact('variant', 'product'))->render();
        return successResponse($variant);
    }


    public function getComment($product_id)
    {
        $product = $this->productRepository->findById($product_id, ['comments'], ['name']);
        $comments = $product->comments;
        return successResponse($comments);
    }

    public function searchProduct(Request $request)
    {
        $products = $this->productRepository->searchProduct($request->q);
        $categories = $this->categoryRepository->searchCategory($request->q);
        $data = [
            'products' => $products,
            'categories' => $categories
        ];
        return successResponse($data);
    }


    private function config()
    {
        return [
            'css' => [
                'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.css',
                'client_asset/custom/css/product_detail.css',
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                'client_asset/custom/js/product/comment_review.js',
                'client_asset/custom/js/product/attribute.js',
                // 'client_asset/custom/js/product/attribute_hex.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js',
            ],
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
