<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // This will replace our 404 response with
        // a JSON response.

        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->json([
                    'error' => '404 - Endpoint not found.'
                ], 404);
            }
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 405);
        }

        if ($exception instanceof Exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
