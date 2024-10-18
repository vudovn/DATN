<?php  
namespace App\Services\Order;
use App\Services\BaseService;
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
                'search' => $request->input('keyword'),
                'field' => ['created_at']
            ],
            'condition' => [
                'status' => $request->input('publish') == 0 ? 0 : $request->input('publish'),
            ],
            'sort' => $request->input('sort') 
                ? array_map('trim', explode(',', $request->input('sort')))  
                : ['id', 'desc'],
            'perpage' => $request->integer('perpage') ?? 20,
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
            $result = $this->orderRepository->update($id, $payload);
            // User::create($data); chạy oke
            // Role::create($user); chạy lỗi mọe trất
            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
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