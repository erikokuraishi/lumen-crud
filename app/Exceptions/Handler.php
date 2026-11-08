<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if (env('APP_DEBUG')) {
            return parent::render($request, $exception);
        }

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof HttpResponseException) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $status = Response::HTTP_METHOD_NOT_ALLOWED;
            $exception = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $exception);
        } elseif ($exception instanceof NotFoundHttpException) {
            $status = Response::HTTP_NOT_FOUND;
            $exception = new NotFoundHttpException('HTTP_NOT_FOUND', $exception);
        } elseif ($exception instanceof AuthorizationException) {
            $status = Response::HTTP_FORBIDDEN;
            $exception = new AuthorizationException('HTTP_FORBIDDEN', $status);
        } elseif ($exception) {
            $exception = new HttpException($status, 'HTTP_INTERNAL_SERVER_ERROR');
        }

        return response()->json([
            'success' => false,
            'status'  => $status,
            'message' => $exception->getMessage()
        ], $status);
    }
}