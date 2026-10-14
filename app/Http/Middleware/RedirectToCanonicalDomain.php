<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToCanonicalDomain
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();

        if (in_array($host, ['infortom-1.onrender.com', 'www.infortom.fr'])) {
            return redirect()->to('https://infortom.fr' . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
