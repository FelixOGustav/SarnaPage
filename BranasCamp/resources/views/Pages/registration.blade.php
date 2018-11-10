@extends('Layouts/template')
@section('content')
<div class="container bg-white">
    <h1 style="font-size: 50px; margin-top: 5%; text-align: center;">Anmälan</h1>
    <!-- Start deltagare -->
    <div style="margin-top: 8%;"><h2>Deltagare</h2></div>
        <div>  
        <form method="POST" action="/pages/registration/done">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">Förnamn</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Hen" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Efternamn</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Hensson" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-9">
                    <label for="year">Föddelseår</label>
                    <input type="text" class="form-control" id="birthYear" name="birthYear" placeholder="1337-13-37" required>
                </div>
                <div class="form-group col-3">
                    <label for="inputAddress2">Fyra sista</label>
                    <input type="text" class="form-control" id="fourLast" name="fourLast" placeholder="XXXX" required>
                </div>
            </div>
            <div class="form-group container-fluid noPadding">
                <label for="inputCity">Adress</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Vintergatan 42" required> 
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                            <label for="inputZip">Postnummer</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="13337" required>
                </div>
                <div class="form-group col-md-8">
                    <label for="inputCity">Postort</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Vintergårda" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">E-post</label>
                    <input type="email" class="form-control" id="email" name="emil" placeholder="hen.hensson@hen.se" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Bekräfta e-post</label>
                    <input type="email" class="form-control" id="confirmEmail" name="confirmEmail" required>
                </div>
                <div class="form-group container-fluid noPadding">
                        <label for="inputCity">Telefon</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="0713-371337" required> 
                </div>
                <div>
                    <label for="allgery">Allergi</label>
                    <textarea class="form-control container-fluid" name="allgery" id="allergy" cols="165" rows="5"></textarea>
                </div>
                <div>
                    <label for="other">Övrigt</label>
                    <textarea class="form-control container-fluid" name="other" id="other" cols="165" rows="5"></textarea>
                </div>
            </div>
        
        </div>
        <!-- Slut deltagare -->
        <!-- Start Ort -->
        <div style="margin-top: 5%;" >
                
            <div><h2>Ort</h2></div>
            <div class="form-group container-fluid noPadding" >
                <label for="inputState">Orten</label>
                <select id="place" name="" class="form-control" required>
                        <option value="">Välj...</option>
                    @foreach($places as $place)
                        <option value="{{$place->placeid}}">{{$place->placename}}</option>
                    @endforeach
                </select>
        </div>
        <!-- Slut Ort -->
        <!-- Start Målsman -->
        <div style="margin-top: 5%;">    
            <div><h2>Kontaktuppgifter målsman</h2></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstNameAdvocate">Förnamn målsman</label>
                    <input type="text" class="form-control" id="" placeholder="Hen" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastNameAdvocate">Efternamn målsman</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Hensson" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                    <label for="firstName">E-post</label>
                    <input type="email" class="form-control" id="" placeholder="hen.malsman@hen.se" required>
            </div>
            <div class="form-group col-md-6">
                    <label for="lastName">Bekräfta e-post</label>
                    <input type="email" class="form-control" id="lastName" required>
            </div>
            <div class="form-group container-fluid noPadding">
                    <label for="inputCity">Telefon</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="0713-371337" required> 
            </div>
        </div>
        <!-- Slut Målsman-->

        <!-- Start Equmeniap-->
        <div data-toggle="buttons">
            <label style="white-space: initial;" class="btm-md funky-radio active">
                <input name="equmeniamedlem" type="radio" value="1" class="btn btn-secondary radio-buttom hidden">
            "Yes, skälvklart"

            </label>

            
        </div>
        <!-- Start regler-->
        <div>
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Jag har läst, förstått och godkänt reglerna. </label>
        </div>
        <!--Slut regler-->

        <!-- Start anmäningsknapp-->
        <div>
            <button type="submit" style="margin-top: 10px; margin-bottom: 5%; font-family: elkwood;" class="btn btn-secondary centerImg">Slutför Anmälan</button>
        </div>    
        </form>
    </div>
</div>                            
@endsection