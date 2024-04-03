<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class DeleteModelException extends Exception
{
    protected $code = 404;
    public function report()
    {
        
    }

    public function render($request){
        return new JsonResponse([
            'errors'=>[
                'code'=>$this->code,
                'message'=>$this->message
            ]
        ]);
    }
}
