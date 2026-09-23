<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Ignore Render proxies completely.
     */
    protected $proxies = '*';

    /**
     * Force Laravel to trust all forwarded headers.
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}

