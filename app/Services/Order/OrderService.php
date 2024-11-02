<?php
namespace App\Services\Order;
use App\Services\BaseService;
use App\Models\OrderDetail;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderDetailsRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class OrderService extends BaseService
{

    protected $orderRepository;
    protected $orderDetailsRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailsRepository $orderDetailsRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
    }


    private function paginateAgrument($request)
    {
        return [
            'keyword' => [
                'search' => $request['keyword'] ?? '',
                'field' => ['created_at', 'code', 'total'],
            ],
            'condition' => [
                'status' => $request->input('publish') == 0 ? 0 : $request->input('publish'),
            ],
            'sort' => isset($request['sort']) && $request['sort'] != 0
                ? explode(',', $request['sort'])
                : ['id', 'asc'],
            'perpage' => (int) (isset($request['perpage']) && $request['perpage'] != 0 ? $request['perpage'] : 10),
        ];
    }

    public function paginate($request)
    {
        $agruments = $this->paginateAgrument($request);
        // dd($agruments);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->orderRepository->pagination($agruments);
        return $users;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $storeOrder = $this->storeOrder($request);
            $storeOrderDetail = $this->storeOrderDetail($request, $storeOrder);
            //lỗi ở đây
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            // $this->log($e);
            // return false;
        }
    }

    private function storeOrder($request)
    {
        $payload = $request->only(['name', 'phone', 'email', 'province_id', 'district_id', 'ward_id', 'address', 'note', 'status', 'payment_status', 'total_amount', 'fee_ship']);
        $payload['total'] = $this->filterPrice($payload['total_amount']);
        $payload['code'] = orderCode();
        $payload['user_id'] = auth()->user()->id;
        return $this->orderRepository->create($payload);
    }

    private function storeOrderDetail($request, $storeOrder)
    {
        $payload = $request->only('quantity', 'sku', 'product_id', 'name_orderDetail', 'price');
        $result = [];
        foreach ($payload['sku'] as $key => $value) {
            $result[] = [
                'order_id' => $storeOrder->id,
                'product_id' => (int) $payload['product_id'][$key],
                'sku' => $value,
                'name' => $payload['name_orderDetail'][$key],
                'quantity' => (int) $payload['quantity'][$key],
                'price' => (float) $payload['price'][$key],

            ];
        }
        // dd($result);

        $check = $this->orderDetailsRepository->insert($result);
        return $check;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method', 'quantity']);
            dd($payload);

            $result = $this->orderRepository->update($id, $payload);

            foreach ($request['quantity'] as $detailId => $quantity) {
                $this->orderDetailsRepository->update($detailId, [
                    'quantity' => $quantity,
                ]);
                // $orderDetail = OrderDetail::find($detailId);
                // if ($orderDetail) {
                //     $orderDetail->quantity = $quantity;
                //     $orderDetail->save();
                // }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            $this->log($e);
            // return false;
        }
    }

    public function updatePaymentStatus($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            // dd($payload);
            $result = $this->orderRepository->update($id, $payload);
            // dd($result);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log($e);
            // return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->orderRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }



}