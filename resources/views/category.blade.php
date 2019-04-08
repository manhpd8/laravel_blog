@extends('homeLayout')
@section('content')
    <div class="bmcell_r"><img src="/blog2/public/img/icon.png"><span>{{$category->cat_name}}</span></div>
    @foreach($listNews as $news)
        <li class="bmcell_sub"><a href="/blog2/public/news/newsid/{{$news->news_id}}">{{substr( $news->news_name,  0, 100)}}</a></li>
    @endforeach
@stop