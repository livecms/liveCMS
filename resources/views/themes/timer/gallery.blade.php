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

        <!-- GALLERY -->
        <section id="gallery" class="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        {!!$post->content!!}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    @for ($i = 0; $i < count($galleries = get('gallery')); $i++)
                    <?php $gallery = $galleries[$i]; ?>
                    <div class="col-sm-4 col-xs-12">
                        <figure class="wow fadeInLeft animated portfolio-item animated" data-wow-duration="500ms" data-wow-delay="{{$i * 200 - 100}}ms" style="visibility: visible; animation-duration: 300ms; -webkit-animation-duration: 300ms; animation-delay: 0ms; -webkit-animation-delay: 0ms; animation-name: fadeInLeft; -webkit-animation-name: fadeInLeft;">
                            <div class="img-wrapper">
                                <img src="{{$gallery->picture}}" class="img-responsive" alt="{{$gallery->title}}">
                                <div class="overlay">
                                    <div class="buttons">
                                        <a rel="gallery" class="fancybox" href="{{$gallery->picture}}">Zoom</a>
                                    </div>
                                </div>
                            </div>
                            <p>
                                {{$gallery->title}}
                            </p>
                        </figure>
                    </div>
                    @endfor
                </div>
            </div>
        </section>