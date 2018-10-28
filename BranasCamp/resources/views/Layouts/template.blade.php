<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{URL::asset('img/branaslogga.png')}}"  type="img/PNG">

    <!-- CSS links-->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">

    <title>{{config('app.name', 'Branäslägret')}}</title>
</head>
<body class="mainBG">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="{{URL::asset('js/scrollToTop.js')}}"></script>

    <!-- Navbar -->
    
    <div class="navbar navbar-expand-lg navbar-light navbarBG fixed-top navbar-custom">
        <div>
            <a class="navbar-brand"  id="scrollToTopLogo" href="{{$links['navLogoLink']}}"><img src="../img/branaslagret.svg" height="40" class="d-inline-block align-top"></a>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarBasic">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['infoLink']}}" id="scrollToBranaslagretBtn">Branäslägret?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['prisLink']}}" id="scrollToPrisBtn">Pris <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['reglerLink']}}" id="scrollToReglerBtn">Regler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['faqLink']}}" id="scrollTofaqBtn">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="{{$links['kontaktLink']}}" id="scrollToKontaktBtn">Kontakt</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navbar end -->

    <!-- Main Site Content -->
    <div class="container-fluid noPadding" style="min-height: 850px;"><!-- min-height should be able to be removed later -->
        <div class="navbarSpacer" ></div> <!-- Spacer so that content doesn't start under navbar -->
        @yield('content')
        
    <!-- Footer -->

    <div class="footerBG row" style="margin: 0px;" id="footerId">
        <div class="col" style="margin-top: auto; margin-bottom: auto; text-align: center">
            <a href="#" class="same-as-p whiteColor scaleFooterTextToMobile">Om hemsidan<br><br></a>
            <a href="#" class="same-as-p whiteColor scaleFooterTextToMobile">GDPR<br><br></a>
            <a href="#" class="same-as-p whiteColor scaleFooterTextToMobile">Admin-sidan</a>
        </div>

        <div class="col">
            <a href="http://www.equmenia.se/" target="blank"><img src="{{URL::asset('img/EqumeniaTextLogga.png')}}" class="footerImg"></a>
        </div>
        <div  class="col">
            <a href="http://www.equmenia.se/" target="blank"><img src="{{URL::asset('img/EqumeniakyrkanKorsLogga.png')}}" class="footerImg"></a> 
        </div>
    </div>

    <!-- Footer end -->
    <button id="scrollToTopBtn" title="Go to top" class="dropShadow"><img src="../img/arrowUp.png"></button>

    <script>
        // Smooth scroll functions
        
        // Scroll to top button
        $(function(){
            $("#scrollToTopBtn").click(function(){
                $("html,body").animate({scrollTop:0},"1300");
                return false
            })
        })
        </script>
    </div>
</body>
</html>