<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminMiddleware
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
        if (Auth::check()) {
            if (Auth::user() -> role >=1) {
             return $next($request);
         }
     }
     else {
        return redirect()->route('admin.login')-> with(['error' => 'Bạn không có quyền truy cập trang này!']);
     }
     return redirect()->route('admin.login')->with(['error' => 'Bạn không có quyền truy cập trang này']);

 }
}
