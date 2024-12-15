<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

use App\Services\Comment\CommentService;
use App\Services\Collection\CollectionService;

use App\Repositories\Collection\CollectionRepository;
use App\Repositories\Collection\CollectionProductRepository;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\User\UserRepository;
class CollectionController extends Controller
{
    protected $commentService;
    protected $collectionService;

    protected $collectionRepository;
    protected $collectionProductRepository;
    protected $productVariantRepository;
    protected $productRepository;
    protected $commentRepository;
    protected $userRepository;
    public function __construct(
        CommentService $commentService,
        CollectionService $collectionService,

        CollectionRepository $collectionRepository,
        CollectionProductRepository $collectionProductRepository,
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        CommentRepository $commentRepository,
        UserRepository $userRepository,
    ) {
        $this->commentService = $commentService;
        $this->collectionService = $collectionService;

        $this->collectionRepository = $collectionRepository;
        $this->collectionProductRepository = $collectionProductRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {
        $config = $this->config();
        $collections = successResponse(Collection::all())->getData()->data;
        return view('client.pages.collection.index', compact('config', 'collections'));
    }
    public function detail($slug)
    {
        $config = $this->config();
        $collections = successResponse(Collection::all())->getData()->data;
        $collection = $this->collectionRepository->findByField('slug', $slug)->first();
        $id_collections = $this->collectionProductRepository->findByField('collection_id', $collection->id)->get();
        $products = $this->collectionService->getDetail($id_collections);
        return view('client.pages.collection.detail', compact('config', 'collection', 'collections', 'products'));
    }
    public function list(Request $request)
    {
        $collections = successResponse(Collection::all())->getData()->data;
        return $collections;
    }
    public function getComments(Request $request, $slug)
    {
        $collection = $this->collectionRepository->findByField('slug', $slug)->first();
        $comments = $this->commentRepository->getLimitComments(
            'collection_id',
            [$collection->id],
            (int) $request->limit
        );
        $count_comment_current = $comments->count();
        $count_comments = $collection->comments->whereNull('parent_id')->count();
        return view('client.pages.collection.components.comment', compact('collection', 'comments','count_comments','count_comment_current'))->render();    }
    public function getReplies(Request $request, $comment_id, $limit)
    {
        $comment = $this->commentRepository->findById($comment_id);
        $comment_childs = $this->commentRepository->getLimitReplies(
            'parent_id',
            [$comment_id],
            (int) $limit
        );
        $count_comment_childs_current = $request->limit;
        $count_comment_childs = $comment->children->whereNotNull('parent_id')->count();
        return view('client.pages.collection.components.comment_child', compact('comment_childs', 'comment','count_comment_childs_current','count_comment_childs'))->render();
    }
    public function store(Request $request)
    {
        $comment = $this->commentService->create($request);
        $user = Auth::user();
        $data = array_merge($request->all(), ['user' => $user]);
        return $data;
    }
    public function update(Request $request)
    {
        $comment = $this->commentService->update($request, $request->id);
        return successResponse($comment);
    }
    public function remove(Request $request)
    {
        $comment = $this->commentService->delete($request->id);
        if ($comment) {
            return successResponse($comment);
        } else {
            return errorResponse('', 400);
        }
    }

    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/collection.css',
                'client_asset/custom/css/cart.css',
                'client_asset/custom/css/checkbox.css',
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
                'client_asset/custom/js/collection/collection.js',
                'client_asset/custom/js/collection/comment.js',
            ],
            'model' => 'collection'
        ];
    }

    private function breadcrumb()
    {
        return [
            "detail" => [
                "title" => "Product Detail",
                "url" => route('client.product.detail')
            ]
        ];
    }


}
