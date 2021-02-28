<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    public function handle($request, Closure $next)
    {
        if ($request->path() == 'pegawai') {
            return abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
