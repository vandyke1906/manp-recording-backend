<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);
        $allowedOrigins = [
            'http://localhost:5173',
            'https://mountapo-app.netlify.app',
            'http://mountapo-app.netlify.app',
        ];

        $origin = $request->headers->get('Origin');

        if ($request->isMethod('OPTIONS')) {
            if (in_array($origin, $allowedOrigins)) {
                return response()->json([], 200, [
                    'Access-Control-Allow-Origin' => $origin,
                    'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                    'Vary' => 'Origin',
                ]);
            } else {
                return response()->json(['message' => 'CORS not allowed.'], 403);
            }
        }

        // Handle actual request
        $response = $next($request);

        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->headers->set('Vary', 'Origin');
        }

        return $response;
    }
}
