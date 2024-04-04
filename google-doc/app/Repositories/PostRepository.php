<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Events\Models\Post\PostUpdate;
use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Exceptions\CreateModelException;
use App\Exceptions\DeleteModelException;
use App\Exceptions\UpdateModelException;

class PostRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){ // Used to make sure all DB operation is done, if one DB operation is failed, it will rollback
            $created = Post::query()->create([ // --------------------------------> first DB operation
                'title'=> data_get($attributes, 'title', 'untitled'),
                'body'=> data_get($attributes, 'body'),
            ]);
            throw_if(!$created, CreateModelException::class, 'Failed to create Model');
            $created->users()->sync(data_get($attributes, 'user_ids')); // --------------------------------> second DB operation
            event(new PostCreated($created));
            return $created;
        });
    }

    public function update(array $attributes, $post)
    {
        return DB::transaction(function () use($attributes, $post){
            //$post->update($request->only(['id', 'title']));   // same as below, use this if only want to update resource simply
            $updated = $post->update([
                'title'=> data_get($attributes, 'title', $post->title),
                'body'=> data_get($attributes, 'body', $post->body),
            ]);

            throw_if(!$updated, UpdateModelException::class, 'Failed to update Post');
            event(new PostUpdate($post));
            if($userIds = data_get($attributes, 'user_ids')){
                $post->users()->sync($userIds);
            }
            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use( $post){
            $deleted = $post->forceDelete();

            throw_if(!$deleted, DeleteModelException::class, 'Failed to delete Post');
            event(new PostDeleted());
            return $deleted;
        });
    }
}