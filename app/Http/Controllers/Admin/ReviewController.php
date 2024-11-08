<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Comment\ReviewRepository;
use App\Services\Review\ReviewService;
use App\Models\Review;

class ReviewController extends Controller
{
    protected $reviewRepository;
    protected $reviewService;
    function __construct(
        ReviewRepository $reviewRepository,
        ReviewService $reviewService
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->reviewService = $reviewService;
    }
    public function index(Request $request)
    {
        $reviews = $this->reviewService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.comment.review.index', compact(
            'config',
            'reviews'
        ));
    }
    public function getData(Request $request)
    {
        $reviews = $this->reviewService->paginate($request);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('index');
        return view('admin.pages.comment.review.components.table', compact(
            'config',
            'reviews'
        ));
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories,name',
                'publish' => 'required',
            ],
            [
                'name.required' => 'Tên đánh giá không được để trống',
                'name.unique' => 'đánh giá đã tồn tại',
                'publish.required' => 'Chưa chọn trạng thái đánh giá',
            ]
        );
        if ($this->reviewService->create($request)) {
            return redirect()->route('review.index')->with('success', 'Tạo đánh giá mới thành công');
        }
        return  redirect()->route('review.index')->with('error', 'Tạo đánh giá mới thất bại');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories,name, ' . $id,
            ],
            [
                'name.required' => 'Tên đánh giá không được để trống',
                'name.unique' => 'đánh giá đã tồn tại',
            ]
        );

        if ($this->reviewService->update($request, $id)) {
            return redirect()->route('review.index')->with('success', 'Cập nhật đánh giá thành công.');
        }
        return  redirect()->route('review.index')->with('error', 'Cập nhật đánh giá thất bại');
    }


    public function edit($id) {}

    public function delete($id)
    {
        $review = $this->reviewRepository->findById($id);
        $config = $this->config();
        $config['breadcrumb'] = $this->breadcrumb('delete');
        $config['method'] = 'delete';
        return view('admin.pages.comment.review.delete', compact(
            'config',
            'review'
        ));
    }

    public function destroy($id)
    {
        if ($this->reviewService->delete($id)) {
            return redirect()->route('forbiddenword.index')->with('success', 'Xóa bình luận thành công');
        }
        return redirect()->route('forbiddenword.index')->with('error', 'Xóa bình luận thất bại');
    }

    private function breadcrumb($key)
    {
        $breadcrumb = [
            'index' => [
                'name' => 'Quản lý đánh giá',
                'list' => ['đánh giá', 'Danh sách']
            ],
            // 'create' => [
            //     'name' => 'Tạo đánh giá',
            //     'list' => ['đánh giá', 'Tạo đánh giá']
            // ],
            // 'update' => [
            //     'name' => 'Cập nhật đánh giá',
            //     'list' => ['đánh giá', 'Cập nhật đánh giá']
            // ],
            'delete' => [
                'name' => 'Xóa đánh giá',
                'list' => ['đánh giá', 'Xóa đánh giá']
            ]

        ];
        return isset($breadcrumb[$key]) ? $breadcrumb[$key] : 'Trang chủ';
    }
    private function config()
    {
        return [
            'css' => [],
            'js' => [],
            'model' => 'review'
        ];
    }
}
