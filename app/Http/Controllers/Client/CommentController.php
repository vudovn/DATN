<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\User\UserRepository;
use App\Services\Comment\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    protected $commentRepository;
    protected $userRepository;
    public function __construct(
        UserRepository $userRepository,
        CommentRepository $commentRepository,
        CommentService $commentService,
    ) {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    public function loadComment(Request $request)
    {
        $data = $this->commentRepository->findByField('product_id', $request->product_id)->orderBy('created_at', 'asc')->get();
        foreach ($data as $value) {
            $value->name = $value->user->name;
            $value->avatar = $value->user->avatar;
            if($value->parent_id !== null){
                $id = $this->commentRepository->findById($value->parent_id)->user_id;
                $value->parent_name = $this->userRepository->findById($id)->name;
            }
        }
        return $data;
    }
    public function getReplyComment(Request $request)
    {
        dd($request->all());
        $data = $this->commentService->create($request);
        return $data;
    }
    public function store(Request $request)
    {
        $data = $this->commentService->create($request);
        return $data;
    }

    private function config()
    {
        return [
            'css' => [],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
            ],
            'model' => 'comment'
        ];
    }
}
