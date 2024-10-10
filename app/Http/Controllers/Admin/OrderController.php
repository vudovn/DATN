<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index() 
    {
        // $orders = Order::all();
        $orders = Order::paginate(10);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.order.index', compact(
            'orders',
            'config'
        ));
    }
    public function edit(string $id){
        $order = Order::findOrFail($id);
        $order_details = OrderDetails::where('order_id', $id)->get();
        return view('admin.pages.order.edit', compact('order', 'order_details'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipping,completed,cancelled,delivered', 
        ]);
    
        $order = Order::find($id);
        
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }
    
        $order->status = $request->status;
        $order->save(); 
    
        return redirect()->route('admin.pages.order.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
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


