<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoryCount
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
        if (Category::all()->count() == 0) {
            session()->flash('info', 'You must have atleast a category before attempting to create a post');
            return redirect(route('categories'));
        }
        return $next($request);
    }
}
