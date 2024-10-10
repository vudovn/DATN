<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\StoreAttributeRequest;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Services\Attribute\AttributeService;
use App\Repositories\Attribute\AttributeRepository;
use App\Http\Requests\Attribute\UpdateAttributeRequest;


class AttributeController extends Controller
{
    protected $attributeService;
    protected $attributeRepository;
    function __construct(
        AttributeService $attributeService,
        AttributeRepository $attributeRepository
    ) {
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        // $this->middleware('permission:attribute-list|attribute-create|attribute-edit|attribute-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:attribute-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:attribute-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:attribute-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        $attributes = $this->attributeService->paginate($request);
        return view('admin.pages.product.attribute.attribute.index', compact(
            'config',
            'attributes'
        ));
    }

    public function create()
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        $config['model'] = 'product.attribute';
        return view('admin.pages.product.attribute.attribute.save', compact(
            'config'
        ));
    }

    public function store(StoreAttributeRequest $request)
    {
        if ($this->attributeService->create($request)) {
            return redirect()->route('product.attribute.index')->with('success', 'Tạo mới thuộc tính thành công');
        }
        return redirect()->back()->with('error', 'Tạo mới thuộc tính thất bại');
    }

    public function edit($id)
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $config['method'] = 'edit';
        $config['model'] = 'product.attribute';
        $attribute = $this->attributeRepository->findById($id);
        return view('admin.pages.product.attribute.attribute.save', compact(
            'config',
            'attribute'
        ));
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        // $this->attributeService->update($request, $id);
        if ($this->attributeService->update($request, $id)) {
            return redirect()->back()->with('success', 'Cập nhật thuộc tính thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thuộc tính thất bại');
    }

    public function destroy($id)
    {
        if (Attribute::find($id)->delete()) {
            return successResponse();
        }
    }

    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý thuộc tính',
                'list' => ['QL thuộc tính', 'Danh sách']
            ],
            'create' => [
                'name' => 'Tạo thuộc tính',
                'list' => ['QL thuộc tính', 'Tạo thuộc tính chi đó']
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
                'admin_asset/library/attribute.js'
            ],
            'model' => 'attribute'
        ];
    }
}
