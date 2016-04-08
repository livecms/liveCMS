@extends(theme('front'))

@section('content')

        <!--
        ==================================================
        Slider Section Start
        ================================================== -->
        <section id="hero-area" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="block wow fadeInUp" data-wow-delay=".3s">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#main-slider-->

        <!--
        ==================================================
        Slider Section Start
        ================================================== -->
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="block wow fadeInLeft" data-wow-delay=".3s" data-wow-duration="500ms">
                            <h2>
                            {{ child($post, 'about-live-cms', 'title') }}
                            </h2>
                            {!! child($post, 'about-live-cms') !!}
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="block wow fadeInRight" data-wow-delay=".3s" data-wow-duration="500ms">
                            <img src="{{ child($post, 'about-live-cms', 'picture') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- /#about -->
        
        <!--
        ==================================================
        Portfolio Section Start
        ================================================== -->
        <section id="works" class="works">
            <div class="container">
                <div class="section-heading">
                    <h1 class="title wow fadeInDown" data-wow-delay=".3s">Latest Works</h1>
                    <p class="wow fadeInDown" data-wow-delay=".5s">
                        Aliquam lobortis. Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Nulla sit amet est. Aenean posuere <br> tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus.
                    </p>
                </div>
                <div class="row">
                    @for ($i = 0; $i < count($projects = get('project')); $i++)
                    <?php $project = $projects[$i]; ?>
                    <div class="col-sm-4 col-xs-12">
                        <figure class="wow fadeInLeft animated portfolio-item" data-wow-duration="500ms" data-wow-delay="{{$i*300}}ms">
                            <div class="img-wrapper">
                                @if ($project->picture)
                                <img src="{{$project->picture}}" class="img-responsive" alt="project image" >
                                @endif
                                <div class="overlay">
                                    <div class="buttons">
                                        <a rel="gallery" class="fancybox" href="{{$project->picture}}">Demo</a>
                                        <a target="_blank" href="{{$project->url}}">Details</a>
                                    </div>
                                </div>
                            </div>
                            <figcaption>
                            <h4>
                            <a href="{{$project->url}}">
                                {{$project->title}}
                            </a>
                            </h4>
                            <p>
                                {{dataImplode($project->categories, 'category')}}
                            </p>
                            </figcaption>
                        </figure>
                    </div>
                    @endfor
                </div>
            </div>
        </section> <!-- #works -->

        <!--
        ==================================================
        Portfolio Section Start
        ================================================== -->
        <section id="feature">
            <div class="container">
                <div class="section-heading">
                    <h1 class="title wow fadeInDown" data-wow-delay=".3s">
                        {{ child($post, 'what-live-cms-offer', 'title') }}
                    </h1>
                </div>
                {!! child($post, 'what-live-cms-offer') !!}
            </div>
        </section> <!-- /#feature -->
@endsection