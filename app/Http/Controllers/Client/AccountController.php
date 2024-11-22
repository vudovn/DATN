<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;

class AccountController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;

    function __construct(
        UserRepository $userRepository,
        UserService $userService,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    public function index()
    {
        $config = $this->config();
        $user = $this->userRepository->findById(auth()->id(), ['province', 'district', 'ward']);
        $provinces = $this->provinceRepository->getAllProvinces();
        return view('client.pages.account.index', compact('user', 'provinces', 'config'));
    }

    public function editAccount(Request $request)
    {
        $user = $this->userService->update($request, auth()->id());
        if ($user) {
            return successResponse(null, 'Cập nhật tài khoản thành công');
        }
        return errorResponse('Cập nhật tài khoản thất bại');
    }


    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/account.css'
            ],
            'js' => [
                'client_asset/custom/js/account.js',
                'admin_asset/library/location.js'
            ],
            'model' => 'user'
        ];
    }
}
