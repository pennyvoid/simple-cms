<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ProtectMainAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->mainAdmin()) {
            session()->flash('info', 'You dont have permission to perform this action');
            return redirect(route('users'));
        }
        return $next($request);
    }
}
