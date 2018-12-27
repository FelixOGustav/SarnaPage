<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{URL::asset('img/branaslogga.png')}}"  type="img/PNG">
    <title>Branäslägret Admin-sida</title>
    
    <!-- CSS links-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/adminstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/jquery.dynatable.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/datatables.css')}}"/>
    




</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="{{URL::asset('js/scrollToTop.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- <script src="{{URL::asset('js/jquery.dynatable.js')}}"></script> -->
    
    <!-- Datatables -->
    <script type="text/javascript" src="{{URL::asset('js/datatables.js')}}"></script>
    <script src="{{URL::asset('js/adminsidenav.js')}}"></script>

    <script src="{{URL::asset('js/moment.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
    

    <!-- Loading content -->

    <div class="loadingBG" id="loadingScreen">
        <div class="loadingContent centerTextInDiv">
            <img src="{{URL::asset('img/branaslogga_white.png')}}" type="img/PNG" class="rotating">
            <p class="whiteColor">Vänta lite..</p>
        </div>
    </div>
    
    <!-- Loading content  end-->

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
    
    <!-- Site Content -->
    <div class="wrapper" style="color: white;">
        <!-- Sidebar -->
        <div id="sidebar" style="overflow-y: auto;">
            <div class="sidebarName">
                <h4>{{Auth::user()->name}}</h4>
            </div>
            <hr class="sidebarmenuline">

            <!-- Menu navigation buttons -->
            <ul style="padding: 0px;">
                <li class="sidebarbutton">
                    <a href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <span>Start</span>
                    </a>
                </li>

                @can('registrationlists')
                <li class="sidebarbutton">
                    <button data-toggle="collapse" data-target="#regsubgroup">
                        <i class="fas fa-list-ol"></i>
                        <span>Anmälningar</span>
                        <i class="fas fa-caret-down"></i>
                    </button>
                </li>

                <div class="collapse registrationssubmenu" id="regsubgroup">
                    <li class="sidebarbutton">
                        <a href="/admin/registrationlists/participant">
                            <span>Deltagarlistor</span>
                        </a>
                    </li>
                    <li class="sidebarbutton">
                        <a href="/admin/registrationlists/leader">
                            <span>Ledarlistor</span>
                        </a>
                    </li>
                </div>
                @endcan

                @can('adduser')
                <li class="sidebarbutton">
                    <a href="/admin/register">
                        <i class="fas fa-user-plus"></i>
                        <span>Lägg till användare</span>
                    </a>
                </li>
                @endcan

                @can('manageusers')
                <li class="sidebarbutton">
                    <a href="/admin/manageusers">
                        <i class="fas fa-user-edit"></i>
                        <span>Hantera användare</span>
                    </a>
                </li>
                @endcan

                @can('managecamps')
                <li class="sidebarbutton">
                    <a href="/admin/managecamps">
                        <i class="fas fa-campground"></i>
                        <span>Hantera läger</span>
                    </a>
                </li>
                @endcan

                @can('admin')
                <li class="sidebarbutton">
                    <a href="/admin/lateregistration">
                        <i class="fas fa-clock"></i>
                        <span>Sen anmälan</span>
                    </a>
                </li>
                <li class="sidebarbutton">
                    <a href="/admin/mail">
                        <i class="fas fa-envelope"></i>
                        <span>Mail</span>
                    </a>
                </li>
                @endcan

                @can('schedule')
                <li class="sidebarbutton">
                    <a href="/admin/schedule">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schema</span>
                    </a>
                </li>
                @endcan

                @can('game_of_thrones')
                <li class="sidebarbutton">
                    <a href="/admin/gameofthrones">
                        <i class="fas fa-toilet-paper"></i>
                        <span>Game of Thrones</span>
                    </a>
                </li>
                @endcan

                @can('seminars')
                <li class="sidebarbutton">
                    <a href="/admin/seminars">
                        <i class="far fa-comments"></i>
                        <span>Seminarie</span>
                    </a>
                </li>
                @endcan
                
                @can('insamling')
                <li class="sidebarbutton">
                    <a href="/admin/insamling">
                        <i class="far fa-heart"></i>
                        <span>Insamling</span>
                    </a>
                </li>
                @endcan
            </ul>

            <!-- Logout button -->
            <div class="logoutbtn">
                <hr class="sidebarmenuline">
                <a href="{{ route('logout') }}" class="adminNavBlock" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logga ut</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="content">

            <!-- Top bar -->
            <div class="topBar">
                <a id="sidebarshowbtn">
                    <i class="fas fa-bars sidebarshowbtn"></i>
                </a>
                <span>
                    <i class="fas fa-link" style="color: #606569;"></i>
                    <a href="/">Branäslägret.se</a>
                </span>
            </div>
            
            <!-- Main site content -->
            <div class="contentcontainer" id="contentcontainer">
                @yield('adminContent')
             </div>
        </div>
    </div>

    <button id="scrollToTopBtn" title="Go to top" class="dropShadow" style="left:initial ; right: 20px;"><img src="{{URL::asset('img/arrowUp.png')}}"></button>

    <script>
        
        // Scroll to top button
        $(function(){
            $("#scrollToTopBtn").click(function(){
                $("html,body").animate({scrollTop:0},"1300");
                return false
            })
        })

        // Fades out loading screen when done loading and then calls function to check cookies 
        $( window ).on( "load", function() {
            $('#loadingScreen').fadeOut();
            $('#mainContent').css('min-height', $( window ).height());
            CheckCoockieConstent();
        });

        // Check if cookies message have been dismissed or not
        function CheckCoockieConstent() {
            if(!Cookies.get('consent')){
                Cookies.set('consent', 'false', { expires: 14 });
            }
            else if(Cookies.get('consent') ==  'true'){
                    $('#cookieConsentDiv').hide();
            }
            return null;
        }
        
        // Set the cookie consent cookie to true and hides the message
        $(function(){
            $('#agreeCookies').click(function(){
                Cookies.set('consent', 'true', { expires: 14 });
                $('#cookieConsentDiv').hide();
                return null;
            })
        })

    </script>
</body>
</html>