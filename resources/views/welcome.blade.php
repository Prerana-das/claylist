<!doctype html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head> 
        <!-- META DATA -->         
        <meta charset="UTF-8"> 
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="description" content="Buy , Sale , Barter">
        {{-- <meta name="description" content="Claylist - Classifieds, Directory, Multipurpose Listing HTML Template"> 
        <meta name="author" content="Spruko Technologies Private Limited"> 
        <meta name="keywords" content="directory listing html template, bootstrap html template, directory html template, directory website template, directory listing html template, directory listing template, listing website template, business directory template, membership directory template, directory template, service directory template, bootstrap business directory template, directory listing website template, business directory html template, online directory template, online directory website templates, best website templates, html template, html5 template, themeforest html, themeforest html templates">  --}}
        <link rel="icon" href="favicon.ico" type="image/x-icon"/> 

        <!--Favicon-->	
	    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/fav/favicon.ico">
        <!-- Title -->         
        <title>HOOFBARTER</title>       
        <!-- Bootstrap Css -->         
        <link href="/assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet"/> 
       
        <!-- Font-awesome  Css -->         
        <link href="/assets/css/icons.css" rel="stylesheet"/> 
        <!--Horizontal Menu-->         
        <link href="/assets/plugins/Horizontal2/Horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet"/> 
        <link href="/assets/plugins/Horizontal2/Horizontal-menu/horizontal.css" rel="stylesheet"/> 
        <!--Select2 Plugin -->         
        <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet"/> 
         <!-- Dashboard Css -->         
         <link href="/assets/css/dashboard.css" rel="stylesheet"/> 
        <!-- Cookie css -->         
        <link href="/assets/plugins/cookie/cookie.css" rel="stylesheet"> 
        <!-- Owl Theme css-->         
        <link href="/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet"/> 
        {{-- <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel="stylesheet"/>  --}}
        <!-- Custom scroll bar css-->         
        <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/> 
        <!-- COLOR-SKINS -->         
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="/assets/webslidemenu/color-skins/color10.css"/> 
        <script>
           
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
          
        </script>
    </head>  

    <body>
        <div id="app"> 
            <mainapp></mainapp>
        </div>
        <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
                @if(Auth::check())
                    window.authUser={!! Auth::user() !!}
                    @else
                    window.authUser=false
                    @endif
            })();
       </script>
        

        <script src="/js/app.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCD3ExNbq5rW8gR-WV-Q0B1vMKEIc5zvsk"></script>
         <!-- JQuery js-->         
         <script src="/assets/js/vendors/jquery-3.2.1.min.js"></script>         
        <!-- Bootstrap js -->         
        <script src="/assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>         
        <script src="/assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>         
        <!--JQuery Sparkline Js-->         
        <script src="/assets/js/vendors/jquery.sparkline.min.js"></script>         
        <!-- Circle Progress Js-->         
        <script src="/assets/js/vendors/circle-progress.min.js"></script>         
        <!-- Star Rating Js-->         
        <script src="/assets/plugins/rating/jquery.rating-stars.js"></script>         
        <!--Counters -->         
        <script src="/assets/plugins/counters/counterup.min.js"></script>         
        <script src="/assets/plugins/counters/waypoints.min.js"></script>         
        <script src="/assets/plugins/counters/numeric-counter.js"></script>         
        <!--Owl Carousel js -->         
        <script src="/assets/plugins/owl-carousel/owl.carousel.js"></script>         
        <!--Horizontal Menu-->         
        <script src="/assets/plugins/Horizontal2/Horizontal-menu/horizontal.js"></script>         
        <!--JQuery TouchSwipe js-->         
        <script src="/assets/js/jquery.touchSwipe.min.js"></script>         
        <!--Select2 js -->         
        <script src="/assets/plugins/select2/select2.full.min.js"></script>         
        <script src="/assets/js/select2.js"></script>         
        <!-- sticky Js-->         
        <script src="/assets/js/sticky.js"></script>         
        <!-- Cookie js -->         
        <script src="/assets/plugins/cookie/jquery.ihavecookies.js"></script>         
        <script src="/assets/plugins/cookie/cookie.js"></script>         
        <!-- Custom scroll bar Js-->         
        <script src="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>         
        <!-- Swipe Js-->         
        <script src="/assets/js/swipe.js"></script>         
        <!-- Scripts Js-->         
        <script src="/assets/js/scripts2.js"></script>         
        <!-- Custom Js-->         
        <script src="/assets/js/custom.js"></script>       

    </body>
</html>
