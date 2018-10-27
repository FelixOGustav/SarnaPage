<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/snowflake.PNG" type="img/PNG">

    <!-- CSS links-->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/navbarcstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/footerstyle.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/mainstyle.css')}}">

    <title>Särnalägret</title>
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
            <a class="navbar-brand"  id="scrollToTopLogo" href="#"><img src="../img/branaslagret.svg" height="40" class="d-inline-block align-top"></a>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarBasic">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="#" id="scrollToBranaslagretBtn">Branäslägret?</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="#" id="scrollToPrisBtn">Pris <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="#" id="scrollToReglerBtn">Regler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="#" id="scrollTofaqBtn">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-custom ElkwoodNavbar navbarItemSpacing" href="#" id="scrollToKontaktBtn">Kontakt</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Navbar end -->

    <!-- Main Site Content -->
    <!-- Example content -->
    <div class="container-fluid noPadding" style="min-height: 850px;"><!-- min-height should be able to be removed later -->
        <div class="navbarSpacer" ></div> <!-- Spacer so that content doesn't start under navbar -->

        <img  class="bigLogo" src="../img/branaslagret.svg" alt="Särnalägret">
        <h1 class="dateLogo">27 dec - 1 jan</h1>        
        <h1 class="dateLogo">2018 - 2019</h1>

        <div class="container-fluid d-flex justify-content-center">
            <button class="buttonStyle" data-toggle="modal" data-target="#registerChoiseModal"><p>Anmäl dig!</p></button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="registerChoiseModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h4 class="text-center">Deltagare Eller Ledare?</h4>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <button href="#"" class="col modalButtonStyle"><h3 class="whiteColor">Deltagare</h3></button>
                        <button href="#"" class="col modalButtonStyle"><h3 class="whiteColor">Ledare</h3></button>
                    </div>
                </div>
            </div>
            
        </div>
        </div>

        
        
        <div class="container-fluid startPageInfo paddingBottom">
            <h1>Plats</h1>
            <h3>Vi sover i Kvistbergskolan i Torsby, Värmland. Vi åker skidor i Branäs</h3>
            <h1>Åldersgräns</h1>
            <h3>För dig som är född 2004 eller tidigare</h3>
        </div>

        <div class="invisibleSpacer"></div>

        <!-- What is branaslagret info -->
        <div class="container-fluid bg-white paddingBottom paddingTop" id="branaslagretInfo">
            <div class=" container centerTextInDiv">
                <h1>Vad är Branäslägret?</h1>
                <p>Branäslägret är ett nyårsläger som varje år arrangeras av Equmeniaförsamlingarna i Vårgårda och Herrljungtrakten.
                    Lägret riktar sig till tonåringar (födda senast 2004) och bjuder på en vecka av skidåkning, snack om Gud och bibel,
                    gamla och nya vönner, aktiviteter av olika salg och mängder med tillfällen att njuta av livet! Lägret hålls i Kvistbergskolan
                    i Sysslebäck, 10 min norr om branäs
                </p>
                <h1><br>Hur kan en dag se ut</h1>
                <p>En vanlig dag börjar med frukost i matsalen. Därefter träffas tonåringar och ledare från respektive ort för att snacka
                    om hur tonåringarna upplever lägret, presentera dagens aktiviteter och tema och kanske leka en lek tillsammans. Runt 9
                    går bussarna mot Branäs för att dem som skall till pisten. Väl där serveras sedan en lättare mack-lunch vid kl 12.
                    Bussarna kommer sedan tillbaka från backen senast kl 17, då väntar en god kvällsmat. På eftermiddagen träffas man med sin
                    tvärgrupp. tvärgruppen består av en grupp tonåringar från olika orter men i ungefär samma ålder. tillsammans med ett par 
                    ledare pratar pratar man om hur dagen har varit, om dagen bibeltext, man lär känna varandra, prata och har roligt. För de 
                    deltagare som inte åker iväg till Branäs finns det gott om fria aktiviteter på skolan, spela spel, pyssla, idrotta eller 
                    bara slappa och ha de gött. Under kvällen är det ofta spex och något roligt program i matsalen innan det är dags för en andakt. 
                    Andkaterna ör delade i två delar. Under det första stunden vill vi att alla deltagare är med, sedan följer en frivilig del 
                    för dem som vill stanna lite längre. På andakterna sjunger man tillsammans och lyssnar på någon som berättar om sin tro. 
                    För den som är hungrig server en lättare kvällsmat efter andakten, och sen är det läggdags som gäller! 
                    <br>
                    Branäslägret är ett läger med kristet grund. Alla som hjälper till med lägret har en relation till kyrkan och en personlig 
                    tro på Gud. För oss är den kristen tron en central byggsten i våra liv, men oavsett vilken tro eller livsåskådning du har 
                    är du alltid välkommen på våra läger!
                </p>
                <h1><br>Vänta inte med att anmäla dig</h1>
                <p>Det är högt tryck på plattserna, så vänta inte med att anmäla dig! Anmälan öppnar 1 nov här på hemsidan. Vi somer på luftmadrasser 
                    som man tar med sig själva. Avfärd till lägret sker tidigt på morgonen den 27 Dec. Vi åker bussar upp till lägret. Hemfärd 
                    sker den 1 Jan. Det är svårt att säga i förväg exakt vilken tid bussarna anländer då det beror på väder och väglag. Vi håller 
                    ungdommarna informerade under resans gång!
                </p>
                <h1><br>För föräldrar</h1>
                <p>Branäslägret anordnas av flera Equmeniaförsamlingar i Vårgårdatrakten. Lägret är en platts där ungdommar får lära känna nya 
                    vänner i sin egen ålder, men också skapar viktiga relationer till ledare och vuxna, vilket kan bli till ett stort stöd till tonåringarna.
                    <br>
                    lägret har fått vara en mötesplats för nya bekantskaper och en plats där tonåringar och unga vuxna fått möjlighet att växa i sig 
                    själv och i en eventuell tro. Branäslägret är ett läger med en kristen grund. Alla som hjälper till med lägret har en relation 
                    till kyrkan och en personlig tro på Gud. För oss är den kristen tron en central byggsten i våra liv, men oavsett vilken tro eller 
                    livsåskådning du har är du alltid välkommen på våra läger! Vi ledare som är med och jobbar inför lägret är väldigt förväntansfulla 
                    och ser fram emot ännu ett härligt nyårsläger med mycket snö, glädje, kärlek och Gud.
                    <br>
                    Vi hoppas att alla som vill ska hänga med oss till Branäslägret!
                </p>
            </div>
        </div>
        <!-- What is branaslagret end -->

        <div class="invisibleSpacer"></div>

        <!-- Pris info -->
        <div class="container-fluid bg-white paddingBottom paddingTop" id="prisInfo">
            <div class="centerTextInDiv">
                <h1>Pris</h1>
                <h3>Lägeravgift - 1950 kr</h3>
                <h3>Med syskonrabatt - 1550 kr</h3>
                <h2><br>Liftkort</h2>
                <h3>1 Dag - 200 kr</h3>
                <h3>2 Dag - 400 kr</h3>
                <h3>3 Dag - 450 kr</h3>
                <h2><br>Skidhyra</h2>
                <h3>Skidor - 400 kr</h3>
                <h3>Snowboard - 300 kr</h3>
                <h3>Längdskidor - 100 kr</h3>
            </div>
        </div>
        <!-- Pris info end -->

        <div class="invisibleSpacer"></div>

        <!-- Regler info -->
        <div class="container-fluid bg-white paddingBottom paddingTop" id="ReglerInfo">
                <div class="container centerTextInDiv">
                    <h1>Regler</h1>
                    <h3>- Tider ska följas</h3>
                    <h3>- Ledarna är de som bestämmer</h3>
                    <h3>- Du ska vara med på de obligatoriska aktiviteterna</h3>
                    <h3>- Nolltolerans mot alkohol och droger</h3>
                    <h3>- Avanmälan efter sista anmälningsdagen utan giltigt läkarintyg eller överenskommande med 
                        lägerledningen gör att man måste betala lägeravgiften. Eventuell kostnad för liftkort/skidhyra 
                        behöver inte betalas.
                    </h3>
                </div>
            </div>
            <!-- Regler info end -->

        <div class="invisibleSpacer"></div>

        <!-- QnA -->

        <div class="container paddingBottom">
            <div class="centerTextInDiv" id="faqInfo">
                <h1>Frågor och svar</h1>
            </div>
            <div class="container">
                <div class="row">
                    <!-- Left row -->
                   <div class="qnaBound">
                        <!-- Question 1-->
                        <div class="col qnaBtnSize">
                            <div class="qnaBox BGGrey text-center">
                                <div>
                                    <h2 data-toggle="collapse" href="#question1" aria-expanded="false" aria-controls="collapseExample" class="whiteColor" style="cursor: pointer;">Fråga 1</h2>
                                </div>
                                <div class="collapse" id="question1">
                                    <p class="whiteColor">Svaret på alla dina frågor!</p>
                                </div>
                            </div>
                        </div>
                        <!-- Question 1 end-->
                        <!-- Question 2-->
                        <div class="col qnaBtnSize">
                            <div class="qnaBox BGGrey text-center">
                                <div>
                                    <h2 data-toggle="collapse" href="#question2" aria-expanded="false" aria-controls="collapseExample" class="whiteColor" style="cursor: pointer;">Fråga 2</h2>
                                </div>
                                <div class="collapse" id="question2">
                                    <p class="whiteColor">Svaret på alla dina frågor!</p>
                                </div>
                            </div>
                        </div>
                        <!-- Question 2 end-->
                        <!-- Add more questions here. Dont forget to change href and id for the collapse-->
                    </div>
                    <!-- Left row end-->
                    <!-- Right row-->

                    <div  class="qnaBound">
                        <!-- Question 2-->
                        <div class="col qnaBtnSize">
                            <div class="qnaBox BGGrey text-center">
                                <div>
                                    <h2 data-toggle="collapse" href="#question3" aria-expanded="false" aria-controls="collapseExample" class="whiteColor" style="cursor: pointer;">Fråga 3</h2>
                                </div>
                                <div class="collapse" id="question3">
                                    <p class="whiteColor">Svaret på alla dina frågor!</p>
                                </div>
                            </div>
                        </div>            
                        <!-- Question 3 end-->

                        <!-- Question 4-->
                        <div class="col qnaBtnSize">
                            <div class="qnaBox BGGrey text-center">
                                <div>
                                    <h2 data-toggle="collapse" href="#question4" aria-expanded="false" aria-controls="collapseExample" class="whiteColor" style="cursor: pointer;">Fråga 4</h2>
                                </div>
                                <div class="collapse" id="question4">
                                    <p class="whiteColor">Svaret på alla dina frågor!</p>
                                </div>
                            </div>
                        </div>                    
                        <!-- Question 4 end-->
                        <!-- Add more questions here. Dont forget to change href and id for the collapse-->
                    </div>
                    <!-- Right row end -->
                </div>
            </div>
        </div>

        <!-- QnA End -->

        <div class="invisibleSpacer"></div>
        
        <!-- Kontakt info -->
        <div class="container-fluid bg-white paddingBottom paddingTop" id="KontaktInfo">
                <div class="container centerTextInDiv">
                    <h1>Kontakt</h1>
                    <!-- Kontakt lägerchefer -->
                    <div>
                        <h2><br>Lägerledning</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Jonatan Davidsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Louise Persson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0709-80 90 14</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Alice Rydsom</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0767-07 19 95</p>
                                    </td>
                                </tr>
                           </tbody>
                        </table>
                    </div>
                    <!-- Kontakt lägerchefer end -->

                    <!-- Kontakt krisgrupp -->
                    <div>
                        <h2><br>krisgrupp</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Karl karlsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontakt krisgrupp end -->

                    <!-- Kontakt Uthyrning -->
                    <div>
                        <h2><br>Uthyrning Utrustning</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Karl karlsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontakt Uthyrning end -->

                    <!-- Kontakt Liftkort -->
                    <div>
                        <h2><br>Liftkort</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Karl karlsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontakt Liftkort end -->

                    <!-- Kontakt sjukvårdsansvarig -->
                    <div>
                        <h2><br>sjukvårdsansvarig</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Karl karlsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontakt sjukvårdsansvarig end -->

                    
                    <!-- Kontakt köksansvarig -->
                    <div>
                        <h2><br>köksansvarig</h2>
                        <table style="display: flex; justify-content: center;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="margin-right: 5px;">Karl karlsson</h5>
                                    </td>
                                    <td>
                                        <p style="margin-top: 8px; margin-left: 5px;">0713 37 13 37</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kontakt köksansvarig end -->
                </div>
            </div>
            <!-- Kontakt info end -->

    </div>

    <!-- Main Site Content End -->

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
   

    <!-- scroll to top btn -->

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

        // Scroll to top logo
        $(function(){
            $("#scrollToTopLogo").click(function(){
                $("html,body").animate({scrollTop:0},"1300");
                return false
            })
        })
        
        // Scroll to pris
        $(function(){
            $("#scrollToPrisBtn").click(function(){
                $("html,body").animate({scrollTop: $("#prisInfo").offset().top},"1300");
                return false
            })
        })
        
        // Scroll to branaslagret?
        $(function(){
            $("#scrollToBranaslagretBtn").click(function(){
                $("html,body").animate({scrollTop: $("#branaslagretInfo").offset().top},"1300");
                return false
            })
        })
        
        // Scroll to Regler
        $(function(){
            $("#scrollToReglerBtn").click(function(){
                $("html,body").animate({scrollTop: $("#ReglerInfo").offset().top},"1300");
                return false 
            })
        })

        
        // Scroll to faq
        $(function(){
            $("#scrollTofaqBtn").click(function(){
                $("html,body").animate({scrollTop: $("#faqInfo").offset().top},"1300");
                return false
            })
        })

        
        // Scroll to kontakt
        $(function(){
            $("#scrollToKontaktBtn").click(function(){
                $("html,body").animate({scrollTop: $("#KontaktInfo").offset().top},"1000");
                return false
            })
        })
    </script>
    <!-- scroll to top btn end -->


</body>
</html>