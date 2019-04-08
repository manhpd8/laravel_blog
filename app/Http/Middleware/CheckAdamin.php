<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
class CheckAdamin
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
                return $next($request);
            }
            else{
                
                return redirect()->action('LoginController@getLogin');
            }
        }
        else{
            return redirect()->action('LoginController@getLogin');
        }
    }
}
