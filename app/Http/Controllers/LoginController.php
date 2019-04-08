<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#use Illuminate\Contracts\Validation\Validator;
use Validator;
use DB;
use Session;
class LoginController extends Controller
{
	public function getLogin(){
    	#echo "string";
		return view('admin.login.view');
	}
	public function postLogin(Request $request){
		$rules = [
			'user'=>'required',
			'pass'=>'required',
		];
		$messages = [
			'user.required'=>'tài khoản không được để trống',

			'pass.required'=>'mật khẩu không được để trống',
		];
		$Validator = Validator::make($request->all(),$rules,$messages);
		// input
		$name =  $request->input('user');
		$pass = $request->input('pass');
		if($Validator->fails()){
			echo "loi validator";
			$errors['errors']=$Validator->errors();
			return response()->view('admin.login.view',$errors);
			
		}
		else{
			$name =  $request->input('user');
			$pass = $request->input('pass');
			$path = $request->path();
			$url = $request->url();
			#$fullurl = $requet->fullurl();
			$method = $request->method();
			$coditions = [
				'user_name'=>$name,
				'user_pass'=>$pass,
				'user_level' => '1'
			];
			// check db
			if(DB::table('blog_users')->where($coditions)->count() > 0){
				// luu cookie nguoi dung
				$minutes =200;
				$cookie = cookie('cookie_user', $name, $minutes);
				//luu session
				$data = DB::table('blog_users')->where($coditions)->first();
				Session::put('login',$data);
				$errors['success']='dang nhap thanh cong';
				//return redirect()->action('HomeController@getHome');
				//return response()->view('home');//->withCookie($cookie);
				return view('admin.index');

			} else{
				echo 'login false';
				Session::flash('error','sai tai khoan mat khau');
				return response()->view('admin.login.view');
			}
		}
	}

	public function showLoginForm(Request $request){
		$name = $request->cookie('cookie_user');
		return view('admin.login.view')->with(['name'=> $name]);
	}

	public function home(){
		return view('home');
	}
	public function getLogout(){
		Session::flush();

		return redirect()->intended('login');
	}

	public function getIndex(){
		return view('admin.index');
	}

}
