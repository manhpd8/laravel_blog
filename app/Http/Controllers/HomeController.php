<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{   
    //
    public static function getData(){
        $page_size = 19;
        $data['categories'] = DB::table('blog_category')->where('cat_id','<>','0')->take(7)->get()->toArray();
        $data['newspost'] = DB::table('blog_news')->orderby('created_at','desc')->take(9)->get()->toarray();
        $data['viewpost'] = DB::table('blog_news')->orderby('news_seen','desc')->take(7)->get()->toarray();
        
        return $data;
    }
    public function getHome(){
    	return redirect()->action('HomeController@getHomePage',['page' => 0]);
    }
    public function getHomePage($page){
        $page_size = 19;
        $data = HomeController::getData();
        $numRecord = DB::select('SELECT count(*) as size FROM laravel_blog.blog_news,blog_category where blog_news.cat_id = blog_category.cat_id');
        $maxpage = (int)($numRecord[0]->size/$page_size);
        $data['maxpage'] = $maxpage;
        $data['allnews'] = DB::select('SELECT blog_news.*,blog_category.cat_name FROM laravel_blog.blog_news,blog_category where blog_news.cat_id = blog_category.cat_id limit '.$page*$page_size.', '.$page_size);
        return view('home',$data);
    }

    public function getCart(){
        $data = HomeController::getData();
        $data['allnews'] = DB::select('SELECT blog_news.*,blog_category.cat_name FROM laravel_blog.blog_news,blog_category where blog_news.cat_id = blog_category.cat_id');
        return view('products',$data);
    }
}
