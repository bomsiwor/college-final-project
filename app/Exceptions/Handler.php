<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is("api/*")) :
            if ($e instanceof MethodNotAllowedHttpException) :
                return response()->json([
                    'code' => 405,
                    'message' => 'Request Method tidak diperbolehkan!',
                    'data' => []
                ], 405);
            elseif ($e instanceof NotFoundHttpException) :
                return response()->json([
                    'code' => 404,
                    'message' => 'URI tidak ada!',
                    'data' => []
                ], 404);
            elseif ($e instanceof AuthenticationException) :
                return response()->json([
                    'code' => 401,
                    'success' => false,
                    'message' => 'Unauthenticated.',
                    'data' => []
                ], 401);
            elseif ($e instanceof ModelNotFoundException) :
                return response()->json([
                    'code' => 404,
                    'success' => false,
                    'message' => 'Data tidak ada!',
                    'data' => []
                ], 401);
            endif;
        else :
            return parent::render($request, $e);
        endif;
    }
}
