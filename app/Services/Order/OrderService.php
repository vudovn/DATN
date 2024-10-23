<?php  
namespace App\Services\Order;
use App\Services\BaseService;
use App\Models\OrderDetail;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class OrderService extends BaseService {

    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    ){
        $this->orderRepository = $orderRepository;
    }


    private function paginateAgrument($request){
        return [
            'keyword' => [
               'search' => $request['keyword'] ?? '',
                'field' => ['created_at','code','total'],
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

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        // dd($agruments);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        
        $users = $this->orderRepository->pagination($agruments);
        return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', 're_password']);
            $payload['password'] = Hash::make($request->password);
            $user = $this->orderRepository->create($payload);
            //lỗi ở đây
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();die();
            // $this->log($e);
            return false;
        }
    }

    public function update($request, $id) {
        DB::beginTransaction();  
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            // dd($payload);
            
            $result = $this->orderRepository->update($id, $payload);
    
            foreach ($payload['quantity'] as $detailId => $quantity) {
                $orderDetail = OrderDetail::find($detailId);
                if ($orderDetail) {
                    $orderDetail->quantity = $quantity;
                    $orderDetail->save();
                }
            }
    
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log($e);
            // return false;
        }
    }
    

    public function delete($id){
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