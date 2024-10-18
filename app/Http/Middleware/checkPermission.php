<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;


class checkPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $currentAction = explode('Controller@', class_basename(Route::currentRouteAction()));
    $action = $currentAction[1] === 'store' ? 'create' : ($currentAction[1] === 'update' ? 'edit' : $currentAction[1]);
    $permission = $currentAction[0] .' '. $action;
    if (!Auth::user()->hasPermissionTo($permission)) {
        abort(403, 'Đủ trình không ʕ•ᴥ•ʔ');
    }

    return $next($request);
}

}
