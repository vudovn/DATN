<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function index(request $request)
    {
        $config = $this->config();
        dd(successResponse($this->collectionRepository));
        return view('client.pages.collection.index', compact('config'));
    }




    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/collection.css'
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
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
