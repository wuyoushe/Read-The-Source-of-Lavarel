<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 中间件分为三类，分别是全局中间件，中间件组合指定路由中间件
     */
    public function handle($request, Closure $next)
    {
        if($request->input('token') != 'laravelacademy.org'){
            return redirect()->to('http://laravelacademy.org');
        }
        /*定义好了中间件的逻辑之后，要让这个中间件生效，还要将其注册到指定的路由中*/
        return $next($request);
    }
}
