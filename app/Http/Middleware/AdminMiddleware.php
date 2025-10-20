<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('home')->with('error', 'Silakan login.');
        }
        // If the model provides an is_admin/role attribute, respect it. Otherwise allow access.
        if (property_exists($user, 'is_admin') && !$user->is_admin) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses admin.');
        }
        return $next($request);
    }
}


