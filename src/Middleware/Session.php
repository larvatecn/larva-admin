<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Middleware;

use Closure;
use Illuminate\Http\Request;

class Session
{
    public function handle(Request $request, Closure $next)
    {
        $path = '/' . trim(config('admin.route.prefix'), '/');

        config(['session.path' => $path]);

        if ($domain = config('admin.route.domain')) {
            config(['session.domain' => $domain]);
        }

        return $next($request);
    }
}
