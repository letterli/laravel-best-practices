<?php

namespace App\Exceptions;

use Exception;
use Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (!$request->expectsJson()) return parent::render($request, $exception);

        // 路由异常错误处理
        switch (true) {
            // FirstOrFail 和 FindOrFail 异常处理
            case $exception instanceof ModelNotFoundException:
                return response()->json([
                    'code' => 404,
                    'msg' => 'Record not Found!'
                ]);
                break;

            // Page Not Found 异常处理
            case $exception instanceof NotFoundHttpException:
                return response()->json([
                    'code' => 404,
                    'msg' => 'Page Not Found!'
                ]);
                break;

            // ValidationException 异常处理
            case $exception instanceof ValidationException:
                return response()->json([
                    'code' => 422,
                    'msg' => array_first(array_collapse($exception->errors()))
                ]);
                break;

            // MethodNotAllowedHttpException 异常处理
            case $exception instanceof MethodNotAllowedHttpException:
                return response()->json([
                    'code' => 405,
                    'msg' => $request->method().' Method Not Allowed!'
                ]);
                break;

            // OAuthServerException 异常处理
            // OauthServerException($message, $code, $errorType, $httpStatusCode = 400,$hint = null, $redirectUri = null)
            case $exception instanceof OAuthServerException:
                return response()->json([
                    'code' => $exception->getHttpStatusCode(),
                    'msg' => $exception->getMessage()
                ]);
                break;

            // AuthorizationException 异常处理
            case $exception instanceof AuthorizationException:
                return response()->json([
                    'code' => 401,
                    'msg' => 'Unauthorization.'
                ]);
                break;

            // UnauthorizedHttpException 异常处理
            case $exception instanceof UnauthorizedHttpException:
                return response()->json([
                    'code' => 401,
                    'msg' => 'Unauthorized.'
                ]);
                break;

            // TokenMismatchException 异常处理
            case $exception instanceof TokenMismatchException:
                return response()->json([
                    'code' => 463,
                    'msg' => 'X-CSRF-TOKEN Not Matched!'
                ]);
                break;

            // HttpException 异常处理
            case $exception instanceof HttpException:
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'msg' => $exception->getMessage()
                ]);
                break;

            default :
                return parent::render($request, $exception);
                break;
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     *
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['code' => 401, 'msg' => 'Unauthenticated.']);
        }
    }

}
