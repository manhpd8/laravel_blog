@extends('homeLayout')
@section('content')       
    <div class="bmcell_r"><img src="/blog2/public/img/icon.png"><span>Post</span></div>
    @foreach($allnews as $news)
        <li class="bmcell_sub">
            <a href="/blog2/public/news/newsid/{{$news->news_id}}">{{substr($news->news_name,0,51)}}</a>
            <span style="color: #000">({{$news->created_at}}) -{{$news->news_author}}</span>
            <button type="button" onclick="setCookie('news{{$news->news_id}}','{{$news->news_id}}','1')" style="float: right" class="btn-info">add to cart</button>
        </li>
    @endforeach
    <button type="button" onclick="setCookie('name_cookie','gia tri tuong ung','1')">set cookie</button>
    <button type="button" onclick="getOnclick()">getCookie</button>
    <form method="post">
         {{ csrf_field ()}}
        <input type="text" name="listNews" id="listNews">
        <button type="submit">gui list len</button>
    </form>
@endsection
