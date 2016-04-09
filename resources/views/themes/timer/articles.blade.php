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
                            <h2>{{trans('livecms.article')}}</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.html">
                                        <i class="ion-ios-home"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">{{ trans('livecms.article') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog-full-width">
            <div class="container">
                <div class="row">
                    <div class="articles col-md-8 col-md-offset-2">
                        @include(theme('front', 'partials.articles'))
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
