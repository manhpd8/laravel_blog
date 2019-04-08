<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
class ClientController extends Controller
{
	function getLogin(Request $request){
		$urlBack = $request->input('urlBack');

		$data['urlBack'] = $urlBack;
		return view('client.login',$data);
	}
	function postLogin(Request $request){
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
		$urlBack = $request->input('urlBack');
		if($Validator->fails()){
			echo "loi validator";
			$errors['errors']=$Validator->errors();
			$errors['urlBack'] = $urlBack;
			return redirect()->back()->with($errors);
			
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
			];
			// check db
			if(DB::table('blog_users')->where($coditions)->count() > 0){
				// luu cookie nguoi dung
				$minutes =200;
				$cookie = cookie('cookieLoginClient', $name, $minutes);
				//luu session
				$data = DB::table('blog_users')->where($coditions)->first();
				Session::put('sessionLoginClient',$data);
				$errors['success']='dang nhap thanh cong';
				if(!StringUtility::isNull($urlBack)){
					return redirect($urlBack);
				}
				return redirect()->action('HomeController@getHome');
				//return response()->view('home');//->withCookie($cookie);
				

			} else{
				echo 'login false';
				Session::flash('error','sai tai khoan mat khau');
				$errors['urlBack'] = $urlBack;
				return redirect()->back()->with($errors);
			}
		}
	}

	function getRegister(){
		return view('client.register');
	}
	function postRegister(Request $request){
		$arr['user_name'] = $request->user_name;
		$arr['user_pass'] = $request->user_pass;
		if(StringUtility::isNull($arr['user_name'])){
			$errors['errors'] = ['null'=>'tai khoan khong duoc de trong'];
			return redirect()->back()->with($errors);
		}
		$arr['created_at'] = gmdate("Y-m-d H:i:s",time()+7*3600);
		$count = DB::select('select count(*) as num from blog_users where user_name ="'.$arr['user_name'].'"');
		if($count[0]->num == 0 ){
			DB::table('blog_users')->insert($arr);
			$error['success'] = 'dang ky thanh cong';
			return view('client.login');
		}
		$errors['errors'] = ['duplicate'=>'tai khoan da ton tai'];
		return redirect()->back()->with($errors);
	}

	public function getLogout(){
		Session::flush();
		return redirect()->back();
	}
}