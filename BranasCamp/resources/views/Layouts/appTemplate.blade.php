<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{URL::asset('img/branaslogga.png')}}"  type="img/PNG">
    <title>Branäslägret App</title>
    
    <meta name="author" content="Gustav Råkeberg, Felix Brunnegård">
    <meta name="description" content="Branäslägret är ett nyårsläger som arrangeras av equmeniakyrkans församlingar i trakten kring Herrljunga och Vårgårda. Veckan bjuder på skidåkning, Gud-snack, lägerstämning, bibel, gamla och nya vänner, aktiviteter, slappa-tid och mängder med tillfällen att njuta av livet!">
    <meta property="og:url" content="https://branaslagret.se/app">
    <meta property="og:site_name" content="Branäslägret 2018-2019">
    <meta property="og:title" content="Branäslägret">
    <meta property="og:description" content="Branäslägret är ett nyårsläger som arrangeras av equmeniakyrkans församlingar i trakten kring Herrljunga och Vårgårda. Veckan bjuder på skidåkning, Gud-snack, lägerstämning, bibel, gamla och nya vänner, aktiviteter, slappa-tid och mängder med tillfällen att njuta av livet!">

    <!-- Web App settings -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#606569">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-startup-image" content="{{URL::asset('img/branaslogga.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::asset('img/icon-144.png')}}">


    <!-- Css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/campApp.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/adminstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/jquery.dynatable.css')}}">
</head>
<body>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <!-- JS end -->

    <!-- Modal App Settings -->
    <div class="modal fade" id="settingsModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h4 class="text-center">Inställningar</h4>
                </div>
                <div class="modal-body ">
                    <p>Här kommer det finnas inställningar!</p>
                    <button style="color:white; font-family: Elkwood; font-size: 20px;" data-toggle="modal" data-target="#settingsModal" class="buttonStyle">Stäng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal App Settings End -->
    
    <!-- Header div -->
    <div class="fixed-top appHeader">
        <div class="container" style="height: 100%">
            <div class="row" style="height: 100%">
                <div class="col-2 centerTextHorizontaly" style="font-size:25px; color: #606569">
                    <a href="/app">
                        <i class="fas fa-home" style="color: #606569;"></i>
                    </a>
                </div>
                <div class="col-8 centerTextInDiv centerTextHorizontaly">
                    <h3 class="appTitel" style="margin-bottom: 0px;">Bransäs-Appen</h3>
                </div>
                <div class="col-2 centerTextHorizontaly" style="text-align: right; font-size:25px; color: #606569">
                    <button style="border: none; background: none; color: #606569" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-cog"></i></button>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Header div end -->

    
    <!-- Body div -->
    <div class="appBody">
        @yield('appContent')
    </div>
    <!-- Body div end -->

        
    <!-- Bottom nav div -->
    <div class="fixed-bottom appNav">
        <div class="container" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col centerTextInDiv centerTextHorizontaly navButtonWrapper">
                    <a href="/app/schedule" class="navButton">
                        <i class="fas fa-calendar-alt" style="color: #606569;"></i>
                    </a>
                </div>
                
                <div class="col centerTextInDiv centerTextHorizontaly navButtonWrapper">
                    <a href="/app/seminars" class="navButton">
                        <i class="far fa-comments" style="color: #606569;"></i>
                    </a>
                </div>
                
                <div class="col centerTextInDiv centerTextHorizontaly navButtonWrapper">
                    <a href="/app/gameofthrones" class="navButton">
                        <i class="fas fa-toilet-paper" style="color: #606569;"></i>
                    </a>
                </div>
                
                <div class="col centerTextInDiv centerTextHorizontaly navButtonWrapper">
                    <a  href="/app/donation"class="navButton">
                        <i class="far fa-heart" style="color: #606569;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom nav div end -->

<script>

    $(document).ready( function () {
        $currentURI = '/{{$uri}}';
        $('.navButton').each(function(index){
            if($(this).attr('href') == $currentURI){
                $(this).parent().addClass('active');
            }
        });
        
    });

</script>
</body>
</html>