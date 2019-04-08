@extends('homeLayout')
@section('content')       
    <div class="bmcell_r"><img src="/blog2/public/img/icon.png"><span>Shopping cart</span></div>
    @if(isset($listCart))
        @foreach($listCart as $news)
            <li class="bmcell_sub" id="news{{$news->news_id}}">
                <a href="/blog2/public/news/newsid/{{$news->news_id}}">{{substr($news->news_name,0,51)}}</a>
                <span style="color: #000">({{$news->created_at}}) -{{$news->news_author}}</span>
                <button type="button" onclick="delCart('news{{$news->news_id}}')" style="float: right" class="btn-danger">remove to cart</button>
            </li>
        @endforeach
    @endif
@endsection
