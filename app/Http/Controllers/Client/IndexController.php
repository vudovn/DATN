<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;

class IndexController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function home()
    {
        $categoryRoom = $this->categoryRepository->getCategoryRoom();
        return view('client.pages.home.index',compact(
            'categoryRoom',
        ));
    }
}
