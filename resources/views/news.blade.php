@foreach($listNews as $news)
    <a href="./category/{{$news->cat_id}}"><li class="hmcell">{{ $news->news_name }}</li></a>
@endforeach