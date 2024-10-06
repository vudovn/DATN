<?php 
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {


    public function __construct(){

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

}