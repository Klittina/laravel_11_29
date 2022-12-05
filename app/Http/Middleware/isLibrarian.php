<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLibrarian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->permission == 0 or Auth::user()->permission == 2) {
            return $next($request);
            //0 az admin 2 a librarian amit a librarian elér azt az admin is eléri, de egy sima felhasználó már nem
            //
        }
        return redirect('dashboard')->with('error', 'You have not admin access');
    }
}
