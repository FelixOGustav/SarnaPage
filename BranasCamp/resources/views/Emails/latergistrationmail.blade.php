<!DOCTYPE html>

<html>
<head lang="sv">
        <meta charset="ISO-8859-1">

    <title>Efteranmälan Inbjudan</title>
</head>
<body style="margin: 0px;">
    <div style="font-family:sans-serif; text-align:center; max-width: 800px; margin-left: auto; margin-right: auto;
    padding: 0px 10px;">
        <!--
            <p style="color: #606569; font-size:50px; font-weight: bold;">Branäslägret</p>
        

        <a href="{{URL::to('/')}}" target="blank"><img src="{{URL::asset('img/branaslagret.svg')}}" style="max-width: 90%;"></a>
        -->
        <h1 style="color: #606569;">Branäslägret</h1>
        <h2 style="color: #606569;">Du, {{$name}}, har fått en inbjudan att efteranmäla dig!</h2>

        <p style="margin-bottom: 35px; color: #606569;">
            Du har fått detta mail då du har ställt dig eller ditt barn i kö för att få anmäla sig till Branäslägret.<br>
            Klicka på länken nedan för att komma till anmälan.
            <br><br>
            Om ni har några problem eller frågor angående anmälan eller lägret kan ni ta kontakt med lägerledningen eller
            en ungdomsledare. Kontaktinfo hittar ni 
            <a href="{{URL::to('/#KontaktInfo')}}" target="blank" style="color: #606569;">
                här
            </a> 
            eller på startsidan.
        </p>
        
        <div style="text-align:left;">
            <p style="color:#606569; font-style:italic; margin-top: 35px; font-size: 15px;">
                Ledarna, Branäslägret
            </p>
        </div>

        <a href="{{$link}}"  style="color: white; background-color:#606569; padding: 12px; border-radius: 3px;
        text-decoration: none;">
            Klicka här för att efteranmäla dig
        </a>
        <div style="margin-top: 30px;">
            <a href="{{$link}}">{{$link}}</a>
        </div>
        
        
    </div>
    
</body>
</html>