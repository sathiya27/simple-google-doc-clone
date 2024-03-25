<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait ForeignKeyChecks
{
    protected function enableForeignKey()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function disableForeignKey()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }
}