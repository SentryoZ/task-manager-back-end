<?php

namespace App\Http\Response;

use App\Const\HttpConst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class Response
{

    public static function successResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = HttpConst::OK
    ): JsonResponse
    {
        return self::response(
            data: $data,
            message: $message,
            debugMessage: $debugMessage,
            statusCode: $statusCode
        );
    }

    /**
     * @param array|Model|ResourceCollection $data
     * @param array|string|null $errors
     * @param string $message
     * @param string $debugMessage
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function response(
        Model|JsonResource|array $data = [],
        array|string|null        $errors = null,
        string                   $message = '',
        string                   $debugMessage = '',
        int                      $statusCode = HttpConst::OK
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
        $statusCode = HttpConst::NOT_FOUND
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
        $statusCode = HttpConst::UNAUTHORIZED
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
        $statusCode = HttpConst::INTERNAL_SERVER_ERROR
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
        $statusCode = HttpConst::UNPROCESSABLE_CONTENT
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
