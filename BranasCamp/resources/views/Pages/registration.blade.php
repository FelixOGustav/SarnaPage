@extends('Layouts/template')
@section('content')
<div class="container bg-white">
                <h1 style="font-size: 50px; margin-top: 5%; text-align: center;">Anmälan</h1>
                    <!-- Start deltagare -->
                    <div style="margin-top: 8%;"><h2>Deltagare</h2></div>
                        <div>  
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">Förnamn</label>
                                    <input type="text" class="form-control" id="firstname" placeholder="Hen" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Efternamn</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Hensson" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="align-self-stretch">
                                    <div class="form-group col-3">
                                        <label for="year">Föddelseår</label>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="1337-13-37" required>
                                    </div>
                                </div>
                                <div class="align-self-stretch">
                                    <div class="form-group col-md-3">
                                        <label for="inputState">Månad</label>
                                        <select id="month" class="form-control" required>
                                            <option selected>Välj...</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Mars</option>
                                            <option value="04">April</option>
                                            <option value="05">Maj</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Augusti</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-3">
                                    <label for="inputAddress">Dag</label>
                                    <input type="day" class="form-control" id="inputAddress" placeholder="01" required>
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputAddress2">Fyra sista</label>
                                    <input type="text" class="form-control" id="fourlast" placeholder="XXXX" required>
                                </div>
                            </div>
                            <div class="form-group container-fluid noPadding">
                                <label for="inputCity">Adress</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Vintergatan 42" required> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                            <label for="inputZip">Postnummer</label>
                                            <input type="text" class="form-control" id="inputZip" placeholder="13337" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputCity">Postort</label>
                                    <input type="text" class="form-control" id="inputCity" placeholder="Vintergårda" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">E-post</label>
                                    <input type="email" class="form-control" id="" placeholder="hen.hensson@hen.se" required>
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
                        </div>
                        <!-- Slut deltagare -->
                        <!-- Start Ort -->
                        <div style="margin-top: 5%;">
                                
                            <div><h2>Ort</h2></div>
                            <div class="form-group col-md-3">
                                <label for="inputState">Månad</label>
                                <select id="inputState" class="form-control" required>
                                    @foreach($places as $place)
                                        <option value="{{$place->placeid}}">{{$place->placename}}</option>
                                    @endforeach
                                    <option selected>Välj...</option>
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
                        <div style="margin-top: 5%;">
                            <div><h2>Equmenia</h2></div>
                            <label for="inputState">Är du med i en Equmenia-föreing?</label>
                            <select id="month" class="form-control" required>
                                <option selected>Välj...</option>
                                <option value="01">Ja</option>
                                <option value="02">Nej</option>
                            </select>
                        </div>
                        <!-- Start anmäningsknapp-->    
                            <button type="submit" style="margin-top: 10px; margin-bottom: 5%; font-family: elkwood;" class="btn btn-secondary centerImg">Slutför Anmälan</button>
</div>                            
@endsection