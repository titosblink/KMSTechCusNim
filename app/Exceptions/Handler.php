<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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



    // protected function renderHttpException(HttpException $e)
    // {
    //     if (! view()->exists("errors.{$e->getStatusCode()}")) {
    //         return response()->view('errorss', ['exception' => $e], 500, $e->getHeaders());
    //         // return view('uploadmanifest');
    //     }

    //     return parent::renderHttpException($e);
    //     // return view('uploadmanifest');
    // }

    




    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}






