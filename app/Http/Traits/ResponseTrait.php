<?php

namespace App\Http\Traits;

trait ResponseTrait
{
    public function success($message, $data = null): \Illuminate\Http\JsonResponse
    {
        return $this->sendSuccessResponse($message, $data, 201);
    }

    public function sendSuccessOfOkResponse($message, $data = null): \Illuminate\Http\JsonResponse
    {
        return $this->sendSuccessResponse($message, $data, 200);
    }

    public function sendErrorOfBadResponse($message): \Illuminate\Http\JsonResponse
    {
        return $this->sendErrorResponse($message, 400);
    }

    public function sendSuccessResponse(string $message, $data = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        $resp = [
            'success' => true,
            'message' => $message,
            'code' => $code,
        ];
        if ($data) {
            $resp['data'] = $data;
        }
        return response()->json($resp, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @param null $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendErrorResponse($message, $code = 500, $errors = null): \Illuminate\Http\JsonResponse
    {
        $resp = [
            'success' => false,
            'message' => $message,
            'code' => $code,
        ];
        if ($errors) {
            $resp['errors'] = $errors;
        }
        return response()->json($resp, $code);
    }

    /**
     * @param $content
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFileContentResponse($content): \Illuminate\Http\JsonResponse
    {
        return response()->json($content);
    }
}
