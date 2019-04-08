<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
	public function getCart(){
		$data = HomeController::getData();
        $data['allnews'] = DB::select('SELECT blog_news.*,blog_category.cat_name FROM laravel_blog.blog_news,blog_category where blog_news.cat_id = blog_category.cat_id');
        return view('cart.cart',$data);
	}
	public function postCart(Request $request){
		$listNewsId = $request->input('listNews');
		$listNewsId = explode(' ',$listNewsId);
		$sql = "SELECT blog_news.*,blog_category.cat_name FROM laravel_blog.blog_news,blog_category where blog_news.cat_id = blog_category.cat_id and( 1=0 ";
		if(count($listNewsId) <=1 && strlen($listNewsId[0]) <= 0){
			return redirect()->action('CartController@getCart');
		}
		for ($i=0; $i < count($listNewsId); $i++) { 
			$sql = $sql.' or blog_news.news_id = '.$listNewsId[$i];
		}
		$sql= $sql.')';
		$data = HomeController::getData();
        $data['listCart'] = DB::select($sql);
        return view('cart.cart',$data);

		
	}
}