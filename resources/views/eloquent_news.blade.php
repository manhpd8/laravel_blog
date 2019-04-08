<div class="container">
    @foreach ($all_news as $user)
        {{ $user->news_name }}<br>
    @endforeach
    {{ $all_news->links() }}
</div>