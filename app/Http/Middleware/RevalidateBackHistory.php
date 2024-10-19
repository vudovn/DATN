<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RevalidateBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    $response = $next($request);
    $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    $response->header('Pragma', 'no-cache');
    $response->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    return $response;
    }
}