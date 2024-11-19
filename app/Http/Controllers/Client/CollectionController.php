<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Repositories\Collection\CollectionRepository;
class CollectionController extends Controller
{
    protected $collectionRepository;
    public function __construct(
        CollectionRepository $collectionRepository
        )   
    {
        $this->collectionRepository = $collectionRepository;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        $collections = successResponse(Collection::all())->getData()->data;
        return view('client.pages.collection.index', compact('config','collections'));
    }
    public function detail($slug)
    {
        $config = $this->config();
        $collection =$this->collectionRepository->findByField('slug',$slug)->first();
        // $idProduct = $collection->products()->pluck('id')->toArray();
        // $products = $collection->products()->whereIn('id', $idProduct)->get();
        // return view('client.pages.collection.detail', compact('config','collection','products'));
        return view('client.pages.collection.detail', compact('config','collection'));
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
