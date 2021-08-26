<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Swift_TransportException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
        $this->renderable(function (NotFoundHttpException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Object Not Found',
                    'Error_detail'=>[$e]],200);
            }
        });
        $this->renderable(function (RouteNotFoundException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Unauthorized',
                    'Error_detail'=>[$e->getMessage()]],200);
            }
        });
        $this->renderable(function (MethodNotAllowedHttpException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Wrong Request Method Used',
                    'Error_detail'=>[$e->getMessage()]
                ],200);
            }
        });
        $this->renderable(function (BadMethodCallException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Wrong Method Used',
                    'Error_detail'=>[$e->getMessage()]
                ],200);
            }
        });
        $this->renderable(function (QueryException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Problem with SQL Query',
                    'Error_detail'=>[$e->getMessage()]
                ],200);
            }
        });
        $this->renderable(function (Swift_TransportException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'No Internet Connection',
                    'Error_detail'=>[$e->getMessage()]
                ],200);
            }
        });
        $this->renderable(function (ThrottleRequestsException $e,$request) {
            //
            if($request->is('api/*')){
                return response()->json([
                    'Message' => 'Too many Attempt.Try Later ',
                    'Error_detail'=>[$e->getMessage()]
                ],200);
            }
        });

        


    }

}
