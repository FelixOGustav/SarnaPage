<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branäslägret Admin-sida</title>
    
    <!-- CSS links-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/adminstyle.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="{{URL::asset('js/scrollToTop.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Loading content -->

    <div class="loadingBG" id="loadingScreen">
        <div class="loadingContent centerTextInDiv">
            <img src="{{URL::asset('img/snowflakeLoading.gif')}}" type="img/gif">
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
        <div id="sidebar">
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
                <li class="sidebarbutton">
                    <button data-toggle="collapse" data-target="#regsubgroup">
                        <i class="fas fa-list-ol"></i>
                        <span>Anmälningar</span>
                        <i class="fas fa-caret-down"></i>
                    </button>
                </li>

                <div class="collapse registrationssubmenu" id="regsubgroup">
                    <li class="sidebarbutton">
                        <a href="#">
                            <span>Deltagarlistor</span>
                        </a>
                    </li>
                    <li class="sidebarbutton">
                        <a href="#">
                            <span>Ledarlistor</span>
                        </a>
                    </li>
                </div>

                <li class="sidebarbutton">
                    <a href="/admin/register">
                        <i class="fas fa-user-plus"></i>
                        <span>Lägg till användare</span>
                    </a>
                </li>
                <li class="sidebarbutton">
                    <a href="/admin/manageusers">
                        <i class="fas fa-user-edit"></i>
                        <span>Hantera användare</span>
                    </a>
                </li>
                <li class="sidebarbutton">
                    <a href="/admin/managecamps">
                        <i class="fas fa-campground"></i>
                        <span>Hantera läger</span>
                    </a>
                </li>
                <li class="sidebarbutton">
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Schema</span>
                    </a>
                </li>
                <li class="sidebarbutton">
                    <a href="#">
                        <i class="fas fa-toilet-paper"></i>
                        <span>Game of Thrones</span>
                    </a>
                </li>
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
        <div id="content" style="min-width: 75%;">

            <!-- Top bar -->
            <div class="topBar">
                <i class="fas fa-link"></i>
                <a href="/">Branäslägret.se</a>
            </div>
            
            <!-- Main site content -->
            <div class="contentcontainer">
                @yield('content')

                <table class="statisticscardstable">
                    <tr>
                        <td>
                            <div class="registrationscountcard participant">
                                <table style="width: 100%;">
                                    <tr>
                                        <td><h2>Deltagare</h2></td>
                                    </tr>
                                    <tr>
                                        <td><h1>000</h1></td>
                                        <td><i class="fas fa-child statisticscardicon"></i></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; background-color:orangered; text-align: center;"><a>Visa deltagare</a></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        
                        <td>
                            <div class="registrationscountcard leader">
                                <div>
                                    <h2>Deltagare</h2>
                                    <h1>000</h1>
                                    <i class="fas fa-user-astronaut statisticscardicon"></i>
                                    <h4>Visa deltagare</h4>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

             </div>
        </div>
    </div>

    <script>
    
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