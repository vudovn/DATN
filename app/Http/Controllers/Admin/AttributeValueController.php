<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Services\Attribute\AttributeValueService;
use App\Services\Attribute\AttributeService;
use App\Repositories\Attribute\AttributeRepository;

class AttributeValueController extends Controller
{
    protected $attributeValueService;
    protected $attributeService;
    protected $attributeRepository;
    function __construct(
        AttributeService $attributeService,
        AttributeValueService $attributeValueService,
        AttributeRepository $attributeRepository
    ) {
        $this->attributeService = $attributeService;
        $this->attributeValueService = $attributeValueService;
        $this->attributeRepository = $attributeRepository;
    }
    public function index($attribute_id)
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');

        $attributes = $this->attributeRepository->findById($attribute_id);

        return view('admin.pages.product.attribute.value.index', compact(
            'config',
            'attributes'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|unique:attribute_values'
        ],[
            'value.required' => 'Tên biến thể không được để trống',
            'value.unique' => 'Tên biến thể đã tồn tại'
        ]);
        
        if($this->attributeValueService->create($request)) {
            return redirect()
                    ->route('product.attributeValue.index', $request->attribute_id)
                    ->with('success', 'Tạo mới biến thể thành công');
        } 
        return back()->with('error', 'Tạo mới biến thể thất bại');  
    }


    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý biến thể',
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

    private function config()
    {
        return [
            'css' => [
            ],
            'js' => [
            ],
            'model' => 'attributeValue'
        ];
    }
}
