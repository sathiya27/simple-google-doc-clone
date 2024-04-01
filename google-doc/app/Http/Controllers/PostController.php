<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {

        $pageSize = $request->page_size ?? 20;

        // $post = Post::query()->where('id', '=', '3')->get();  // to get a specific resource by id, can add multiple where()
        $posts = Post::query()->paginate($pageSize);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(Request $request, PostRepository $repo)
    {

        $created = $repo->create($request->only([
            'title',
            'body',
            'user_ids'
        ]));

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
    public function update(Request $request, Post $post, PostRepository $repo)
    {

        $post = $repo->update($request->only([
            'title',
            'body',
            'user_ids'
        ]), $post);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, PostRepository $repo)
    {
        $deleted = $repo->forceDelete($post);

        return new JsonResponse([
            'Data'=>'deleted post successfully',
        ]);
    }
}
