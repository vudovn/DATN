<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Slide\SlideService;
use App\Repositories\Slide\SlideRepository;
use App\Repositories\Collection\CollectionRepository;


class settingController extends Controller
{
    protected $sliderService;
    protected $sliderRepository;
    protected $collectionRepository;
    function __construct(
        SlideService $sliderService,
        SlideRepository $sliderRepository,
        CollectionRepository $collectionRepository
    ) {
        $this->sliderService = $sliderService;
        $this->sliderRepository = $sliderRepository;
        $this->collectionRepository = $collectionRepository;
    }


    public function index()
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.setting.index', compact(
            'config'
        ));
    }

    public function slide()
    {
        $config = $this->config();
        $config['model'] = 'collection';
        $config['js'] = [
            'admin_asset/library/slide.js'
        ];
        $config['breadcrumb'] = $this->breadcrumb('slider');

        $slides = $this->sliderRepository->getAll();
        $collections = $this->collectionRepository->getAll();
        return view('admin.pages.setting.slide', compact(
            'config',
            'slides',
            'collections'
        ));
    }

    public function sliderUpdate(Request $request)
    {
        $data = $request->all();
        $this->sliderService->update($data);
        return redirect()->route('setting.slide')->with('success', 'Cập nhật thành công');
    }

    public function banner()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function footer()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function social()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function contact()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function email()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function seo()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function payment()
    {
        return successResponse(null, 'Đang phát triển');
    }

    public function config()
    {
        return [
            'css' => [
            ],
            'js' => [

            ],
            'model' => 'setting',
        ];
    }

    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Cài đặt hệ thống',
                'list' => ['Cài đặt hệ thống']
            ],
            'slider' => [
                'name' => 'Quản lý slider',
                'list' => ['Quản lý slider']
            ],

            'create' => [
                'name' => 'Tạo người dùng',
                'list' => ['QL người dùng', 'Tạo người dùng']
            ],
            'update' => [
                'name' => 'Cập nhật người dùng',
                'list' => ['QL người dùng', 'Cập nhật người dùng']
            ],
            'delete' => [
                'name' => 'Xóa người dùng',
                'list' => ['QL người dùng', 'Xóa người dùng']
            ]
        ];
        return $breadcrumb[$key];
    }

}
