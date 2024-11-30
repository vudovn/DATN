<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Slide\SlideRepository;

class IndexController extends Controller
{
    protected $categoryRepository;
    protected $slideRepository;
    public function __construct(CategoryRepository $categoryRepository, SlideRepository $slideRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->slideRepository = $slideRepository;
    }

    public function home()
    {
        $categoryRoom = $this->categoryRepository->getCategoryRoom();
        $slides = $this->slideRepository->getAll();
        $config = $this->config();
        return view('client.pages.home.index', compact(
            'categoryRoom',
            'config',
            'slides'
        ));

    }

    public function about()
    {
        return view('client.pages.about.index');
    }

    private function config()
    {
        return [
            'css' => [],
            'js' => [
                "client_asset/custom/js/home.js",
            ],
            'model' => ''
        ];
    }
}
