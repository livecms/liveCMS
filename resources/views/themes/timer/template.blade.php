<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="/frontend/timer/images/favicon.png">
        <title>{{ $title or 'Judul' }} | {{ globalParams('site_name') }}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="/frontend/timer/css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="/frontend/timer/css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="/frontend/timer/css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="/frontend/timer/css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="/frontend/timer/css/owl.carousel.css">
        <link rel="stylesheet" href="/frontend/timer/css/owl.theme.css">
        <link rel="stylesheet" href="/frontend/timer/css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="/frontend/timer/css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="/frontend/timer/css/responsive.css">
        
    </head>
    <body>
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <header id="top-bar" class="navbar-fixed-top animated-header">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->
                    
                    <!-- logo -->
                    <div class="navbar-brand">
                        <a href="/frontend/timer/index.html" >
                            <h2 class="logo">Live CMS</h2>
                            <!-- <img src="/frontend/timer/images/logo.png" alt=""> -->
                        </a>
                    </div>
                    <!-- /logo -->
                </div>
                <!-- main menu -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <div class="main-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/frontend/timer/index.html" >Home</a>
                            </li>
                            <li><a href="/frontend/timer/about.html">About</a></li>
                            <li><a href="/frontend/timer/service.html">Service</a></li>
                            <li class="dropdown">
                                <a href="/frontend/timer/#" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a href="/frontend/timer/404.html">404 Page</a></li>
                                        <li><a href="/frontend/timer/gallery.html">Gallery</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="/frontend/timer/#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="caret"></span></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a href="/frontend/timer/blog-fullwidth.html">Blog Full</a></li>
                                        <li><a href="/frontend/timer/blog-left-sidebar.html">Blog Left sidebar</a></li>
                                        <li><a href="/frontend/timer/blog-right-sidebar.html">Blog Right sidebar</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="/frontend/timer/contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
                <!-- /main nav -->
            </div>
        </header>
        
        @yield('content')
        
        <!--
        ==================================================
        Call To Action Section Start
        ================================================== -->
        <section id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">SO WHAT YOU THINK ?</h1>
                            <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis,<br>possimus commodi, fugiat magnam temporibus vero magni recusandae? Dolore, maxime praesentium.</p>
                            <a href="/frontend/timer/contact.html" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="500ms">Contact With Me</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!--
        ==================================================
        Footer Section Start
        ================================================== -->
        <footer id="footer">
            <div class="container">
                <div class="col-md-8">
                    <p class="copyright">Copyright: <span>2016</span> . Powered by <a href="https://github.com/livecms/liveCMS">Live CMS</a>. Theme by <a href="/frontend/timer/http://www.Themefisher.com">Themefisher</a></p>
                </div>
                <div class="col-md-4">
                    <!-- Social Media -->
                    <ul class="social">
                        <li>
                            <a href="/frontend/timer/http://wwww.fb.com/themefisher" class="Facebook">
                                <i class="ion-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/frontend/timer/http://wwww.twitter.com/themefisher" class="Twitter">
                                <i class="ion-social-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/frontend/timer/#" class="Linkedin">
                                <i class="ion-social-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/frontend/timer/http://wwww.fb.com/themefisher" class="Google Plus">
                                <i class="ion-social-googleplus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer> <!-- /#footer -->
        
         <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="/frontend/timer/js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- jquery -->
        <script src="/frontend/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- owl carouserl js -->
        <script src="/frontend/timer/js/owl.carousel.min.js"></script>
        <!-- bootstrap js -->

        <script src="/frontend/timer/js/bootstrap.min.js"></script>
        <!-- wow js -->
        <script src="/frontend/timer/js/wow.min.js"></script>
        <!-- slider js -->
        <script src="/frontend/timer/js/slider.js"></script>
        <script src="/frontend/timer/js/jquery.fancybox.js"></script>
        <!-- template main js -->
        <script src="/frontend/timer/js/main.js"></script>
        <!-- jscroll js -->
        <script src="/frontend/plugins/jscroll-2.3.4/jquery.jscroll.min.js"></script>

        @yield('script')
    
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '{{env('UA_FRONTEND')}}', 'auto');
            ga('send', 'pageview');

        </script>

    </body>
</html>