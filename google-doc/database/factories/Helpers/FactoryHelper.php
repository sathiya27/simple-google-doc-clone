<?php

namespace Database\Factories\Helpers;

class FactoryHelper
{
    public static function getRandomModelId(string $model)
    {
        //get model count
        $count = $model::query()->count();
        //if model count == 0 then create new model
        if($count == 0){
            return $model::factory()->create()->id;
        } else {
            return rand(1, $count);
        }
    }
}