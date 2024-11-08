<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\StoreOrderRequest;
use App\Http\Requests\order\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Location\ProvinceRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;
use App\Services\Order\OrderService;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Traits\HasDynamicMiddleware;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;

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
    protected $districtRepository; 
    protected $wardRepository; 
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        Order $order,
        OrderService $orderService,
        OrderRepository $orderRepository,
        ProvinceRepository $provinceRepository, 
        DistrictRepository $districtRepository,
        WardRepository $wardRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        )
    {
        $this->order = $order;
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
        $this->provinceRepository = $provinceRepository; 
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository =  $productRepository;
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
        $districts = $this->districtRepository->getAllDistricts();
        $wards = $this->wardRepository->getAllWards();
        $categories = $this->categoryRepository->findByField('is_room', 2)->pluck('name', 'id')->prepend('Danh mục', 0)->toArray();
        $categoryRoom = $this->categoryRepository->findByField('is_room', 1)->pluck('name', 'id')->prepend('Phòng', 0)->toArray();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';

        $user = User::all();
        return view('admin.pages.order.create', compact(
            'provinces',
            'districts',
            'wards',
            'config',
            'categories',
            'categoryRoom'
        ));
    }

    public function store(StoreOrderRequest $request) {

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
        $districts = $this->districtRepository->getAllDistricts();
        $wards = $this->wardRepository->getAllWards();
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $address = $order->address ?? $order->user->address ?? '';
        return view('admin.pages.order.edit', compact(
            'order', 
            'order_details',
            'provinces',
            'districts',
            'wards',
            'address',
            'config'
        ));
    }

    public function update(UpdateOrderRequest $request, $id) {
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

    public function dataProduct(){
        $products = Product::all();
        return successResponse($products);
    }

    public function dataVariantsProduct($id) {
        $product = $this->productRepository->findById($id, ['productVariants']);
        return successResponse($product->productVariants);
    }

    public function searchCustomer(Request $request) {
        $phone = $request->get('phone');
        $customer = Order::where('phone', $phone)->first();
    
        if ($customer) {
            $latestOrder = Order::where('phone', $phone)
                                ->orderBy('created_at', 'desc')
                                ->first();
            if ($latestOrder) {
                $location = [
                    'province' => $latestOrder->province_id,
                    'district' => $latestOrder->district_id,
                    'ward' => $latestOrder->ward_id,
                ];
            }
            $new = [
                'success' => true,
                'customer' => [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'address' => $customer->address,
                    'province_id' => $customer->province_id,
                    'district_id' => $customer->district_id,
                    'ward_id' => $customer->ward_id,
                    'location' => $location ?? null, 
                ],
            ];
            return successResponse($new);
        }
        return errorResponse('Không tìm thấy khách hàng');
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
                    'admin_asset/css/order.css'
                ],
                'js' => [
                    'admin_asset/library/location.js', 
                    'admin_asset/library/order.js'
                ],
                'model' => 'order'
            ];
        }
}


