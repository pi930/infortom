<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceDomain
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('production') && $request->getHost() !== 'infortom.fr') {
            return redirect()->to('https://infortom.fr' . $request->getRequestUri(), 301);
        }
        return $next($request);
    }
}
