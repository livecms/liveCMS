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