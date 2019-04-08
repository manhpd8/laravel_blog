<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\blog_news;
class TestEloquent extends Controller
{
    function getAll(){
        $all_news = blog_news::paginate(5);
        $data['all_news'] = $all_news;
        return view('eloquent_news',$data);
    }
}
?>