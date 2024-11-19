<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Repositories\Order\OrderRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Product\ProductRepository;

class DashboardController extends Controller
{
    protected $orderService;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    public function __construct(
        OrderService $orderService,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderRepository $orderRepository
    ) {
        $this->orderService = $orderService;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }


    public function index()
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        $statistic = $this->orderService->orderStatistic();
        $statistic['total_customer'] = $this->userRepository->totalCustomer();
        $statistic['total_product'] = $this->productRepository->totalProduct();
        return view('admin.pages.dashboard.index', compact(
            'config',
            'statistic'
        ));
    }

    public function getOrdersAndRevenueByYear()
    {
        $year = now()->year;
        $orders = $this->orderRepository->ordersAndRevenueByYear($year);
        return successResponse($orders);
    }





    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Thống kê',
                'list' => ['Thống kê']
            ],
        ];
        return $breadcrumb[$key];
    }

    private function config()
    {
        return [
            'css' => [],
            'js' => [
                'https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js',
                'admin_asset/library/dashboard.js'
            ]
        ];
    }

}