<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Services\Collection\CollectionService;
use App\Repositories\Collection\CollectionRepository;
use App\Repositories\Collection\CollectionProductRepository;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductRepository;
class CollectionController extends Controller
{
    protected $collectionService;
    protected $collectionRepository;
    protected $collectionProductRepository;
    protected $productVariantRepository;
    protected $productRepository;
    public function __construct(
        CollectionService $collectionService,
        CollectionRepository $collectionRepository,
        CollectionProductRepository $collectionProductRepository,
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
    ) {
        $this->collectionService = $collectionService;
        $this->collectionRepository = $collectionRepository;
        $this->collectionProductRepository = $collectionProductRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        $collections = successResponse(Collection::all())->getData()->data;
        return view('client.pages.collection.index', compact('config', 'collections'));
    }
    public function detail($slug)
    {
        $config = $this->config();
        $collection = $this->collectionRepository->findByField('slug', $slug)->first();
        $id_collections = $this->collectionProductRepository->findByField('collection_id', $collection->id)->get();
        $products = $this->collectionService->getDetail($id_collections);
        return view('client.pages.collection.detail', compact('config', 'collection', 'products'));
    }
    public function list(Request $request)
    {
        $collections = successResponse(Collection::all())->getData()->data;
        return $collections;
    }

    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/collection.css',
                'client_asset/custom/css/cart.css',
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                'client_asset/custom/js/collection.js'
            ],
            'model' => 'collection'
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
