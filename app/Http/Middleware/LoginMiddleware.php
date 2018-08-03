<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LoginMiddleware
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
        //只有admin管理员才可以登录
        if(session('user_id')==1){
            return $next($request);
        }

        //记录上一页面
        if(array_key_exists('HTTP_REFERER',$_SERVER)){
            Log::info('记录上一个页面',[$_SERVER['HTTP_REFERER']]);
            session(['redirectUrl' => $_SERVER['HTTP_REFERER']]);
        }
        return redirect('admin/login');

    }
}
