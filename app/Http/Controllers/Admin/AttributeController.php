<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\StoreAttributeRequest;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index () {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        $attributes = Attribute::paginate(10);
        // dd($attributes->attibute_values);
        return view('admin.pages.product.attribute.index', compact(
            'config',
            'attributes'
        ));
    }

    public function create () {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        $config['model'] = 'product.attribute';
        return view('admin.pages.product.attribute.save', compact(
            'config'
        ));
    }

    public function store (StoreAttributeRequest $request) {
        Attribute::create([
            'code' => '789abcdefghi',
            'name' => $request->name
        ]);
        return redirect()->route('product.attribute.index')->with('success', 'Tạo mới thuộc tính thành công');
    }

    public function destroy($id) {
        if(Attribute::find($id)->delete()) {
            return successResponse();
        } 
    }

    private function breadcrumb($key){
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý thuộc tính',
                'list' => ['QL thuộc tính', 'Danh sách']
            ],
            'create' => [
                'name' => 'Tạo thuộc tính',
                'list' => ['QL thuộc tính', 'Tạo thuộc tính']
            ],
            'update' => [
                'name' => 'Cập nhật thuộc tính',
                'list' => ['QL thuộc tính', 'Cập nhật thuộc tính']
            ],
            'delete' => [
                'name' => 'Xóa thuộc tính',
                'list' => ['QL thuộc tính', 'Xóa thuộc tính']
            ]
        ];
        return $breadcrumb[$key];
    }

    private function config(){
        return [
            'css' => [
            ],
            'js' => [
            ],
            'model' => 'attribute'
        ];
    }
}
