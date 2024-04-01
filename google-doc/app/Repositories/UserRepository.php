<?php 

namespace App\Repositories;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

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
    
        if(!$updated){
            throw new \Exception("Failed to udpated resource.");
        }
    
        return $user;
    });
}

public function forceDelete($user)
{
    return DB::transaction(function () use ($user){
        $deleted = $user->forceDelete();
        if(!$deleted){
            throw new \Exception("Failed to deleted User");
        }
    
        return $deleted;
    });
}
}