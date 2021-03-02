<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class Permission
{
    public function handle($request, Closure $next)
    {
        $modelRole = Role::where('user_id', auth()->user()->id)->with('menu')->get();
        $modelRole->map(function($query) {
            $query['url'] = $query->menu->url.'*';
        });

        $pluckRole = $modelRole->pluck('url')->toArray();

        if (!($request->is($pluckRole))) {
            return abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
