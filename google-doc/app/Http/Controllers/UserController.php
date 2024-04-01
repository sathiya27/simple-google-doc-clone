<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return UserResource
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 20;
        $users = User::query()->paginate($page_size);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request, UserRepository $repo)
    {
        $created = $repo->create($request->only([
            'name',
            'email',
            'password'
        ]));

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user, UserRepository $repo)
    {
        //$update = $user->update($request->only(['name', 'email', 'password'])) // same as below, but not as flexible like below method to edit the fields
        $user = $repo->update($request->only([
            'name',
            'email',
            'password',
        ]), $user);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user, UserRepository $repo)
    {
        $deleted = $repo->forceDelete($user);

        return new JsonResponse([
            'Data'=>'deleted post successfully',
        ]);
    }
}
