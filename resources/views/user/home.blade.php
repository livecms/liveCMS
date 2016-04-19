@extends('user')

@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4 row">
        <div class="col-xs-12 visible-xs visible-sm">&nbsp;</div> 
        @yield('index.submenu')
    </div>
</div>
<h4>
</h4>
<div class="row">
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua" 
          @if ($profile->background)
          style="background: url('{{$profile->background}}') center center;"
          @endif
        >
          <h3 class="widget-user-username">{{$profile->name}}</h3>
          <h5 class="widget-user-desc">{{$profile->jobtitle}}</h5>
        </div>
        <div class="widget-user-image text-center text-aqua img-circle">
        @if ($profile->avatar)
          <img class="img-circle" src="{{$profile->avatar}}" alt="User Avatar" title="{{basename($profile->avatar)}}">
        @else
          <i class="ion ion-person fa-5x"></i>
        @endif
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-xs-6 border-right">
              <div class="description-block">
                <h5 class="description-header">3,200</h5>
                <span class="description-text">{{trans('livecms.article')}}</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-xs-6 border-right">
              <div class="description-block">
                <h5 class="description-header">13,000</h5>
                <span class="description-text">{{trans('livecms.viewed')}}</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="box-body">
          <p class="text-center">
            @if (count($profile->socials))
            @foreach ($profile->socials as $social => $url)
              @if ($url)
              <a class="btn btn-danger" target="__blank" rel="nofollow" href="{{$profile->getSocials($social)}}"><i class="fa fa-{{$social}}" title="{{title_case($social)}}"></i></a>
              @endif
            @endforeach
            @endif
          </p>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-pencil margin-r-5"></i>{{trans('livecms.aboutme')}}</strong>
          <p class="text-muted">
            {{$profile->about}}
          </p>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.widget-user -->

    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#profiles" data-toggle="tab">{{trans('backend.changeprofile')}}</a></li>
          <li><a href="#avatars" data-toggle="tab">{{trans('backend.changeavatar')}}</a></li>
          <li><a href="#credentials" data-toggle="tab">{{trans('backend.changecredential')}}</a></li>
        </ul>
        <div class="tab-content">

          @include('user.profile.form')
          <div class="tab-pane active" id="profiles">
            @yield('profile.form')
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="avatars">
            @yield('profile.form.avatars')
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="credentials">
            @yield('profile.form.credentials')
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
@stop

@section('script.footer')

<script type="text/javascript">
  jQuery(function() {
    var hash = window.location.hash;
    if ($('#form-alert').data('errors')) {
      hash = '#'+$('#form-alert').data('errors');
    }
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });
  });
</script>
@stop