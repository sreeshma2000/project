<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($request): ?string
    {
        return $request->expectsJson() ?null: route('admin.adminlogin');
    }
    protected function authenticate($request, array $guards)
    {
       
            if($this->auth->guard('admin')->check()){
                return $this->auth->shouldUse('admin');
            }
    
        $this->unauthenticated($request,['admin']);
    }
}
?>