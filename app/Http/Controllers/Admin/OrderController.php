<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\StoreOrderRequest;
use App\Http\Requests\order\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Location\ProvinceRepository;
use App\Services\Order\OrderService;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Traits\HasDynamicMiddleware;

class OrderController extends Controller  implements HasMiddleware
{
    use HasDynamicMiddleware;
    public static function middleware(): array
    {
        return self::getMiddleware('Order'); 
    }
    protected $order;
    protected $orderService;
    protected $orderRepository;
    protected $provinceRepository; 

    public function __construct(
        Order $order,
        OrderService $orderService,
        OrderRepository $orderRepository,
        ProvinceRepository $provinceRepository, 
        )
    {
        $this->order = $order;
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
        $this->provinceRepository = $provinceRepository; 
    }

    public function index(Request $request) 
    {
        $orders = $this->orderService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.order.index', compact(
            'orders',
            'config'
        ));
    }
    public function getData($request)
    {
        $orders = $this->orderService->paginate($request);
        $config = $this->config();
        return view('admin.pages.order.components.table',compact('orders','config'));
    }

    public function create()
    {
        $provinces = $this->provinceRepository->getAllProvinces();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';

        $user = User::all();
        return view('admin.pages.order.create', compact(
            'provinces',
            'config'
        ));
    }

    public function store(Request $request) {
        $order = $this->orderService->create($request);
        if ($order) {
            return redirect()->route('order.index')->with('success', 'Tạo đơn hàng mới thành công');
        } 
        return redirect()->route('order.index')->with('Error', 'Tạo đơn hàng mới thất bại');
    }

    public function edit(string $id){
        $order = $this->orderRepository->findById($id, ['orderDetails']);
        $order_details = $order->orderDetails;
        $provinces = $this->provinceRepository->getAllProvinces();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        return view('admin.pages.order.edit', compact(
            'order', 
            'order_details',
            'provinces',
            'config'
        ));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        // dd( $request->all());
    
        $result = $this->orderService->update($request, $id);

        if($result){
            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công.');
        }else{
            return  redirect()->route('order.index')->with('error', 'Cập nhật đơn hàng thất bại');
        }
    }

    public function updatePaymentStatus(Request $request, $id) {
        $result = $this->orderService->updatePaymentStatus($request, $id);
        if($result){
            return successResponse();
        }else{
            return errorResponse();
        }
    }

    
    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Danh sách đơn hàng',
                'list' => ['Danh sách đơn hàng']
            ],
            'update' => [
                'name' => 'Cập nhật trạng thái đơn hàng',
                'list' => ['QL đơn hàng', 'Cập nhật trạng thái']
            ],
            'create' => [
                'name' => 'Tạo đơn hàng mới',
                'list' => ['QL đơn hàng', 'Tạo đơn hàng']
            ]
        ];

        return $breadcrumb[$key]; 
        }

        private function config(){
            return [
                'css' => [
                ],
                'js' => [
                    'admin_asset/library/location.js', 
                    'admin_asset/library/order.js'
                ],
                'model' => 'order'
            ];
        }
}


