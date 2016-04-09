@extends(theme('front'))

@section('content')
         <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
        <div class="background-img">
            <img class="img-responsive" alt="{{$article->title}}" src="{{$article->picture}}">
        </div>
        <section class="single-post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <h1>{{$article->title}}</h1>
                            <div class="portfolio-meta">
                                <span>{{$article->published_at->diffForHumans()}}</span>|
                                <span> Category: {{dataImplode($article->categories, 'category')}}</span>|
                                <span> Tags: {{dataImplode($article->tags, 'tag')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="post-content">
                            {!!$article->content!!}
                        </div>
                        <ul class="social-share">
                            <h4>Share this article</h4>
                            <li>
                                <a href="#" class="facebook">
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="Twitter">
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="Linkedin">
                                    <i class="ion-social-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="Google Plus">
                                    <i class="ion-social-googleplus"></i>
                                </a>
                            </li>
                            
                        </ul>
                        
                    </div>
                </div>
            </div>
        </section>


@endsection

@section('script')
<script>
    $(function() {
        $('.articles').jscroll();
    });
</script>
@endsection
