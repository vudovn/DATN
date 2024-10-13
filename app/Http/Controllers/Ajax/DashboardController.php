<?php 
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeValueRepository;

use Illuminate\Http\Request;

class DashboardController extends Controller {


    protected $attributeRepository;
    protected $attributeValueRepository;
    public function __construct(
        AttributeRepository $attributeRepository,
        AttributeValueRepository $attributeValueRepository
    ){
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }


    public function changeStatus(Request $request){
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if($serviceClass->changeStatusByField($data)){
            return response()->json([
                'message' => 'Update Successfully',
                'code' => 10
            ]);
        }
        return response()->json([
            'message' => 'An issue occurred, Please try again',
            'code' => 11
        ]);
    }

    public function changeStatusMultiple(Request $request){
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if($serviceClass->bulkChangeStatus($data)){
            return response()->json([
                'message' => 'Update Successfully',
                'code' => 10
            ]);
        }
        return response()->json([
            'message' => 'An issue occurred, Please try again',
            'code' => 11
        ]);
    }

    public function deleteMultiple(Request $request){
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if($serviceClass->bulkDelete($data)){
            return response()->json([
                'message' => 'Update Successfully',
                'code' => 10
            ]);
        }
        return response()->json([
            'message' => 'An issue occurred, Please try again',
            'code' => 11
        ]);
    }

    public function deleteItem(Request $request) {
        $data = $request->all();
        $serviceClass = loadClass($data['model'], 'Service');
        if($serviceClass->delete($data['id'])) {
            return successResponse();
        }
        return errorResponse();

    }

    public function getAttribute() {
        $attributes = $this->attributeRepository->getAll();
        return successResponse($attributes);
    }

    // public function getAttributeValue(Request $request) {
    //     $attribute_id = $request->attribute_id;
    //     $attribute = $this->attributeRepository->findById($attribute_id);
    //     $attribute_values = $attribute->attribute_values;
    //     return successResponse($attribute_values);
    // }

    public function getAttributeValue(Request $request) {
        $payload = $request->all();
        // dd($payload);
        $attribute = $this->attributeValueRepository->searchValue($payload['attribute_id'], $payload['search']);

        $attributeFormat =  $attribute->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->value
            ];
        })->all();
        return successResponse($attributeFormat);
    }

}