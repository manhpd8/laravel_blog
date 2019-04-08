@extends('homeLayout')
@section('content')
	<div class="bmcell_r"><img src="/blog2/public/img/icon.png"><span>Search</span></div>
    @foreach($allnews as $news)
        <li class="bmcell_sub">
        	<a href="/blog2/public/news/newsid/{{$news->news_id}}">{{substr($news->news_name,0,51)}}</a>
        	<span style="color: #000">({{$news->created_at}}) -{{$news->news_author}}</span>
        </li>
    @endforeach
    <div style="text-align: center; margin-top: 10px ">
	    @for($i=0;$i<=$maxpage;$i++)
	    	<button style="height: 30px;width: 30px"><a href="/blog2/public/{{$i}}/" style="color:  #007bff">{{$i+1}}</button></a>
	    @endfor
    </div>
@stop