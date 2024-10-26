<?php
namespace App\Services\Product;
use App\Services\BaseService;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;


class ProductService extends BaseService
{

    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }


    private function paginateAgrument($request, $isFilter = false)
    {
        $defaultSort = ['id', 'asc'];
        $defaultPerPage = $isFilter ? 12 : 10;

        return [
            'keyword' => [
                'search' => $request['keyword'] ?? '',
                'field' => $isFilter ? ['name'] : ['name', 'sku', 'description', 'price'],
            ],
            'condition' => [
                'publish' => $isFilter ? 1 : (isset($request['publish']) ? (int) $request['publish'] : null),
            ],
            'relation' => $isFilter ? [
                'categories' => $request['categories'] ?? null,
            ] : [],
            'sort' => isset($request['sort']) && $request['sort'] != 0
                ? explode(',', $request['sort'])
                : $defaultSort,
            'perpage' => (int) ($request['perpage'] ?? $defaultPerPage),
        ];
    }

    public function paginate($request)
    {
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->productRepository->pagination($agruments);
        return $users;
    }
    public function findProduct($request)
    {
        $agruments = $this->paginateAgrument($request, true);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $data = $this->productRepository->filterProduct($agruments);
        return $data;
    }
    public function create($request)
    {
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

    public function update($request, $id)
    {
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

    public function delete($id)
    {
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