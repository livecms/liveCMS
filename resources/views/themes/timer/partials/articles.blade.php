@foreach ($articles as $article)
<article class="wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">
    <div class="blog-post-image">
        <a href="{{$article->url}}"><img class="img-responsive" src="{{$article->picture}}" alt="" /></a>
    </div>
    <div class="blog-content">
        <h2 class="blogpost-title">
        <a href="{{$article->url}}">{{$article->title}}</a>
        </h2>
        <div class="blog-meta">
            <span>{{$article->published_at->diffForHumans(   )}}</span>
            <span>by <a href="">{{$article->author->name}}</a></span>
            <span>in {{dataImplode($article->categories, 'category')}}</a></span>
            <span>Tags : {{dataImplode($article->tags, 'tag')}}</span>
        </div>
        <p>
            {{str_limit(strip_tags($article->content, 300))}}
        </p>
        <a href="{{$article->url}}" class="btn btn-dafault btn-details">Continue Reading</a>
    </div>
</article>
@endforeach

<ul class="pager" @if (!$articles->nextPageUrl()) style="display: none;" @endif ><li><a href="{{$articles->nextPageUrl()}}" rel="prev">@if ($articles->nextPageUrl())Next @else -------- @endif</a></li> </ul>

