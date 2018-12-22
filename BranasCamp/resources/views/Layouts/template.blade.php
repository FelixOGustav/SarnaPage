<!DOCTYPE html>
<html>
<head lang="sv">
    <meta charset="ISO-8859-1">
    <!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <link rel="icon" href="{{URL::asset('img/branaslogga.png')}}"  type="img/PNG">

    <meta name="author" content="Gustav Råkeberg, Felix Brunnegård">
    <meta name="description" content="Branäslägret är ett nyårsläger som arrangeras av equmeniakyrkans församlingar i trakten kring Herrljunga och Vårgårda. Veckan bjuder på skidåkning, Gud-snack, lägerstämning, bibel, gamla och nya vänner, aktiviteter, slappa-tid och mängder med tillfällen att njuta av livet!">
    <meta property="og:url" content="https://branaslagret.se/app">
    <meta property="og:site_name" content="Branäslägret 2018-2019">
    <meta property="og:title" content="Branäslägret">
    <meta property="og:description" content="Branäslägret är ett nyårsläger som arrangeras av equmeniakyrkans församlingar i trakten kring Herrljunga och Vårgårda. Veckan bjuder på skidåkning, Gud-snack, lägerstämning, bibel, gamla och nya vänner, aktiviteter, slappa-tid och mängder med tillfällen att njuta av livet!">

    <meta name="theme-color" content="#606569">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-startup-image" content="{{URL::asset('img/branaslogga.png')}}">
    <link rel="apple-touch-icon image_src" href="{{URL::asset('img/branaslogga.png')}}">

    <!-- CSS links-->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">

    <title>{{config('app.name', 'Branäslägret')}}</title>
</head>
<body>
    <div class="mainBG"></div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="{{URL::asset('js/scrollToTop.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <!-- Loading content -->

    <div class="loadingBG" id="loadingScreen">
        <div class="loadingContent centerTextInDiv">
            <img src="{{URL::asset('img/branaslogga_white.png')}}" type="img/PNG" class="rotating">
            <p class="whiteColor">Vänta lite..</p>
        </div>
    </div>
    
    <!-- Loading content  end-->

    <!-- Navbar -->
    
    <div class="navbar navbar-expand-lg navbar-light navbarBG fixed-top navbar-custom">
        <div>
            <a class="navbar-brand"  id="scrollToTopLogo" href="{{$links['navLogoLink'] ?? '/'}}"><img src="{{URL::asset('img/branaslagret.svg')}}" height="40" class="d-inline-block align-top"></a>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarBasic">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['infoLink'] ?? "/#branaslagretInfo"}}" id="scrollToBranaslagretBtn">Branäslägret?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['prisLink'] ?? "/#prisInfo"}}" id="scrollToPrisBtn">Pris <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['reglerLink'] ?? "/#ReglerInfo"}}" id="scrollToReglerBtn">Regler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['faqLink'] ?? "/#faqInfo"}}" id="scrollTofaqBtn">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['kontaktLink'] ?? "/#KontaktInfo"}}" id="scrollToKontaktBtn">Kontakt</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navbar end -->

    <!-- Main Site Content -->
    <div class="container-fluid noPadding" style="min-height: 850px;" id="mainContent"><!-- min-height should be able to be removed later -->
        <div class="navbarSpacer" ></div> <!-- Spacer so that content doesn't start under navbar -->
            
        <!-- Cookie consent -->
        <div class="js-cookie-consent cookie-consent" id="cookieConsentDiv" style="display: block;">
            <div class="fixed-bottom cookiestyle centerTextInDiv">
                <span class="cookie-consent__message">
                    Genom att besöka och använda denna sida godkänner du användningen av cookies.
                    Vi använder inga cookies för att spåra eller samla in användardata.
                </span>
                <span>
                    <a href="/gdpr" class="btn" style="background-color: white; margin-left: 15px;"><p style="margin: 0px; padding: 0px;">Läs mer om GDPR</p></a>
                    
                    <button id="agreeCookies" class="btn" style="background-color: white; margin-left: 15px;">
                        <p style="margin: 0px; padding: 0px;">Ok</p>
                    </button>
                </span>
            </div>
        </div>
        <!-- Cookie consent end -->

        @yield('content')
    
    </div>
    <!-- Footer -->

    <div class="footerBG row" style="margin: 0px;" id="footerId">
        <div class="col" style="margin-top: auto; margin-bottom: auto; text-align: center">
            <a href="/about" class="same-as-p whiteColor scaleFooterTextToMobile">Om hemsidan<br><br></a>
            <a href="/gdpr" class="same-as-p whiteColor scaleFooterTextToMobile">GDPR<br><br></a>
            <a href="/admin/login" class="same-as-p whiteColor scaleFooterTextToMobile">Admin-sidan</a>
        </div>

        <div class="col">
            <a href="http://www.equmenia.se/" target="blank"><img src="{{URL::asset('img/EqumeniaTextLogga.png')}}" class="footerImg"></a>
        </div>
        <div  class="col">
            <a href="http://www.equmenia.se/" target="blank"><img src="{{URL::asset('img/EqumeniakyrkanKorsLogga.png')}}" class="footerImg"></a> 
        </div>
    </div>

    <!-- Footer end -->
    <button id="scrollToTopBtn" title="Go to top" class="dropShadow"><img src="{{URL::asset('img/arrowUp.png')}}"></button>

    <script>
        // Smooth scroll functions
        
        // Scroll to top button
        $(function(){
            $("#scrollToTopBtn").click(function(){
                $("html,body").animate({scrollTop:0},"1300");
                return false
            })
        })
        
        // Closes the navbar drop-down in mobile view when a link i pressed
        $('.navbar-nav>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });

        $( window ).on( "load", function() {
            $('#loadingScreen').fadeOut();
            $('#mainContent').css('min-height', $( window ).height());
            CheckCoockieConstent();
        });

        function CheckCoockieConstent() {
            if(!Cookies.get('consent')){
                Cookies.set('consent', 'false', { expires: 14 });
            }
            else if(Cookies.get('consent') ==  'true'){
                    $('#cookieConsentDiv').hide();
            }
            return null;
        }

        $(function(){
            $('#agreeCookies').click(function(){
                Cookies.set('consent', 'true', { expires: 14 });
                $('#cookieConsentDiv').hide();
                return null;
            })
        })


        </script>
    </div>
</body>
</html>