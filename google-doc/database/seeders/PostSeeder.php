<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ForeignKeyChecks;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    use TruncateTable;
    use ForeignKeyChecks;

    public function run()
    {
        $this->disableForeignKey();

        $this->truncate('posts');
        Post::factory(3)->state([
            'title'=>'untitled'
        ])->create();

        $this->enableForeignKey();
    }
}
