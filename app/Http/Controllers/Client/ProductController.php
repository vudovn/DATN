<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(request $request)
    {
        return view('client.pages.product.index');
    }

    public function detail($slug)
    {
        $config = $this->config();
        return view('client.pages.product_detail.index', compact(
            'config'
        ));
    }

    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/product_detail.css'
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                
            ],
            'model' => 'product'
        ];
    }


}
