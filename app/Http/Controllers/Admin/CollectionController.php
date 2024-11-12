<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Collection\CollectionRepository;
use App\Services\Collection\CollectionService;
use App\Http\Requests\Collection\StoreCollectionRequest;
use App\Http\Requests\Collection\UpdateCollectionRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Traits\HasDynamicMiddleware;
use App\Models\Category;

class CollectionController extends Controller implements HasMiddleware
{
    use HasDynamicMiddleware;
    public static function middleware(): array
    {
        return self::getMiddleware('Collection');
    }
    protected $collectionRepository;
    protected $collectionService;
    function __construct(
        CollectionRepository $collectionRepository,
        CollectionService $collectionService
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->collectionService = $collectionService;
    }
    public function index(Request $request)
    {
        $collections = $this->collectionService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.collection.index', compact(
            'config',
            'collections'
        ));
    }

    public function getData($request)
    {
        $collections = $this->collectionService->paginate($request);
        $config = $this->config();
        return view('admin.pages.collection.components.table', compact('collections', 'config'));
    }
    public function create()
    {
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('create');
        $config['method'] = 'create';
        $categories = Category::where('is_room', 2)->pluck('name', 'id')->prepend('Danh mục', 0)->toArray();
        $categoryRoom = Category::where('is_room', 1)->pluck('name', 'id')->prepend('Phòng', 0)->toArray();
        return view('admin.pages.collection.save', compact(
            'config',
            'categoryRoom',
            'categories',
        ));
    }
    public function store(StoreCollectionRequest $request)
    {
        $collection = $this->collectionService->create($request);
        if ($collection) {
            return redirect()->route('collection.index')->with('success', 'Tạo bộ sưu tập mới thành công');
        }
        return redirect()->back()->with('error', 'Tạo bộ sưu tập mới thất bại');
    }
    public function edit($id)
    {
        $collection = $this->collectionRepository->findById($id);
        $categories = Category::where('is_room', 2)->pluck('name', 'id')->prepend('Danh mục', 0)->toArray();
        $categoryRoom = Category::where('is_room', 1)->pluck('name', 'id')->prepend('Phòng', 0)->toArray();
        $config = $this->config();
        $idProduct = $collection->products()->pluck('id')->toArray();
        $config['breadcrumb'] = $this->breadcrumb('update');
        $config['method'] = 'edit';
        return view('admin.pages.collection.save', compact(
            'config',
            'collection','categories','categoryRoom','idProduct'
        ));
    }
    public function update(UpdateCollectionRequest $request, $id)
    {
        $collection = $this->collectionService->update($request, $id);
        if ($collection) {
            return redirect()->route('collection.index', ['page' => $request->page])->with('success', 'Cập nhật người dùng thành công.');
        }
        return redirect()->route('collection.index')->with('error', 'Cập nhật người dùng thất bại');
    }
    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Danh sách bộ sưu tập',
                'list' => ['Danh sách bộ sưu tập']
            ],
            'create' => [
                'name' => 'Tạo bộ sưu tập',
                'list' => ['QL bộ sưu tập', 'Tạo bộ sưu tập']
            ],
            'update' => [
                'name' => 'Cập nhật bộ sưu tập',
                'list' => ['QL bộ sưu tập', 'Cập nhật bộ sưu tập']
            ],
            'delete' => [
                'name' => 'Xóa bộ sưu tập',
                'list' => ['QL bộ sưu tập', 'Xóa bộ sưu tập']
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
            'model' => 'collection'
        ];
    }
}
