<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CreateModelException;
use App\Exceptions\DeleteModelException;
use App\Exceptions\UpdateModelException;
use App\Events\Models\Comment\CommentUpdate;
use App\Events\Models\Comment\CommentCreated;
use App\Events\Models\Comment\CommentDeleted;

class CommentRepository extends BaseRepository
{
    
    public function create(array $attributes)
    {
        return DB::transaction(function () use($attributes) {
            $created = Comment::query()->create([
                'body'=>data_get($attributes, 'body'),
                'user_id'=>data_get($attributes, 'user_id'),
                'post_id'=>data_get($attributes, 'post_id')
            ]);
            throw_if(!$created, CreateModelException::class, 'Failed to create comment');
            event(new CommentCreated($created));
            return $created;
        });
    }
    
    public function update(array $attributes, $comment)
    {
        return DB::transaction(function () use($attributes, $comment) {
            $updated = $comment->update([
                'body'=>data_get($attributes, 'body', $comment->body),
                'user_id'=>data_get($attributes, 'user_id', $comment->user_id),
                'post_id'=>data_get($attributes, 'post_id', $comment->post_id)
            ]);
    
            throw_if(!$updated, UpdateModelException::class, 'Failed to update comment');
            event(new CommentUpdate($comment));
            return $comment;
        });
    }
    
    public function forceDelete($comment)
    {
        return DB::transaction(function () use ($comment){
            $deleted = $comment->forceDelete();
    
            throw_if(!$deleted, DeleteModelException::class, 'Failed to delete Comment');
            event(new CommentDeleted());
            return $deleted;
        });
    }

}