<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use App\Services\Comment\CommentService;
class CommentController extends Controller
{
    protected $commentService;
    protected $commentRepository;
    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService,
        )   
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }
 
    public function loadComment(Request $request){
        $data = $this->commentRepository->findByField('product_id', $request->product_id)->get();
        foreach ($data as $value){
            $value->name = $value->user->name;
            $value->avatar = $value->user->avatar;
        }
        return $data;
    }
    public function store(Request $request){
        $data = $this->commentService->create($request);
        return $data;
    }   

    private function config()
    {
        return [
            'css' => [
            ],
            'js' => [
                "https://freshcart.codescandy.com/assets/libs/rater-js/index.js",
            ],
            'model' => 'comment'
        ];
    }


}
