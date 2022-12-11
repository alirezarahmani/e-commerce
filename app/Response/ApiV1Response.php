<?php

declare(strict_types=1);

namespace App\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiV1Response
{

    public static function success($data = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $status);
    }

    public static function failed($message, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json($message, $status);
    }
}
