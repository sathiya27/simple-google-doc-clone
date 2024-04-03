<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CreateModelException extends Exception
{
    //

    protected $code = 404;

    public function report()
    {
        
    }

    public function render()
    {
        return new JsonResponse([
            'error'=>[
                'code'=>$this->getCode(),
                'message'=>$this->getMessage(),
            ]
        ]);
    }
}
