<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {

        // $post = Post::query()->where('id', '=', '3')->get();  // to get a specific resource by id, can add multiple where()
        $posts = Post::query()->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(Request $request)
    {

        $created = DB::transaction(function () use ($request){ // Used to make sure all DB operation is done, if one DB operation is failed, it will rollback
            $created = Post::query()->create([ // --------------------------------> first DB operation
                'title'=> $request->title,
                'body'=> $request->body,
            ]);

            $created->users()->sync($request->user_ids); // --------------------------------> second DB operation

            return $created;
        });

        return new PostResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \illuminate\Http\Request $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     */
    public function update(Request $request, Post $post)
    {

        //$post->update($request->only(['id', 'title']));   // same as below, use this if only want to update resource simply
        $updated = $post->update([
            'title'=> $request->title ?? $post->title,
            'body'=> $request->body ?? $post->body,
        ]);

        if(!$updated){
            return new JsonResponse([
                'errors'=> [
                    'Failded to update model.'
                ]
            ], 400);
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deleted = $post->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors'=>[
                    'Failed to delete resource.'
                ]
            ]);
        }

        return new JsonResponse([
            'data'=> 'deleted successfully'
        ]);
    }
}
