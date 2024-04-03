<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonError extends Exception
{
    //
    protected $code = 422;
    public function report()
    {
        //dump($this->code);
    }

    public function render($request)
    {
        return new JsonResponse([
            'errors' =>[
                'message'=>$this->getMessage(),
            ]
        ], $this->code);
    }
}
