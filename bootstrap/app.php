<?php

use App\Const\HttpConst;
use App\Http\Response\Response;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception) {
            return Response::notFoundResponse(message: "Not Found", debugMessage: $exception->getMessage());
        });
        $exceptions->render(function (ValidationException $exception) {
            return Response::validatedFailResponse(
                errors: $exception->errors(),
                message: __('validation.failed'),
            );
        });
        $exceptions->render(function (AccessDeniedHttpException $exception){
            return Response::unauthorizedResponse(message: $exception->getMessage(),statusCode: HttpConst::FORBIDDEN);
        });
        $exceptions->render(function (Exception $exception) {
            return Response::serverErrorResponse(errors: $exception->getTrace(), message: "Server Error", debugMessage: $exception->getMessage());
        });
    })->create();
