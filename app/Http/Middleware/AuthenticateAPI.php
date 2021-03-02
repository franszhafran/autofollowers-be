<?php

namespace App\Http\Middleware;

use App\Services\JWTAuthenticationService;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class AuthenticateAPI
{
    use ApiResponse;

    public function __construct(
        private JWTAuthenticationService $authenticationService,
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->authenticationService->getAuthenticatedUserId($request->cookie('token'));
        } catch (\Exception $e) {
            return $this->sendError(null, "Authentication failed");
        }

        return $next($request);
    }
}
