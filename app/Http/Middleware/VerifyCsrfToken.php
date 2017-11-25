<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'stripe/webhook/*'
    ];

  //   public function handle($request, Closure $next, $guard = null)
  //   {
  //       if ($request->is('stripe/webhook')) {
		// 	return $this->addCookieToResponse($request, $next($request));
		// }
  //   }
}
