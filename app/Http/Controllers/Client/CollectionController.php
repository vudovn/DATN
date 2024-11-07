<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
class CollectionController extends Controller
{
    protected $productRepository;
    public function __construct(
        ProductRepository $productRepository
        )
    {
        $this->productRepository = $productRepository;
    }
    public function index(request $request)
    {
        $config = $this->config();
        return view('client.pages.collection.index', compact('config'));
    }

    public function detail($slug)
    {
        $config = $this->config();
        return view('client.pages.product_detail.index', compact(
            'config'
        ));
    }

    public function getComment($product_id)
    {
        $product = $this->productRepository->findById($product_id, ['comments'], ['name'] );
        $comments = $product->comments;
        return successResponse($comments);
    }


    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/collection.css'
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                'client_asset/custom/js/comment_review.js'
            ],
            'model' => 'product'
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
