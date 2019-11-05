<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS links-->
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
        }

        #wrapper {
            min-height: 100%; 
            min-width: 100%;
        }

        .bibleStyleBig {
            font-size:40px;
        }

        .bibleStyleSmall {
            font-size:30px;
        }
        @media (max-width:991.98px){
            .mobileScale {
                transform: scale(0.7); /* Equal to scaleX(0.7) scaleY(0.7) */
                margin-top: -30%;
            }
        }
    </style>
    


    <title>Branäslägret 19-20</title>
</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/randombibelord.js')}}"></script>
    <div id="wrapper" class="mobileScale">
        <h1 style="text-align:center; font-size: 80px;">Branäslägret 2019 - 2020</h1>
        <br>
        <br>
        <h1 style="vertical-align: middle; text-align: center;" class="greyColor">Oj, vad pinsamt... Vi är inte helt färdiga än...<br> Kom tillbaka snart, för då öppnar anmälan. <br>Under tiden du väntar, <br>Har vi lämnat lite bibelord om just väntan.</h1>
        <br>
        <br>
        <br>
        
        <P style="text-align: center;" id="bibletext" class="greyColor bibleStyleBig"></p>
        <p style="text-align: center;" id="bibleverse" class="greyColor bibleStyleSmall"></p>
    </div>
</body>
</html>