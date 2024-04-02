<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            Cache::put('user-is-online' . Auth::user()->id, true,Carbon::now()->addSeconds(30));
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
         }
        if($request->user()->role !== $role){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
