<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ForeignKeyChecks;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
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
        //
        $this->disableForeignKey();

        $this->truncate('comments');
        Comment::Factory(3)->create();

        $this->enableForeignKey();


    }
}
