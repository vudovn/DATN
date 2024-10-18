<?php
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function __construct()
    {

    }

    public function changeStatus(Request $request)
    {
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if ($serviceClass->changeStatusByField($data)) {
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

    public function changeStatusMultiple(Request $request)
    {
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if ($serviceClass->bulkChangeStatus($data)) {
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

    public function deleteMultiple(Request $request)
    {
        $data = $request->input();
        $serviceClass = loadClass($data['model'], 'Service');
        if ($serviceClass->bulkDelete($data)) {
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

    public function deleteItem(Request $request)
    {
        $data = $request->all();
        $serviceClass = loadClass($data['model'], 'Service');
        if ($serviceClass->delete($data['id'])) {
            return successResponse();
        }
        return errorResponse();

    }
    public function quickUpdate(Request $request)
    {
        $data = $request->all();
        $className = "\\App\\Http\\Requests\\" . ucfirst($data['model']) . "\\Update" . ucfirst($data['model']) . "Request";
        if (class_exists($className)) {
            $rules = (new $className())->rules();
            if (isset($rules[$data['name']])) {
                $request->validate(
                    ['value' => $rules[$data['name']]]
                );
            }
        }
        $serviceClass = loadClass($data['model'], 'Repository');
        $item = $serviceClass->findById($data['id']);
        $item->{$data['name']} = $data['value'];
        $item->save();

        return successResponse(null, $item['message']);
    }



    public function getAttribute()
    {

    }

    public function getAttributeValue(Request $request)
    {

    }

}