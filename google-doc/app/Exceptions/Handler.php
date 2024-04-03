<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        /* $this->reportable(function (GeneralJsonError $e) { //---------> this is basically the same thing as GeneralJsonError file's report() function
            dump("some messages");                         //---------> tho this will be overidden if there is a report function in the GeneralJsonError
        });

        $this->renderable(function (GeneralJsonError $e) { // -------> same as abobe but this is render() method in GeneralJsonError file
            return new JsonResponse([
                'errors'=>[
                    'message'=>$e->getCode(),
                ]
                ]);
        }); */
    }
}
