<?php 

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserDeleted;
use App\Events\Models\User\UserUpdated;
use App\Exceptions\CreateModelException;
use App\Exceptions\DeleteModelException;
use App\Exceptions\UpdateModelException;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
{

    return DB::transaction(function () use ($attributes){
        $user = User::query()->create([
            'name'=>data_get($attributes, 'name'),
            'email'=>data_get($attributes, 'email'),
            'password'=>data_get($attributes, 'password')
        ]);
        throw_if(!$user, CreateModelException::class, 'Failed to create User');
        event(new UserCreated($user));
        return $user;
    });

}

public function update(array $attributes, $user)
{
    return DB::transaction(function () use ($attributes, $user){
        $updated = $user->update([
            'name'=>data_get($attributes, 'name', $user->name),
            'email'=>data_get($attributes, 'email', $user->email),
            'password'=>data_get($attributes, 'password', $user->password)
        ]);
    
        throw_if(!$updated, UpdateModelException::class, 'failed to update User');
        event(new UserUpdated($user));
        return $user;
    });
}

public function forceDelete($user)
{
    return DB::transaction(function () use ($user){
        $deleted = $user->forceDelete();
        throw_if(!$deleted, DeleteModelException::class, 'Failed to delete User');
        event(new UserDeleted());
        return $deleted;
    });
}
}