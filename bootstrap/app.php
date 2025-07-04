<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(CorsMiddleware::class); // ✅ Ensure it is globally applied
        $middleware->prepend(ForceJsonResponse::class); // ✅ Ensure it is globally applied
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
         $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated.',
            'data' => null
        ], 401);
    });
    })->create();
