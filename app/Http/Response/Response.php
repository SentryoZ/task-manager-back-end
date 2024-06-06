<?php

namespace App\Http\Response;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class Response
{
    const SUCCESS = 200;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const UNPROCESSABLE_CONTENT = 422;
    const SERVER_ERROR = 500;

    public static function successResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::SUCCESS
    ): JsonResponse
    {
        return self::response($data, $message, $debugMessage, $statusCode);
    }

    /**
     * @param array|Model|ResourceCollection $data
     * @param array|null $errors
     * @param string $message
     * @param string $debugMessage
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function response(
        Model|JsonResource|array $data = [],
        ?array                   $errors = null,
        string                   $message = '',
        string                   $debugMessage = '',
        int                      $statusCode = 200
    ): JsonResponse
    {
        if ($data instanceof ResourceCollection) {
            $data = $data->resolve();
        }
        if ($data instanceof Model) {
            $data = $data->toArray();
        }
        $response = [
            'message' => __($message),
            'debug_message' => $debugMessage,
            'data' => $data,
        ];

        if (!is_null($errors)) {
            Arr::set($response, 'errors', $errors);
        }
        return response()->json($response, $statusCode);
    }

    public static function notFoundResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::NOT_FOUND
    ): JsonResponse
    {
        return self::response(
            data: $data,
            message: $message,
            debugMessage: $debugMessage,
            statusCode: $statusCode
        );
    }

    public static function unauthorizedResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::UNAUTHORIZED
    ): JsonResponse
    {
        return self::response(
            data: $data,
            message: $message,
            debugMessage: $debugMessage,
            statusCode: $statusCode
        );
    }

    public static function serverErrorResponse(
        $data = [],
        $errors = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::SERVER_ERROR
    ): JsonResponse
    {
        return self::response(
            data: $data,
            errors: $errors,
            message: $message,
            debugMessage: $debugMessage,
            statusCode: $statusCode
        );
    }

    public static function validatedFailResponse(
        $data = [],
        $errors = null,
        $message = "",
        $debugMessage = "",
        $statusCode = self::UNPROCESSABLE_CONTENT
    ): JsonResponse
    {
        return self::response(
            data: $data,
            errors: $errors,
            message: $message,
            debugMessage: $debugMessage,
            statusCode: $statusCode
        );
    }

}
