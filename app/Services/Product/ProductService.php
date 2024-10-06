<?php  
namespace App\Services\Product;
use App\Services\BaseService;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class ProductService extends BaseService {

    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ){
        $this->productRepository = $productRepository;
    }


    private function paginateAgrument($request){
        return [
            'keyword' => [
                'search' => $request->input('keyword'),
                'field' => ['name', 'sku', 'description', 'price']
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
                // 'user_catalogue_id' => $request->integer('user_catalogue_id'),
            ],
            'sort' => $request->input('sort') 
                ? array_map('trim', explode(',', $request->input('sort')))  
                : ['id', 'desc'],
            'perpage' => $request->integer('perpage') ?? 20,
        ];
    }

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->productRepository->pagination($agruments);
        return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', 're_password']);
            $payload['password'] = Hash::make($request->password);
            $user = $this->productRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
           DB::rollback();
            // echo $e->getMessage();die();
            $this->log($e);
            return false;
        }
    }

    public function update($request, $id){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $user = $this->productRepository->update($id, $payload);

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
            $this->productRepository->delete($id);
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