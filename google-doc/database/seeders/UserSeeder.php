<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\ForeignKeyChecks;

class UserSeeder extends Seeder
{

    use TruncateTable, ForeignKeyChecks;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKey();
        $this->truncate('users');

        User::query()->create([
            'name' => 'Sheen Beenu',
            'email' => 'SheenTheBeenQueen@gmail.com',
            'email_verified_at' => now(),
            'password' => 'SheenBB', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
        $this->enableForeignKey();
    }
}
