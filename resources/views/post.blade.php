@extends('homeLayout')
@section('content')
    <div>
        <div class="bmcell_r"><img src="/blog2/public/img/icon.png">{{$news->news_name}}
            <button type="button" onclick="addCart('news{{$news->news_id}}','{{$news->news_id}}','1')" style="float: right" class="btn btn-warning" id="addnews{{$news->news_id}}">add to cart</button></div>
        <div class="bmcell_r_sub">
            <div id="bmcell_r_img1"></div>
            <div class="bmcell_r_con">
                <p class="bmcell_r_con_tit">author: {{substr( $news->news_author,  0, 41)}}</p>
                <p class="bmcell_r_con_p">{{$news->news_content}}</p>
            </div>
        </div>
    </div>
    <br style="clear: both;">
    <div id="rate" >
        @for($lRate=1;$lRate<=5;$lRate++)
            <button class="btn btn-default" onclick="onclickRate(this)" value="{{$lRate}}">
                @for($lImg=1;$lImg<=$lRate;$lImg++)
                    <img src="/blog2/public/img/icon-rate.png" class="img-rate">
                @endfor
                @foreach($rates as $rate)
                    @if($rate->rate == $lRate)
                        {{$rate->num}}
                    @endif
                @endforeach
            </button>
        @endfor
        
        <button class="btn btn-default">{{Round($ratesAvg[0]->avg)}}/5</button>
        <div ><button class="btn btn-default" id="danhgia">Đánh giá /5</button></div>
    </div>
    <div class="comment">
            @if(Session::has('sessionLoginClient'))
            <form action="/blog2/public/comment" method="post">
                {{ csrf_field() }}
                <input type="" name="rate"  id="rateStar" value="0" hidden="true">
                <textarea style="width: 90%; height: 100px" name="comment_content"></textarea>
                <input type="" name="news_id" value="{{$news->news_id}}" hidden="true"/>
                <button type="submit" class="btn btn-primary" style="">Comment</button>
                <input type="" name="user_id" value="{{Session::get('sessionLoginClient')->user_id}}" hidden="true">
            </form>
            @else
                <div>   
                    <form action="/blog2/public/client/login" method="get">
                        {{ csrf_field() }}
                        <input type="" name="urlBack" value="/news/newsid/{{$news->news_id}}" hidden="true">
                        <a href="/blog2/public/client/register"><button class="btn btn-info" type="button">Đăng ký</button></a>
                        <button class="btn btn-primary" type="submit">Đăng nhập</button>

                    </form>
                </div>
            @endif
        
    </div>
    <div>
        @foreach($comments as $comment)
            <div class="comment2" >{{$comment->user_name}}: {{$comment->comment_content}} ({{$comment->created_at}})</div>
        @endforeach
    </div>
<style type="text/css">
.comment{
    /*background-color: blue;*/
    height: 150px;
}
.comment2{
    padding: 7px;
    background-color:#B9AFAF;
    margin: 0;
    margin-top: 3px;
    width: 90%;
    margin-left: 5%;
}
.img-rate{
    height: 10px;
}
</style>
@stop

