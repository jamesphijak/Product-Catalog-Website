<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
// use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    // public function render($request, Throwable $exception)
    // {
    //     return parent::render($request, $exception);
    // }
    public function render($request, Throwable $e)
    {
        if (env('APP_DEBUG')) {
            return parent::render($request, $e);
        }

        $rendered = parent::render($request, $e);

        return response()->json([
            'success' => false,
            'status' => $rendered->getStatusCode(),
            'message' => $e->getMessage()
        ], $rendered->getStatusCode());



        // $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        // if ($e instanceof HttpResponseException) {
        //     $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        // } elseif ($e instanceof MethodNotAllowedHttpException) {
        //     $status = Response::HTTP_METHOD_NOT_ALLOWED;
        //     $e = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $e);
        // } elseif ($e instanceof NotFoundHttpException) {
        //     $status = Response::HTTP_NOT_FOUND;
        //     $e = new NotFoundHttpException('HTTP_NOT_FOUND', $e);
        // } elseif ($e instanceof AuthorizationException) {
        //     $status = Response::HTTP_FORBIDDEN;
        //     $e = new AuthorizationException('HTTP_FORBIDDEN', $status);
        // } elseif ($e instanceof \Dotenv\Exception\ValidationException && $e->getResponse()) {
        //     $status = Response::HTTP_BAD_REQUEST;
        //     $e = new \Dotenv\Exception\ValidationException('HTTP_BAD_REQUEST', $status, $e);
        // } elseif ($e) {
        //     $e = new HttpException($status, 'HTTP_INTERNAL_SERVER_ERROR');
        // }

        // return response()->json([
        //     'success' => false,
        //     'status' => $status,
        //     'message' => $e->getMessage()
        // ], $status);
    }
}
