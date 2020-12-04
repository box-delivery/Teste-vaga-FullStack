<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;
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
        $this->renderable(function (UserAlreadyRegisteredException $e) {
            return Response::json(['message' => $e->getMessage()], 409);
        });

        $this->renderable(function (MovieNotFoundException $e) {
            return Response::json(['message' => $e->getMessage()], 404);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
