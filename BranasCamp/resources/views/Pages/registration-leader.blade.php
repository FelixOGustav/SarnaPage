@extends('Layouts/template')
@section('content')
<div class="bg-white">
    <div class="BGGrey">
        <h1 style=" margin-top: 3rem; text-align: center;" class="anmalan whiteColor">Anmälan</h1>
        <h2 style="text-align: center;" class="rubrikerAnmalan whiteColor">Ledarsidan</h2>
    </div>
    @if($errors->any())
            <div style="padding: 2rem; background-color: rgb(212, 44, 44);">
                <h2 style="color: black;">Följande information du angivigt är ej giltig</h2>
                @foreach ($errors->all() as $error)
                    <li>- {{$error}}</li> 
                @endforeach
            </div>
        @endif
    @if($key)
    <form method="POST" action="/registration/leader/{{$key}}/done">
    @else
    <form method="POST" action="/registration/leader/done">
    @endif
        {{ csrf_field() }}
    <div class="container">
        <!-- Start deltagare -->
        <div style="margin-top: 5rem;"><h2 style="text-align: center;" class="rubrikerAnmalan">Ledare</h2></div>
            <div>  
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">Förnamn</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName') }}" placeholder="Namn" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Efternamn</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName') }}" placeholder="Namnsson" required>
                    </div>
                </div>
                <div class="form-group col-md-12 noPadding">
                    <label for="firstName">Personnummer</label>
                    <input type="text" class="form-control" maxlength="10" id="socialSecurityNumber" name="socialSecurityNumber" value="{{ old('socialSecurityNumber') }}" placeholder="ÅÅMMDDXXXX" required>
                </div>
                <div class="form-group container-fluid noPadding">
                    <label for="inputCity">Adress</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Vintergatan 42" required> 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                                <label for="inputZip">Postnummer</label>
                                <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}" placeholder="13337" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputCity">Postort</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Vintergårda" required>
                    </div>
                </div>
                    <div class="form-group col-md-12 noPadding">
                        <label for="firstName">E-post</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="namn.namnsson@namn.se" required>
                    </div>
                    <div class="form-group col-md-12 noPadding">
                        <label for="firstName">E-post bekräftelse</label>
                        <input type="email" class="form-control" id="emailConfirm" name="emailConfirm" value="{{ old('emailConfirm') }}" placeholder="namn.namnsson@namn.se" onpaste="return false;" required>
                    </div>
                    <div class="form-group container-fluid noPadding">
                            <label for="inputCity">Telefon</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="0713-371337" required> 
                    </div>
                    <div>
                        <label for="allergy">Allergi (max 300 tecken)</label>
                        <textarea class="form-control container-fluid" name="allergy" id="allergy" cols="165" rows="5" value="{{ old('allergy') }}"></textarea>
                    </div>
                    <div>
                        <label for="other">Övrigt</label>
                        <textarea class="form-control container-fluid" name="other" id="other" cols="165" rows="5" value="{{ old('other') }}"></textarea>
                    </div>
                </div>
            <!-- Slut deltagare -->
            <!-- Start Ort -->
            <div style="margin-top: 3rem;">
                    
                <div ><h2 style="text-align: center; " class="rubrikerAnmalan">Ort</h2></div>
                <div class="form-group container-fluid noPadding" >
                    <label for="place">Orten</label>
                    <select id="place" name="place" class="form-control" required>
                            <option value="">Välj...</option>
                        @foreach($places as $place)
                            <option value="{{$place->placeID}}" {{old("place") == $place->placeID ? "selected":""}}>{{$place->placename}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Slut Ort -->
                <div>
                    <label for="place">Vill du stå i köket? (500kr rabatt)</label>
                    <select onchange="ChangePrice.call(this, event)" id="kitchen" name="kitchen" class="form-control" required>
                        <option value="">Välj...</option>
                        <option value="0">Nej, jag är en kvällsmänniska..</option>
                        <option value="1">Absoult, jag är ju en smålänning</option>
                    </select>
                </div>
            <!-- Skidhyra -->
    </div>
            <!--
            <div class="BGGrey" style="padding-bottom: 3rem; padding-top: 3rem; margin-top:3rem; ">
                <h3 style="text-align:center;" class="whiteColor">OBS! Information om att köpa liftkort och hyra utrustning, kommer skickas ut i början av december.</h3>
            </div>
             -->
    <div class="container">
            <!-- Start Målsman -->
            <div style="padding-top: 3rem;">    
                <div><h2 style="text-align: center;" class="rubrikerAnmalan">Kontaktuppgifter närstående</h2></div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstNameAdvocate">Förnamn målsman</label>
                        <input type="text" class="form-control" id="firstNameAdvocate" name="firstNameAdvocate" value="{{ old('firstNameAdvocate') }}" placeholder="Namn" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastNameAdvocate">Efternamn målsman</label>
                        <input type="text" class="form-control" id="lastNameAdvocate" name="lastNameAdvocate" value="{{ old('lastNameAdvocate') }}" placeholder="Namnsson" required>
                    </div>
                </div>
                <div class="form-group col-md-12 noPadding">
                    <label for="firstName">E-post</label>
                    <input type="email" class="form-control" id="emailAdvocate" name="emailAdvocate" value="{{ old('emailAdvocate') }}" placeholder="namn.namnsson@namn.se" required>
                </div>
                <div class="form-group col-md-12 noPadding">
                    <label for="firstName">E-post bekräftelse</label>
                    <input type="email" class="form-control" id="emailAdvocateConfirm" name="emailAdvocateConfirm" value="{{ old('emailAdvocateConfirm') }}" placeholder="namn.namnsson@namn.se" onpaste="return false;" required>
                </div>
                <div class="form-group container-fluid noPadding">
                        <label for="inputCity">Telefon</label>
                        <input type="text" class="form-control" id="phoneNumberAdvocate" name="phoneNumberAdvocate" value="{{ old('phoneNumberAdvocate') }}" placeholder="0713-371337" required> 
                </div>
                <div class="form-group container-fluid noPadding">
                        <label for="inputCity">Hemtelefon (ej obligatorisk)</label>
                        <input type="text" class="form-control" id="homeNumberAdvocate" name="homeNumberAdvocate" value="{{ old('homeNumberAdvocate') }}" placeholder="0713-371337"> 
                </div>
            </div>
            <!-- Slut Målsman-->

            <!-- Start Equmenia-->
                </label>
            <div style="margin-top: 3rem;">
                    <div><h2 style="text-align: center;" class="rubrikerAnmalan">Equmenia</h2></div>
                <div class="form-group container-fluid noPadding" >
                        <label for="member">Är du med i en Equmeniaförening</label>
                        <select id="memberPlace" name="memberPlace" class="form-control" required>
                                <option value="0">Nej, jag är inte medlem i någon Equmeniaförening</option>
                            @foreach($places as $place)
                                <option value="{{$place->placeID}}" {{old("memberPlace") == $place->placeID ? "selected":""}}>Ja, jag är med i {{$place->placename}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <!--Slut Equmenia -->
    </div>
            <!-- Start regler-->
    <div class="BGGrey" style="padding-bottom: 3rem; padding-top: 3rem; margin-top: 3rem;">
        <div class="container">
                <h2 style="text-align: center;" class="whiteColor" class="rubrikerAnmalan">Regler och vilkor:</h2>
                <h4 style="text-align: center;" class="whiteColor">-TIDER SKA FÖLJAS</h4>
                <h4 style="text-align: center;" class="whiteColor">-LEDARNA ÄR DE SOM BESTÄMMER</h4>
                <h4 style="text-align: center;" class="whiteColor">-KILLAR OCH TJEJER SOVER ÅTSKILJT</h4>
                <h4 style="text-align: center;" class="whiteColor">-DU SKA VARA MED På DE OBLIGATORISKA AKTIVITETERNA</h4>
                <h4 style="text-align: center;" class="whiteColor">-NOLLTOLERANS MOT ALKOHOL OCH DROGER</h4>
                <h4 style="text-align: center;" class="whiteColor">-DET GÅR EJ AVANMäLAN EFTER SISTA ANMäLNINGSDAGEN UTAN GILTIGT LäKARINTYG</h4>
                <h4 style="text-align: center;" class="whiteColor">-Anmälan är bindande</h4>
                <h4 style="text-align: center;" class="whiteColor">-Att deltagaren är med i bild och video som sedan publiceras på socialmedier (Om detta skulle vara ett problem, kontakta info@branaslagret.se)</h4>
        </div> 
        <!--Slut regler-->
    </div>
        <!-- Start anmäningsknapp-->
            <div style="padding:5rem;">
                <div style="text-align:center;">
                        <h2 class="rubrikerAnmalan" id="pris">Pris = Välj om du ska vara i köket för att se pris</h2>
                        <input type="checkbox"  id="terms" name="terms"  value="1" required>
                        <label  for="checkbox"><h4> Jag har läst, förstått och godkänt reglerna. </h4></label>
                </div>
                <button type="submit" style="margin-top: 10px; font-family: elkwood;" id="submitRegistration" class="btn btn-primary centerImg whiteColor">Slutför Anmälan</button>
            </div>
        <!-- Slut anmäningsknapp   -->    
        </form>
    
</div>
<script>
    function ChangePrice(event){
        if(this.options[this.selectedIndex].value == 0){
            document.getElementById("pris").innerHTML = "Pris = 1450kr";
        }
        else if(this.options[this.selectedIndex].value == 1){
            document.getElementById("pris").innerHTML = "Pris = 1000kr";
        }
        else {
            document.getElementById("pris").innerHTML = "Pris = Välj om du ska vara i köket för att se pris";
        }
    }
</script>   
<!-- Reference to js helper-->
<script src="{{URL::asset('js/registrationHelper.js')}}"></script>    
@endsection
