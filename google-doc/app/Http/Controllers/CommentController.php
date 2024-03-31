<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CommentResource
     */
    public function index()
    {
        $comments = Comment::query()->get();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \illuminate\Http\Requests $request
     * @return CommentResource
     */
    public function store(Request $request)
    {
        $comment = Comment::query()->create([
            'body'=>$request->body,
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id
        ]);

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
    public function update(Request $request, Comment $comment)
    {
        //$updated = $comment->update($request->only(['body','user_id', 'post_id']));

        $updated = $comment->update([
            'body'=>$request->body ?? $comment->body,
            'user_id'=>$request->user_id ?? $comment->user_id,
            'pst_id'=> $request->post_id ?? $comment->post_id,
        ]);
        
        if(!$updated){
            return new JsonResponse([
                'errors'=>[
                    'Failed to update comment resource'
                ]
            ], 400);
        }

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors'=>[
                    'failed to delete comment resource'
                ]
            ], 400);
        }

        return new JsonResponse([
            'data'=>'comment resource deleted successfully'
        ]);
    }
}
