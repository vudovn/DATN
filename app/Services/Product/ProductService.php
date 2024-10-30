<?php
namespace App\Services\Product;
use App\Services\BaseService;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductVariantAttributeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;


class ProductService extends BaseService
{

    protected $productRepository;
    protected $productVariantAttributeRepository;
    public function __construct(
        ProductRepository $productRepository,
        ProductVariantAttributeRepository $productVariantAttributeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productVariantAttributeRepository = $productVariantAttributeRepository;
    }


    private function paginateAgrument($request)
    {
        return [
            'keyword' => [
                'search' => $request['keyword'] ?? '',
                'field' => ['name', 'sku', 'description', 'price']
            ],
            'condition' => [
                'publish' => isset($request['publish'])
                    ? (int) $request['publish']
                    : null,
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
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->productRepository->pagination($agruments);
        return $users;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->createProduct($request);
            // dd($product);
            $this->updateCategory($product, $request);
            if ($request->has('has_attribute')) {
                $this->createVariant($product, $request);
            }
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



    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findById($id);
            $this->updateProduct($product, $request);
            $this->updateCategory($product, $request);
            $product->productVariants()->each(function ($variant) {
                $variant->attributes()->detach();
                $variant->delete();
            });
            $this->createVariant($product, $request);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
        }
    }

    private function createVariant($product, $request)
    {
        $payload = $request->only(['variant', 'productVariantValue', 'attributeValue']);
        $variant = $this->createVariantArray($payload);
        $product->productVariants()->delete();
        $variants = $product->productVariants()->createMany($variant);
        $variantId = $variants->pluck('id');
        $attributeCombines = $this->comebineAttribute(array_values($payload['attributeValue']));
        $variantAttribute = [];
        if (count($variantId)) {
            foreach ($variantId as $key => $value) {
                if (count($attributeCombines)) {
                    foreach ($attributeCombines[$key] as $attributeId) {
                        $variantAttribute[] = [
                            'product_variant_id' => $value,
                            'attribute_id' => $attributeId,
                        ];
                    }
                }
            }
        }
        // dd($variantAttribute);
        $variantAttribute = $this->productVariantAttributeRepository->createMany($variantAttribute);
    }

    private function comebineAttribute($attribute = [], $index = 0)
    {
        if ($index == count($attribute))
            return [[]];
        $subComebines = $this->comebineAttribute($attribute, $index + 1);
        $comebines = [];
        foreach ($attribute[$index] as $value) {
            foreach ($subComebines as $subComebine) {
                $comebines[] = array_merge([$value], $subComebine);
            }
        }
        return $comebines;
    }
    private function createVariantArray(array $payload)
    {
        $variant = [];
        if (isset($payload['variant']['sku']) && count($payload['variant']['sku'])) {
            foreach ($payload['variant']['sku'] as $key => $value) {
                $variant[] = [
                    'code' => $payload['productVariantValue']['id'][$key] ?? '',
                    'sku' => $value,
                    'price' => convertNumber($payload['variant']['price'][$key]) ?? 0,
                    'quantity' => convertNumber($payload['variant']['quantity'][$key]) ?? 0,
                    'albums' => json_encode($payload['variant']['albums'][$key] ?? [], JSON_UNESCAPED_UNICODE),
                    // 'product_id' => $product->id,
                ];
            }

            // dd($variant);
        }
        // dd($payload);
        return $variant;
    }

    private function updateCategory($product, $request)
    {
        $arrayCategory = $request->input('category_id', []);
        if ($request->has('category')) {
            $arrayCategory[] = $request->input('category');
        }
        return $product->categories()->sync($arrayCategory);
    }

    private function processPayload($request)
    {
        $payload = $request->except(['_token', 'send']);
        $payload['price'] = convertNumber($payload['price']);
        $payload['quantity'] = convertNumber($payload['quantity']);
    
        if (empty($payload['slug'])) {
            $payload['slug'] = getSlug($payload['name']);
        }

        foreach (['albums', 'attributeCatalogue', 'attributeValue', 'variant'] as $field) {
            if ($request->has($field) && isset($payload[$field])) {
                $key = match ($field) {
                    'attributeCatalogue' => 'attribute_category',
                    'attributeValue' => 'attribute',
                    default => $field,
                };
                $payload[$key] = $this->formatJson($payload[$field]);
            }
        }
    
        return $payload;
    }
    
    private function createProduct($request)
    {
        $payload = $this->processPayload($request);
        return $this->productRepository->create($payload);
    }
    
    private function updateProduct($product, $request)
    {
        $payload = $this->processPayload($request);
        return $this->productRepository->update($product->id, $payload);
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