<?php

namespace App\Http\Middleware;

use Closure;

class ApiAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        // Pastikan permintaan berasal dari aplikasi frontend atau localhost
        $allowedOrigins = [
            'http://localhost:5173', // Ganti dengan URL aplikasi frontend Anda jika berbeda
            'http://localhost:8000'  // Ganti dengan URL server API jika berbeda
        ];

        if (!in_array($request->header('Origin'), $allowedOrigins)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
