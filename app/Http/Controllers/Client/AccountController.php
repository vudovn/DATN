<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;
use App\Repositories\Order\OrderRepository;
use App\Services\Order\OrderService;

class AccountController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;
    protected $orderRepository;
    protected $orderService;

    function __construct(
        UserRepository $userRepository,
        UserService $userService,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository,
        OrderRepository $orderRepository,
        OrderService $orderService
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $config = $this->config();
        $user = $this->userRepository->findById(auth()->id(), ['province', 'district', 'ward']);
        $provinces = $this->provinceRepository->getAllProvinces();
        $orderAll = $this->orderRepository->getOrdersByUser(auth()->id());
        $orderCompleted = $this->orderRepository->getOrdersByStatus(auth()->id(), 'completed');
        $orderCancelled = $this->orderRepository->getOrdersByStatus(auth()->id(), 'cancelled');
        $orderPending = $this->orderRepository->getOrdersByStatus(auth()->id(), 'pending');
        $orderShipping = $this->orderRepository->getOrdersByStatus(auth()->id(), 'shipping');
        $orderReturn = $this->orderRepository->getOrdersByStatus(auth()->id(), 'return');
        return view('client.pages.account.index', compact(
            'user',
            'provinces',
            'config',
            'orderAll',
            'orderCompleted',
            'orderCancelled',
            'orderPending',
            'orderShipping',
            'orderReturn'
        ));
    }


    public function editAccount(Request $request)
    {
        $user = $this->userService->update($request, auth()->id());
        if ($user) {
            $dataUser = $this->userRepository->findById(auth()->id(), ['province', 'district', 'ward']);
            return successResponse($this->renderHtml($dataUser), 'Cập nhật tài khoản thành công');
        }
        return errorResponse('Cập nhật tài khoản thất bại');
    }

    public function changePassAccount(Request $request)
    {
        $checkOldPassword = $this->userService->checkOldPassword($request->password_old, auth()->id());
        if (!$checkOldPassword) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không đúng'
            ]);
        }
        $result = $this->userService->changePassword($request, auth()->id());
        if ($result) {
            return successResponse('', 'Đổi mật khẩu thành công');
        }
        return errorResponse('Đổi mật khẩu thất bại');
    }

    private function renderHtml($dataUser)
    {
        return "
            <ul>
                <li><strong>Tên:</strong> <span class='account_name'>{$dataUser->name}</span></li>
                <li><strong>Số điện thoại:</strong> <span class='account_phone'>{$dataUser->phone}</span></li>
                <li><strong>Email:</strong> <span class='account_email'>{$dataUser->email}</span></li>
                <li><strong>Địa chỉ:</strong> 
                    {$dataUser->ward->name}, {$dataUser->district->name}, {$dataUser->province->name}
                </li>
            </ul>
        ";
    }

    public function getOrderAll(Request $request)
    {
        $orders = $this->orderService->paginate($request);
        $paginate = true;
        return successResponse(view('client.pages.account.components.api.orderItem', compact('orders', 'paginate'))->render());
    }

    public function getOrderByStatus(Request $request, $status)
    {
        $orders = $this->orderRepository->getOrdersByStatus(auth()->id(), $status, 4);
        $paginate = false;
        return successResponse(view('client.pages.account.components.api.orderItem', compact('orders', 'paginate'))->render());
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
