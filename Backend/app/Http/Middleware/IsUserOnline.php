<?php

namespace Backend\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
use Cache;

class IsUserOnline
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If user logged then create cache data on the 5 minutes.
        if (Auth::check()) {
            $user = Auth::user();

            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . $user->id, true, $expiresAt);

        }

        return $next($request);
    }
}
