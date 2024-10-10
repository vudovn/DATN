<?php  
namespace App\Services\Attribute;
use App\Services\BaseService;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeValueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;



class AttributeService extends BaseService {

    protected $attributeRepository;
    protected $attributeValueRepository;

    public function __construct(
        AttributeRepository $attributeRepository,
        AttributeValueRepository $attributeValueRepository
    ){
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }


    private function paginateAgrument($request){
        return [
            'keyword' => [
                'search' => $request->input('keyword'),
                'field' => ['name']
            ],
            'condition' => [
                'publish' => $request->integer('publish'),
            ],
            'sort' => $request->input('sort') 
                ? array_map('trim', explode(',', $request->input('sort')))  
                : ['id', 'desc'],
            'perpage' => $request->integer('perpage') ?? 10,
        ];
    }

    public function paginate($request){
        $agruments = $this->paginateAgrument($request);
        $cacheKey = 'pagination: ' . md5(json_encode($agruments));
        $users = $this->attributeRepository->pagination($agruments);
        return $users;
    }


    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            $id_attribute = $this->attributeRepository->create([
                'name' => $payload['name'],
                'publish' => $payload['publish'],
            ])->id;
            if($request->has('attribute_value')){
                $attribute_values = [];
                foreach ($payload['attribute_value'] as $key => $value) {
                    $attribute_values[] = [
                        'value' => $value,
                        'attribute_id' => $id_attribute,
                    ];
                    
                }
                $this->attributeValueRepository->insert($attribute_values);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // $this->log($e);
            return false;
        }
    }

    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send', '_method']);
            $id_attribute = $id;
            $this->attributeRepository->update($id, $payload);
            $oldData = $this->attributeValueRepository->findByField('attribute_id', $id)->pluck('value', 'id')->toArray();
            $newData = $request->input('attribute_value', []);
            $newDataEdit = [];
            foreach ($newData as $key => $values) {
                $newDataEdit[$key] = $values[0];
            }
            if (empty($newDataEdit)) {
                foreach ($oldData as $id => $value) {
                    $this->attributeValueRepository->delete($id);
                }
            } else {
                foreach ($oldData as $id => $value) {
                    if (array_key_exists($id, $newDataEdit)) {
                        if ($newDataEdit[$id] !== $value) {
                            $this->attributeValueRepository->update($id, [
                                'value' => $newDataEdit[$id],
                            ]);
                        }
                        unset($newDataEdit[$id]);
                    } else {
                        $this->attributeValueRepository->delete($id);
                    }
                }
    
                foreach ($newDataEdit as $key => $value) {
                    if (!in_array($value, $oldData)) {
                        $this->attributeValueRepository->create([
                            'value' => $value,
                            'attribute_id' => $id_attribute,
                        ]);
                    }
                }
            }
    
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // $this->log($e);
            // return false;
        }
    }
    

    public function delete($id){
        DB::beginTransaction();
        try {
            $this->attributeRepository->delete($id);
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