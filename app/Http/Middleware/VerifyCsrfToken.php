<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/createaccount',
        'api/login',
        'api/videos/upload',
        'api/videos/single/{id}',
        'api/videos/user/{id}',
        'api/videos/search/{query}',
        'api/videos/cat/{cat}/{subcat}',
        'api/videos/{cat}',
        'api/podcasts/upload',
        'api/podcasts/{id}',
    ];
}