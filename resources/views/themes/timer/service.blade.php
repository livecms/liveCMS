@extends(theme('front'))

@section('content')
         

        <!-- 
        ================================================== 
            Global Page Section Start
        ================================================== -->
        <section class="global-page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2>{{$post->title}}</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.html">
                                        <i class="ion-ios-home"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">{{ $post->title }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 
        ================================================== 
            Company Description Section Start
        ================================================== -->
        <section id="service-page" class="pages service-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            <img src="{{ $post->picture }}" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>

                <!-- 
        ================================================== 
            Works Section Start
        ================================================== -->
        <section class="works service-page">
            <div class="container">
                <h2 class="subtitle wow fadeInUp animated" data-wow-delay=".3s" data-wow-duration="500ms">Some Of Our Features Works</h2>
                    <p class="subtitle-des wow fadeInUp animated" data-wow-delay=".5s" data-wow-duration="500ms">
                        Aliquam lobortis. Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Nulla sit amet est. Aenean posuere <br> tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus.
                    </p>
                <div class="row">
                    @for ($i = 0; $i < count($projects = get('project')); $i++)
                    <?php $project = $projects[$i]; ?>
                    <div class="col-sm-3">
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
        </section>
                   
        <!--
        ==================================================
        Clients Section Start
        ================================================== -->
        <section id="clients">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="subtitle text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">Our Happy Clinets</h2>
                        <p class="subtitle-des text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, error.</p>
                        <div id="clients-logo" class="owl-carousel">
                            @foreach ($clients = get('client') as $client)
                            <div>
                                <img src="{{$client->picture}}" title="{{$client->name}}" alt="client image">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection