<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class Permission
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->role_admin) {
            if (!($request->is(Role::getListPermission()))) {
                return abort(403, 'Forbidden');
            }
        }

        return $next($request);
    }
}
