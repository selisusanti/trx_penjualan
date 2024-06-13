<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Services\Response;
use App\Http\Helpers\GlobalHelper;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{ 
    /**
    * A list of the exception types that are not reported.
    *
    * @var array
    */
    protected $dontReport = [
        ApplicationException::class
    ];

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            // $error_code     = $e->getCode();
            // $error_message  = $e->getMessage();

            // if ($e instanceof ApplicationException)
            // {
            //     $http_status_code = $e->getStatusCode();
            // }
            // elseif ($e instanceof HttpResponseException)
            // {
            //     $error_code = $e->getStatusCode();
            //     $http_status_code = $e->getStatusCode();
            // }
            // elseif ($e instanceof HttpException)
            // {
            //     $error_code = $e->getStatusCode();
            //     $http_status_code = $e->getStatusCode();
            // }
            // else
            // {
            //     $resource = GlobalHelper::getResourceError('errors.application_error');
            //     if ($e instanceof ValidationException) {
            //         $resource['message'] = $e->validator->errors()->first();
            //         $resource['code'] = 4200;
            //         $resource['status_code'] = 422;
            //     }
            //     elseif ($e instanceof QueryException)
            //         $resource = GlobalHelper::getResourceError('errors.database_error');
            //         $error_message = $resource['message'];
            //         $error_code = $resource['code'];
            //         $http_status_code = $resource['status_code'];
            // }
            // return Response::error($error_message, $error_code, $http_status_code, $e);
        });
       
    }

}
