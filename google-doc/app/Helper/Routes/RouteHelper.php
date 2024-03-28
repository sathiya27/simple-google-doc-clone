<?php

namespace App\Helper\Routes; 

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class RouteHelper{
    public static function includeRoutes(String $folder)
    {
        //iterate thru the v1 folder recursively
        $dirIterator = new RecursiveDirectoryIterator($folder);

        /** @var RecursiveDirectoryIterator | RecursiveIteratorIterator $it */
        $it = new RecursiveIteratorIterator($dirIterator);

        //require each file in the directory
        while($it->valid()){
            if(
                !$it->isDot()// to skip directories in this directory
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php'
            ){
                require $it->key();
            }
            $it->next();
        }
    }
}