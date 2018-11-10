@extends('Layouts/template')
@section('content')
    
    <div class="ScaleStartPageLogo">
        <img  class="bigLogo" src="../img/branaslagret.svg" alt="Särnalägret">
        <h1 class="dateLogo">27 dec - 1 jan</h1>        
        <h1 class="dateLogo">2018 - 2019</h1>

        <div class="container-fluid d-flex justify-content-center">
            <button class="buttonStyle" data-toggle="modal" data-target="#registerChoiseModal"><p>Anmäl dig!</p></button>
        </div>
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
                            <a href="/registration" class="col modalButtonStyle"><h3 class="whiteColor">Deltagare</h3></a>
                            <button href="#" class="col modalButtonStyle"><h3 class="whiteColor">Ledare</h3></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
        <div class="container-fluid startPageInfo paddingBottom">
            <h1>Plats</h1>
            <h3>Vi sover i Kvistbergskolan i Sysslebäck, Värmland. Vi åker skidor i Branäs</h3>
            <h1>Åldersgräns</h1>
            <h3>För dig som är född 2005 eller tidigare</h3>
        </div>

        <div class="invisibleSpacer"></div>

        <!-- What is branaslagret info -->
        <div class="container-fluid bg-white paddingBottom paddingTop" id="branaslagretInfo">
            <div class=" container centerTextInDiv">
                <h1>Vad är Branäslägret?</h1>
                <p>Branäslägret är ett nyårsläger som varje år arrangeras av Equmeniaförsamlingarna i Vårgårda och Herrljungtrakten.
                    Lägret riktar sig till tonåringar (födda senast 2005) och bjuder på en vecka av skidåkning, snack om Gud och bibel,
                    gamla och nya vänner, aktiviteter av olika slag och mängder med tillfällen att njuta av livet! Lägret hålls i Kvistbergskolan
                    i Sysslebäck, 10 min norr om Branäs
                </p>
                <h1><br>Hur kan en dag se ut</h1>
                <p>En vanlig dag börjar med frukost i matsalen. Därefter träffas tonåringar och ledare från respektive ort för att snacka
                    om hur tonåringarna upplever lägret, presentera dagens aktiviteter och tema och kanske leka en lek tillsammans. Runt 9
                    går bussarna mot Branäs för att dem som skall till pisten. Väl där serveras sedan en lättare mack-lunch vid kl 12.
                    Bussarna kommer sedan tillbaka från backen senast kl 17, då väntar en god kvällsmat. På eftermiddagen träffas man med sin
                    tvärgrupp. Tvärgruppen består av en grupp tonåringar från olika orter men i ungefär samma ålder. Tillsammans med ett par 
                    ledare pratar pratar man om hur dagen har varit, om dagen bibeltext, man lär känna varandra, prata och har roligt. För de 
                    deltagare som inte åker iväg till Branäs finns det gott om fria aktiviteter på skolan, spela spel, pyssla, idrotta eller 
                    bara slappa och ha de gött. Under kvällen är det ofta spex och något roligt program i matsalen innan det är dags för en andakt. 
                    Andakaterna är delade i två delar. Under det första stunden vill vi att alla deltagare är med, sedan följer en frivilig del 
                    för dem som vill stanna lite längre. På andakterna sjunger man tillsammans och lyssnar på någon som berättar om sin tro. 
                    För den som är hungrig serveras en lättare kvällsmat efter andakten, och sen är det läggdags som gäller! 
                    <br>
                    Branäslägret är ett läger med kristen grund. Alla som hjälper till med lägret har en relation till kyrkan och en personlig 
                    tro på Gud. För oss är den kristna tron en central byggsten i våra liv, men oavsett vilken tro eller livsåskådning du har 
                    är du alltid välkommen på våra läger!
                </p>
                <h1><br>Vänta inte med att anmäla dig</h1>
                <p>Det är högt tryck på platserna, så vänta inte med att anmäla dig! Anmälan öppnar i november här på hemsidan. Vi sover på luftmadrasser 
                    som man tar med sig själva. Avfärd till lägret sker tidigt på morgonen den 27 Dec. Vi åker bussar upp till lägret. Hemfärd 
                    sker den 1 Jan. Det är svårt att säga i förväg exakt vilken tid bussarna anländer då det beror på väder och väglag. Vi håller 
                    ungdomarna informerade under resans gång!
                </p>
                <h1><br>För föräldrar</h1>
                <p>Branäslägret anordnas av flera Equmeniaförsamlingar i Vårgårda- & Herrljungtrakten. Lägret är en plats där ungdomar får lära känna nya 
                    vänner i sin alla åldrar, men också skapar viktiga relationer till ledare och vuxna, vilket kan bli till ett stort stöd till tonåringarna.
                    <br>
                    Lägret har fått vara en mötesplats för nya bekantskaper och en plats där tonåringar och unga vuxna fått möjlighet att växa i sig 
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
                <h3>Lägeravgift - 1500 kr</h3>
                <br>
                <h2>Skidor och lifkort beställs senare, mer information om detta kommer med mail i december</h2>
                <h2>Liftkort (Ungdom 8-15)</h2>
                <h3>1 Dag - 260 kr</h3>
                <h3>2 Dag - 520 kr </h3>
                <h3>3 Dag - 750 kr</h3>
                <h3>4 Dag - 950 kr</h3>
                <h2><br>Liftkort (Vuxen 16+)</h2>
                <h3>1 Dag - 340 kr</h3>
                <h3>2 Dag - 660 kr </h3>
                <h3>3 Dag - 950 kr</h3>
                <h3>4 Dag - 1220 kr</h3>
                <h2><br>Skidhyra</h2>
                <h3>Skidor - 400 kr</h3>
                <h3>Snowboard - 300 kr</h3>
                <h3>Längdskidor - 100 kr</h3>
                <p>OBS! Priserna är preliminära</p>
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
            <div class="centerTextInDiv paddingTop" id="faqInfo">
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

   

    <!-- scroll to top btn -->

    <script>

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
    
    @endsection