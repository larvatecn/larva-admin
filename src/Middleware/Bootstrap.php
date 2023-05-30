<?php

namespace Larva\Admin\Middleware;

use Closure;
use Illuminate\Http\Request;
use Larva\Admin\Admin;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Admin::bootstrap();

        return $next($request);
    }

}
