<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array|null $data
     * @param array $meta
     * @return JsonResponse
     */
    public function response200($data = [], $meta = [], $mess = 'Successfully!'): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'status'   => 200,
            'message' => $mess,
            'data' => $data,
            'meta' => $meta,
        ]);
    }

    /**
     * @param null $msg
     *
     * @return JsonResponse
     */
    public function response400($msg = null): JsonResponse
    {
        $msg = $msg ?? trans('response.error_400');

        return response()->json([
            'message' => $msg,
        ], 400);
    }

    /**
     * @param null $msg
     *
     * @return JsonResponse
     */
    public function response500($msg = null): JsonResponse
    {
        $msg = $msg ?? trans('response.error_500');

        return response()->json([
            'message' => $msg,
        ], 500);
    }
}
