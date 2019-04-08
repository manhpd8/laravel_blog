<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
class CheckLogin
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
        if(Session::has('login')){
            $coditions=[
                'user_name'=>Session::get('login')->user_name,
                'user_pass'=>Session::get('login')->user_pass,
                'user_level'=>'1'
            ];
            if(DB::table('blog_users')->where($coditions)->count() ==1){
                return redirect()->action('HomeController@getHome');
            }
            else{
                return $next($request);
            }
        }
        else{
            return $next($request);
        }
        
    }
}
