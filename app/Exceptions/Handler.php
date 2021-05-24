<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Exceptions\Error;

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
    public function render($request, Throwable $exception)
    {

        // return parent::render($request, $exception);

        if($exception instanceof NotFoundHttpException){
            $error = new Error(404, "Resource not found.");
        } elseif ($exception instanceof QueryException) {
            $error = new Error(500, "An error occorred while trying to connect to the database.");
        } else {
            $error = new Error(500, "Internal server error.");
        }

        $response = ['status' => $error->getCode(),
                     'data' => null,
                     'errors' => [
                         'code' => $error->getCode(),
                         'type' => get_class($exception),
                         'message' => $exception->getMessage()
                     ]];

        return responder()->error(get_class($exception), $exception->getMessage())->respond();

        return response(json_encode($response), $error->getCode())
                        ->header('Content-Type', 'application/json');

        // return parent::render($request, $exception);
    }
}
