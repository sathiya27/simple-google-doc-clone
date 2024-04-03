<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UpdateModelException extends Exception
{
    protected $code = 404;
    public function report()
    {
        
    }

    public function render()
    {
        return new JsonResponse([
            'errors'=>[
                'code'=>$this->getCode(),
                'message'=>$this->getMessage(),
            ]
        ]);
    }
}
