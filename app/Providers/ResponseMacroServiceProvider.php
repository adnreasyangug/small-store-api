<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('successMessage', function (string $message, int $status = ResponseAlias::HTTP_OK) {
            return Response::json([
                'errors' => false,
                'message' => $message,
            ], $status);
        });

        Response::macro('success', function (array $data, int $status = ResponseAlias::HTTP_OK) {
            return Response::json([
                'errors' => false,
                'data' => $data,
            ], $status);
        });
    }
}
