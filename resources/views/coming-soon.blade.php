<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Coming Soon | {{ $global_params['site_name'] or 'LiveCMS' }}</title>
    <meta name="description" content="{{ $global_params['site_description'] or 'Your Website Description' }}" >
    <meta name="author" content="{{ $global_params['author'] or 'Live CMS' }}">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Bootstrap  -->
    <link href="/frontend/coming-soon/parallax/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- icon fonts font Awesome -->
    <link href="/frontend/coming-soon/parallax/assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="/frontend/coming-soon/parallax/assets/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="/frontend/coming-soon/parallax/assets/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body>


    <!-- Preloader -->
    <div id="preloader">
        <div id="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="lading"></div>
        </div>
    </div><!-- /#preloader -->
    <!-- Preloader End-->

    <!-- Main Menu -->
    <div id="main-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        
        <div class="navbar-header">
            <!-- responsive navigation -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button> <!-- /.navbar-toggle -->
            
        </div> <!-- /.navbar-header -->

        <nav class="collapse navbar-collapse">
            <!-- Main navigation -->
            <ul id="headernavigation" class="nav navbar-nav">
                <li class="active"><a href="#page-top">Home</a></li>    
                <li><a href="#about">About</a></li> 
                <li><a href="#subscribe">Subscribe</a></li> 
                <li><a href="#contact">Contact</a></li>     
            </ul> <!-- /.nav .navbar-nav -->
        </nav> <!-- /.navbar-collapse  -->
    </div><!-- /#main-menu -->
    <!-- Main Menu End -->
    

    <!-- Page Top Section -->
    <section id="page-top" class="section-style parallax-bg" data-background-image="/frontend/coming-soon/parallax/images/background/page-top.jpg">
        <div class="pattern height-resize">
            <div class="container">
                <h1 class="site-title">
                    {{ $global_params['site_name'] or 'Live CMS'}}
                </h1><!-- /.site-title -->
                <h3 class="section-name">
                    <span>
                        We Are
                    </span>
                </h3><!-- /.section-name -->
                <h2 class="section-title">
                    Coming Soon
                </h2><!-- /.Section-title  -->
                <div id="time_countdown" class="time-count-container">

                    <div class="col-sm-3">
                        <div class="time-box">
                            <div class="time-box-inner dash days_dash animated" data-animation="rollIn" data-animation-delay="300">
                                <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                </span>
                                <span class="time-name">Days</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="time-box">
                            <div class="time-box-inner dash hours_dash animated" data-animation="rollIn" data-animation-delay="600">
                                <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>    
                                </span>
                                <span class="time-name">Hours</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="time-box">
                            <div class="time-box-inner dash minutes_dash animated" data-animation="rollIn" data-animation-delay="900">
                                <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                </span>
                                <span class="time-name">Minutes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="time-box">
                            <div class="time-box-inner dash seconds_dash animated" data-animation="rollIn" data-animation-delay="1200">
                                <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                </span>
                                <span class="time-name">Seconds</span>
                            </div>
                        </div>
                    </div>
                    
                </div><!-- /.time-count-container -->

                <p class="time-until">
                    <span>Time Until Launch</span>
                </p><!-- /.time-until -->



                <div class="next-section">
                    <a class="go-to-about"><span></span></a>
                </div><!-- /.next-section -->
                
            </div><!-- /.container -->
        </div><!-- /.pattern -->        
    </section><!-- /#page-top -->
    <!-- Page Top Section  End -->


    <!-- About Us Section -->
    <section id="about" class="section-style no-parallax-bg" data-background-image="/frontend/coming-soon/parallax/images/background/about-us.jpg">
        <div class="pattern height-resize"> 
            <div class="container">
                <h3 class="section-name">
                    <span>
                        About Us
                    </span>
                </h3><!-- /.section-name -->
                <h2 class="section-title">
                    We Are dedicated
                </h2><!-- /.Section-title  -->
                <p class="section-description">
                    {{ $global_params['site_description'] or 'High Performance CMS'}}
                </p><!-- /.section-description -->

                <div class="next-section">
                    <a class="go-to-subscribe"><span></span></a>
                </div><!-- /.next-section -->

            </div><!-- /.container -->
        </div><!-- /.pattern -->
        
        
    </section><!-- /#about -->
    <!-- About Us Section End -->



    <!-- Subscribe Section -->
    <section id="subscribe" class="section-style parallax-bg" data-background-image="/frontend/coming-soon/parallax/images/background/newsletter.jpg">
        <div class="pattern height-resize">
            <div class="container">
                <h3 class="section-name">
                    <span>
                        Subscribe
                    </span>
                </h3><!-- /.section-name -->
                <h2 class="section-title">
                    Our Newsletter 
                </h2><!-- /.Section-title  -->
                <p class="section-description">
                    Join and get first access. 
                </p><!-- /.section-description -->

                <form class="news-letter" action="/frontend/coming-soon/parallax/php/subscribe.php" method="post">
                    <div class="subscribe-hide">
                        <input class="form-control" type="email" id="subscribe-email" name="subscribe-email" placeholder="Email Address"  required>
                        <button  type="submit" id="subscribe-submit" class="btn"><i class="fa fa-envelope"></i></button>
                        <span id="subscribe-loading" class="btn"> <i class="fa fa-refresh fa-spin"></i> </span>
                        <div class="subscribe-error"></div>
                    </div><!-- /.subscribe-hide -->
                    <div class="subscribe-message"></div>
                </form><!-- /.news-letter -->

                <div class="social-btn-container">
                    <span class="social-btn-box">
                        <a href="#" class="facebook-btn">
                            <i class="fa fa-facebook"></i></a>
                        </span><!-- /.social-btn-box -->

                        <span class="social-btn-box">
                            <a href="#" class="twitter-btn"><i class="fa fa-twitter"></i></a>
                        </span><!-- /.social-btn-box -->

                        <span class="social-btn-box">
                            <a href="#" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>
                        </span><!-- /.social-btn-box -->

                        <span class="social-btn-box">
                            <a href="#" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>
                        </span><!-- /.social-btn-box -->


                        <span class="social-btn-box">
                            <a href="#" class="youtube-btn"><i class="fa fa-youtube"></i></a>
                        </span><!-- /.social-btn-box -->


                        
                    </div><!-- /.social-btn-container -->

                    <div class="next-section">
                        <a class="go-to-contact"><span></span></a>
                    </div><!-- /.next-section -->

                </div><!-- /.container -->
            </div><!-- /.pattern -->

        </section><!-- /#subscribe -->
        <!-- Subscribe Section End -->



        <!-- Contact Section -->
        <section id="contact" class="section-style no-parallax-bg" data-background-image="/frontend/coming-soon/parallax/images/background/contact.jpg">
            <div class="pattern height-resize">
                <div class="container">
                    <h3 class="section-name">
                        <span>
                            Contact
                        </span>
                    </h3><!-- /.section-name -->
                    <h2 class="section-title">
                        Get in Touch 
                    </h2><!-- /.Section-title  -->
                    <p class="section-description">
                        Drop your comment.
                    </p><!-- /.section-description -->

                    <form id="contact-form" action="/frontend/coming-soon/parallax/email.php" method="post" class="clearfix">
                        <div class="contact-box-hide">
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="first_name" name="first_name" required placeholder="First Name">
                                <span class="first-name-error"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="last_name" name="last_name" required placeholder="Last Name">
                                <span class="last-name-error"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control"  id="contact_email" name="contact_email" required placeholder="Email Address">
                                <span class="contact-email-error"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="subject" name="contact_subject" required placeholder="Subject">
                                <span class="contact-subject-error"></span>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="message" name="message" required placeholder="Message"></textarea>
                                <span class="contact-message-error"></span>
                            </div>
                            <div class="col-sm-2">
                                <button id="contact-submit" class="btn custom-btn col-xs-12" type="submit" name="submit"><i class="fa fa-rocket"></i></button>
                                <span id="contact-loading" class="btn custom-btn col-xs-12"> <i class="fa fa-refresh fa-spin"></i> </span>
                            </div>
                        </div><!-- /.contact-box-hide -->
                        <div class="contact-message"></div>

                    </form><!-- /#contact-form -->

                    

                    <div class="next-section">
                        <a class="go-to-page-top"><span></span></a>
                    </div><!-- /.next-section -->

                </div><!-- /.container -->
            </div><!-- /.pattern -->

        </section><!-- /#contact -->
        <!-- Contact Section End -->



        <!-- Footer Section -->
        <footer id="footer-section">
            <p class="copyright">
                &copy; <a href="/">{{ $global_params['site_name'] or 'liveCMS' }}</a> 2015-2016, All Rights Reserved. Developed with <i class="fa fa-heart" style="color: #FA503A"></i> in Jakarta by <a target="_blank" href="http://blog.hiret.web.id">Mokhamad Rofiudin</a> <br>
                Template : Kite Coming Soon Template. Desinged by <a target="_blank" href="http://www.jeweltheme.com">Jewel Theme</a>
            </p>
        </footer>
        <!-- Footer Section End -->

        <!-- jQuery Library -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/jquery-2.1.0.min.js"></script>
        <!-- Modernizr js -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/modernizr-2.8.0.min.js"></script>
        <!-- Plugins -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/plugins.js"></script>
        <!-- Custom JavaScript Functions -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/functions.js"></script>
        <!-- jquery.parallax.js -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/jquery.parallax.js"></script>
        <!-- Custom JavaScript Functions -->
        <script type="text/javascript" src="/frontend/coming-soon/parallax/assets/js/jquery.ajaxchimp.min.js"></script>


        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(window).load(function(){
                    $("#page-top").parallax("50%", 0.2);
                    $("#subscribe").parallax("50%", 0.2);
                })

                $('#time_countdown').countDown({
        
                // targetDate: {
                //     'day': 30,
                //     'month': 9,
                //     'year': 2015,
                //     'hour': 0,
                //     'min': 0,
                //     'sec': 0
                // },
                // omitWeeks: true

                <?php
                    
                    $launchingDateTime = !empty($global_params['launching_datetime']) ? $global_params['launching_datetime'] : '2017-01-01 00:00:00';
                    $datetime = new Carbon\Carbon($launchingDateTime);

                    $sec = $datetime->diffInSeconds() % 60;
                    $min = $datetime->diffInMinutes() % 60;
                    $hour = $datetime->diffInHours() % 24;
                    $day = $datetime->diffInDays() % 30;
                    $month = $datetime->diffInMonths() % 12;
                    $year = $datetime->diffInYears();

                ?>

                 targetOffset: {
                    'day':      {{ $day }},
                    'month':    {{ $month }},
                    'year':     {{ $year }},
                    'hour':     {{ $hour }},
                    'min':      {{ $min }},
                    'sec':      {{ $sec }}
                },
                omitWeeks: true

                });
            })
        </script>

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
