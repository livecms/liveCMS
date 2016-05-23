<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $title or '' }} | {{ globalParams('site_name', 'Live CMS') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/backend/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/plugins/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/backend/plugins/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/backend/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="/backend/plugins/select2/select2-bootstrap.min.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="/backend/plugins/datepicker/datepicker3.css">
  <!-- datatables -->
  <link rel="stylesheet" href="/backend/plugins/datatables/dataTables.bootstrap.css">
  <!-- I Check -->
  <link rel="stylesheet" href="/backend/plugins/iCheck/square/blue.css">
  <!-- Styky Table Header -->
  <link rel="stylesheet" href="/backend/plugins/sticky-table-headers/css/component.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="/backend/plugins/sweetalert/sweetalert.css">
  <!-- SweetAlert Forms -->
  <link rel="stylesheet" href="/backend/plugins/swal-forms/swal-forms.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend/dist/css/AdminLTE.dark.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/backend/dist/css/skins/skin-dark.min.css">

  <style type="text/css">
    .user-label {
        width: 30px;
        height: 30px;
        text-align: center;
        background-color: rgba(85, 85, 85, 0.25);
        color: #fff;
        border-radius: 50%;
        margin-top: -5px;
        margin-bottom: -5px;
        padding: 5px;
        position: absolute;
    }

    .dropdown-toggle .user-label {
        right: 0;
        left: 0;
    }

    .user-block .user-label {
        width: 40px;
        height: 40px;
        margin-top: 0;
        padding: 10px;
    }

    .dark .user-label {
        background-color: #545353;
    }

  </style>

  @yield('css.header')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             | 
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
@if(auth()->user())
@section('templateBody')
<body class="dark {{ $bodyClass or 'skin-blue sidebar-mini' }}">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{ globalParams('site_initial', 'LC') }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ globalParams('site_name', 'Live CMS') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      @if (isset($withoutHeader))
      <div class="navbar-custom-menu pull-left">
        <h3 class=page-header>
          {{ $title or 'Page Header' }}
        </h3>
      </div>
      @endif
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if (!auth()->user()->avatar)
              <div class="user-label">
                <span>{{ auth()->user()->getInitial() }}</span>
              </div>
              @else
              <!-- The user image in the navbar-->
              <img src="{{auth()->user()->avatar}}" class="user-image" alt="User Image">
              @endif
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                @if (auth()->user()->avatar)
                <img src="{{auth()->user()->avatar}}" class="img-circle" alt="User Image">
                @else
                <i class="text-gray ion ion-person fa-5x"></i>
                @endif
                <p>
                  {{ str_limit(auth()->user()->name, 20) }}
                  <small>Since {{ auth()->user()->created_at->diffForHumans() }}</small>
                </p>
              </li>
              <!-- Menu Body -->
<!--               <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route((site()->subfolder ? site()->subfolder.'.' : '').globalParams('slug_userhome', config('livecms.slugs.userhome')).'.'.globalParams('slug_profile', config('livecms.slugs.profile')).'.index') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li><a href="{{ url('/logout') }}"><i class="fa fa-lock"></i> <span class="hidden-sm">Logout</span></a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form (Optional) -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
      @section('sidebarmenus')
        @include('partials.adminmenus')
      @stop
      @yield('sidebarmenus')
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if (!isset($withoutHeader))
    <section class="content-header">
      <h1>
        {{ $title or 'Page Header' }}
        <small>{{ $description or 'Optional description' }}</small>
      </h1>
      <ol class="breadcrumb">
      @if(isset($breadcrumbLevel))
        <li><a href="{{ $breadcrumb1Url or route('admin.home') }}"><i class="fa fa-{{ $breadcrumb1Icon or 'dashboard' }}"></i> {{ $breadcrumb1 or 'Menu' }}</a></li>
        @if($breadcrumbLevel >= 2)<li class="{{ $breadcrumb2Class or 'active' }}"><a href="{{ $breadcrumb2Url or 'javascript:;' }}" ><i class="fa fa-{{ $breadcrumb2Icon or '' }}"></i> {{ $breadcrumb2 or 'Here' }}</a></li>@endif
        @if($breadcrumbLevel >= 3)<li class="{{ $breadcrumb3Class or 'active' }}"><a href="{{ $breadcrumb3Url or 'javascript:;' }}" ><i class="fa fa-{{ $breadcrumb3Icon or '' }}"></i> {{ $breadcrumb3 or 'Here' }}</a></li>@endif
      @endif
      </ol>
    </section>
    @endif

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Made with <i class="fa fa-heart text-red"></i> in Indonesia
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 - {{ \Carbon\Carbon::now()->format('Y') }}. <a href="{{globalParams('site_name') ? url('/') : 'https://github.com/livecms/liveCMS'}}">{{ globalParams('site_name', 'Live CMS') }}</a>.</strong> {{ globalParams('site_slogan', 'Powered by Laravel Framework.') }}
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="/backend/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/backend/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/backend/dist/js/app.min.js"></script>
<!-- date js -->
<script src="/backend/plugins/datejs/date.js"></script>
<!-- date-range-picker -->
<script src="/backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/backend/plugins/datepicker/locales/bootstrap-datepicker.id.js" charset="UTF-8"></script>
<!-- DataTables -->
<script src="/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap Typeahead -->
<script src="/backend/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js"></script>
<!-- Select2 -->
<script src="/backend/plugins/select2/select2.full.min.js"></script>
<!-- autonumeric -->
<script src="/backend/plugins/autoNumeric/autoNumeric-min.js"></script>
<!-- TinyMCE -->
<script src="/backend/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<!-- Sweet Alert -->
<script src="/backend/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Sweet Alert Form -->
<script src="/backend/plugins/swal-forms/swal-forms.js"></script>
<!-- Sticky Table Header -->
<script src="/backend/plugins/sticky-table-headers/js/jquery.stickyheader.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/backend/dist/js/demo.js"></script>


<script>
  String.prototype.toRp = function(a,b,c,d,e) {
    e=function(f){return f.split('').reverse().join('')};b=e(parseInt(this,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return(a?a:'Rp.\t')+e(d);
  }
  $(function() {
    $.fn.datepicker.defaults.format = "{{ config('liveapp.dateformat', 'dd-MM-yyyy') }}";
    $.fn.datepicker.defaults.language = "en";
    $.fn.datepicker.defaults.todayHighlight = true;
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.forceParse = false;

    $('.datepicker').datepicker();          

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.fn.modal.Constructor.DEFAULTS.backdrop = 'static';

    $.fn.liveposCurrency = {aSep: '.', aDec: ',', aSign: 'Rp. ', lZero: 'deny'};
    $.fn.liveposNumeric = {aSep: '.', aDec: ',', aSign: '', lZero: 'deny'};

    $('select').select2({width: '100%', tokenSeparators: [',']});    
    
    $('.input-mask.input-mask-currency').autoNumeric('init', $.fn.liveposCurrency);
    $('.input-mask.input-mask-numeric').autoNumeric('init', $.fn.liveposNumeric);

    $('form').submit(function(e) {

      var form = $(this);
      console.log(form);
      form.find('.btn-primary').prop('disabled', true); 
      form.find('.input-mask').each(function(i, e) {
        var v = $(this).autoNumeric('get');
        console.log(v)
        $(this).val(v);
      })
      form.find('.datepicker').each(function(i, e) {
        var v = $(this).val();
        console.log(v)
        console.log($.fn.datepicker.defaults.format)
        d = Date.parseExact(v, [$.fn.datepicker.defaults.format, 'dd-MMM-yyyy']);
        newDate = d.toString('yyyy-M-dd');
        $(this).val(newDate);
      })
      return true;
    })

      var slideToTop = $("<div />");
      slideToTop.html('<i class="fa fa-chevron-up"></i>');
      slideToTop.css({
        position: 'fixed',
        bottom: '40px',
        right: '25px',
        width: '40px',
        height: '40px',
        color: '#eee',
        'font-size': '',
        'line-height': '40px',
        'text-align': 'center',
        'background-color': '#222d32',
        cursor: 'pointer',
        'border-radius': '5px',
        'z-index': '99999',
        opacity: '.7',
        'display': 'none'
      });
      slideToTop.on('mouseenter', function () {
        $(this).css('opacity', '1');
      });
      slideToTop.on('mouseout', function () {
        $(this).css('opacity', '.7');
      });
      $('.wrapper').append(slideToTop);
      $(window).scroll(function () {
        if ($(window).scrollTop() >= 50) {
          if (!$(slideToTop).is(':visible')) {
            $(slideToTop).fadeIn(500);
          }
        } else {
          $(slideToTop).fadeOut(500);
        }
      });
      $(slideToTop).click(function () {
        $("body").animate({
          scrollTop: 0
        }, 500);
      });

  @if(isset($base))
    var table = $('.datatables').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
          url: '{!! action($baseClass.'@data', array_merge(request()->query(), isset($query) ? (array) $query : [])) !!}',
          type: 'POST'
        },
        columns: [
          @foreach(array_keys($fields) as $field) { name: '{{ $field }}', data: '{{ $field }}', sortable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}, searchable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}}, @endforeach
          { name: 'menu', data: 'menu', sortable: false, searchable: false },
        ],
        order: [@foreach($orders as $key => $order) [{{ $key }}, '{{ $order }}']@endforeach],
    }).on( 'draw.dt', function () {
      $(table.table().container())
        .find('div.dataTables_paginate')
        .css( 'display', table.page.info() && table.page.info().pages <= 1 ?
             'none' :
             'block'
      );
    }).one( 'draw.dt', function () {
      var h = window.location.hash.substr(1).split('=');
      if (h[0] == 'search') {
        // window.location.hash='';
        var t = $(this);
        setTimeout(function() {
          t.DataTable().search(decodeURIComponent(h[1])).draw();
        }, 100)
      }
    });

  @endif

  @if(isset($useCKEditor) || isset($useTinyMCE))
    tinymce.init({
      selector: 'textarea',
      automatic_uploads: true,
      height: 400,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools jbimages'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      relative_urls: false,
     });
  @endif

    $('.datatables').on('click', '.btn-need-auth', function () {
      var title   = $(this).data('title') || 'title';
      var method  = $(this).data('method');
      var action  = $(this).data('action');
      var button  = $(this).text() || 'Submit';
      var field   = $(this).data('field') || 'password';
      var obj     = $(this).data('hidden') || {};

      swal.withFormAsync({
        title: title,
        text: '{{trans('backend.needyourpasswordtocontinue')}}',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: button,
        closeOnConfirm: true,
        formFields: [
          { id: field, name: field, type: 'password', placeholder: '{{trans('livecms.password')}}' }
        ]
      }).then(function (context) {
        
        if (context._isConfirm) {
          obj[field] = context.swalForm[field];
          obj['_method'] = method;

          $.post(action, obj, function (data) {
            table.draw(true);
            swal('{{trans('livecms.success')}}', '', 'success');
          }, 'json').error(function (data) {
            error = $.parseJSON(data.responseText)[field][0];
            swal('{{trans('livecms.failed')}}', error.charAt(0).toUpperCase() + error.slice(1), 'error');
          });
        }
      })
    });
  
  })


</script>

@if (Session::has('sweet_alert.alert'))
    <script>
        swal({!! Session::get('sweet_alert.alert') !!});
    </script>
@endif

@yield('script.footer')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '{{env('UA_BACKEND')}}', 'auto');
    ga('send', 'pageview');

  </script>
</body>
@stop
@endif
@yield('templateBody')
</html>
