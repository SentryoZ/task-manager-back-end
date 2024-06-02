<?php

namespace App\Http\Response;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Response
{
    const SUCCESS = 200;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const SERVER_ERROR = 500;

    /**
     * @param array|Model|ResourceCollection $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function response(
        Model|JsonResource|array $data,
        string                   $message,
        string                   $debugMessage,
        int                      $statusCode
    ): JsonResponse
    {
        if ($data instanceof ResourceCollection) {
            $data = $data->resolve();
        }
        if ($data instanceof Model) {
            $data = $data->toArray();
        }

        return response()->json([
            'message' => __($message),
            'debug_message' => $debugMessage,
            'data' => $data
        ], $statusCode);
    }

    public static function successResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::SUCCESS
    ): JsonResponse
    {
        return self::response($data, $message, $debugMessage, $statusCode);
    }

    public static function notFoundResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::NOT_FOUND
    ): JsonResponse
    {
        return self::response($data, $message, $debugMessage, $statusCode);
    }

    public static function unauthorizedResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::UNAUTHORIZED
    ): JsonResponse
    {
        return self::response($data, $message, $debugMessage, $statusCode);
    }

    public static function serverErrorResponse(
        $data = [],
        $message = "",
        $debugMessage = "",
        $statusCode = self::SERVER_ERROR
    ): JsonResponse
    {
        return self::response($data, $message, $debugMessage, $statusCode);
    }

}
