<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResource
     */
    public function index()
    {
        $users = User::query()->get();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $created = User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

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
    public function update(Request $request, User $user)
    {
        //$update = $user->update($request->only(['name', 'email', 'password'])) // same as below, but not as flexible like below method to edit the fields
        $updated = $user->update([
            'name'=> $request->name ?? $user->name,
            'email'=>$request->email ?? $user->email,
            'password'=>$request->password ?? $user->password,
        ]);

        if(!$updated){
            return new JsonResponse([
                'error'=>[
                    'Failed to update resource'
                ]
                ], 400);
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $deleted = $user->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'error'=>[
                    'Failed to delete resource'
                ]
                ], 400);
        }

        return new JsonResponse([
            'data'=>'Resource deleted successfully'
        ]);
    }
}
