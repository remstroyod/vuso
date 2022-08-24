<?php

namespace Backend\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($request->is('api/*'))
        {

            if ($exception instanceof MethodNotAllowedHttpException)
            {

                return response()->json([
                    'data' => [],
                    'message' => 'Method Not Allowed'
                ], 404);

            }

            if ($exception instanceof ModelNotFoundException)
            {

                return response()->json([
                    'data' => [],
                    'message' => 'Data not Found'
                ], 404);

            }

        }

        return parent::render($request, $exception);

    }

}
