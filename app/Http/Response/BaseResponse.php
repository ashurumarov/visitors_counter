<?php
declare(strict_types=1);

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class BaseResponse extends JsonResponse
{

    protected function response(mixed $data, int $status): array
    {
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
}
