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
        <section class="company-description">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-delay=".3s" >
                        @if ($post->picture)
                        <img src="{{ $post->picture }}" alt="" class="img-responsive">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- 
        ================================================== 
            Company Feature Section Start
        ================================================== -->
        <section class="about-feature clearfix">
            <div class="container-fluid">
                <div class="row">
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="block about-feature-{{$i}} wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".{{ $i * 2 + 1 }}s">
                        <h2>
                            {{ child($post, $i-1, 'title')}}
                        </h2>
                        <p>
                            {!! child($post, $i-1) !!}
                        </p>
                    </div>
                    @endfor
                </div>
            </div>
        </section>


        <!-- 
        ================================================== 
            Team Section Start
        ================================================== -->
        <section id="team">
            <div class="container">
                <div class="row">
                    <h2 class="subtitle text-center">Meet The Team</h2>
                    @for ($i = 1; $i <= count($teams = get('team')); $i++)
                    <?php $team = $teams[$i-1]; ?>
                    <div class="col-md-3">
                        <div class="team-member wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".{{$i * 2 +1}}s">
                            <div class="team-img">
                                @if ($team->picture)
                                <img src="{{$team->picture}}" class="team-pic" alt="">
                                @endif
                            </div>
                            <h3 class="team_name">{{$team->name}}</h3>
                            <p class="team_designation">{{$team->role}}</p>
                            <p class="team_text">{!!$team->description!!}</p>
                            <p class="social-icons">
                            @foreach ($team->socials as $social)
                                @if ($social->url)
                                <a href="{{$social->url}}" class="{{$social->social}}" target="_blank"><i class="ion-social-{{str_replace('-', '', $social->social)}}"></i></a>
                                @endif
                            @endforeach
                            </p>
                        </div>
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
                                @if ($client->picture)
                                <img src="{{$client->picture}}" title="{{$client->name}}" alt="client image">
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection