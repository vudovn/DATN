<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Repositories\Order\OrderRepository;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    protected $order;

    protected $orderService;

    protected $orderRepository;

    public function __construct(
        Order $order,
        OrderService $orderService,
        OrderRepository $orderRepository
        )
    {
        $this->order = $order;
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
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
    public function edit(string $id){
        $order = $this->orderRepository->findById($id, ['orderDetails']);
        $order_details = $order->orderDetails;
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        return view('admin.pages.order.edit', compact(
            'order', 
            'order_details',
            'config'
        ));
    }
    public function update(Request $request, $id)
    {
        
        // Tạo 1 cái file request để valid dữ liệu
        // Không viết validate trong controller

        $request->validate([
            'status' => 'required|in:pending,shipped,processing,cancelled,delivered', 
        ]);
    
        $result = $this->orderService->update($request, $id);

        if($result){
            return redirect()->route('admin.pages.order.index')->with('success', 'Cập nhật đơn hàng thành công.');
        }else{
            return  redirect()->route('admin.pages.order.index')->with('error', 'Cập nhật đơn hàng thất bại');
        }
        
        // $order = Order::find($id);
        
        // if (!$order) {
        //     return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        // }

    
        // $order->status = $request->status;
        // $order->save(); 
    
        // return redirect()->route('admin.pages.order.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
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
            ]
        ];

        return $breadcrumb[$key] ?? null; 
        }

        private function config(){
            return [
                'css' => [
                ],
                'js' => [
                ],
                'model' => 'order'
            ];
        }
}


