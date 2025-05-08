<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
   
    }

    public function boot(): void
    {
     
        JsonResource::withoutWrapping();
        
      
        Response::macro('api', function ($data = null, string $message = '', int $status = 200, array $headers = []) {
            return response()->json([
                'status' => $status >= 200 && $status < 300,
                'message' => $message,
                'data' => $data,
            ], $status, $headers);
        });
    }
} 