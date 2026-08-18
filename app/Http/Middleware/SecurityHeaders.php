<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers to the response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Basic recommended security headers. Use Report-Only for CSP initially to avoid breaking the app.
        $headers = [
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'no-referrer-when-downgrade',
            'X-XSS-Protection' => '1; mode=block',
            // Permissions-Policy (formerly Feature-Policy) - restrict commonly-abused features
            'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',
            // Legacy and modern CSP headers. Use Report-Only to start safely.
            'X-Content-Security-Policy' => "default-src 'self'; object-src 'none'; frame-ancestors 'self'; base-uri 'self';",
            'Content-Security-Policy-Report-Only' => "default-src 'self'; object-src 'none'; frame-ancestors 'self'; base-uri 'self';",
        ];

        // Add HSTS only on secure requests
        if ($request->isSecure()) {
            $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains; preload';
        }

        foreach ($headers as $name => $value) {
            if (! $response->headers->has($name)) {
                $response->headers->set($name, $value);
            }
        }

        return $response;
    }
}
