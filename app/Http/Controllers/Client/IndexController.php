<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Slide\SlideRepository;
use App\Repositories\Product\ProductRepository;

class IndexController extends Controller
{
    protected $categoryRepository;
    protected $slideRepository;
    protected $productRepository;
    public function __construct(
        CategoryRepository $categoryRepository,
        SlideRepository $slideRepository,
        ProductRepository $productRepository,
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->slideRepository = $slideRepository;
        $this->productRepository = $productRepository;
    }

    public function home()
    {
        $categoryRoom = $this->categoryRepository->getCategoryRoom();
        $slides = $this->slideRepository->getAll();
        $product_featureds = $this->productRepository->getFeatured();
        $product_bestsellers = $this->productRepository->getBestsellers();
        $config = $this->config();
        return view('client.pages.home.index', compact(
            'categoryRoom',
            'config',
            'slides',
            'product_featureds',
            'product_bestsellers'
        ));

    }

    public function about()
    {
        $config = $this->config();
        return view('client.pages.about.index', compact('config'));
    }
    public function contact()
    {
        $config = $this->config();
        return view('client.pages.contact.index', compact('config'));
    }
    private function config()
    {
        return [
            'css' => [
                "client_asset/custom/css/about.css",
                "client_asset/custom/css/contact.css",
                "client_asset/custom/css/color.css",
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                "client_asset/custom/js/home.js",
            ],
            'model' => ''
        ];
    }
}
