<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param Request $request
     * @return CommentResource
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size;
        $comments = Comment::query()->paginate($page_size);

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \illuminate\Http\Requests $request
     * @return CommentResource
     */
    public function store(Request $request, CommentRepository $repo)
    {
        $comment = $repo->create($request->only([
            'body',
            'user_id',
            'post_id'
        ]));

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \illuminate\Http\Requests $request
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     */
    public function update(Request $request, Comment $comment, CommentRepository $repo)
    {
        //$updated = $comment->update($request->only(['body','user_id', 'post_id']));

        $comment = $repo->update($request->only([
            'body',
            'user_id',
            'post_id'
        ]), $comment);

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment, CommentRepository $repo)
    {
        $deleted = $repo->forceDelete($comment);

        return new JsonResponse([
            'data'=>'comment resource deleted successfully'
        ]);
    }
}
