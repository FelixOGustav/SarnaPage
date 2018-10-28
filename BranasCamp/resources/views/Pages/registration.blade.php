@extends('Layouts/template')
@section('content')
<div class="container">
                <h1 style="font-size: 50px; margin-top: 5%; text-align: center;">Anmälan</h1>
                    <div style="margin-top: 8%;"><h2>Deltagare</h2></div>
                        <div>  
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">Förnamn</label>
                                    <input type="text" class="form-control" id="firstname" placeholder="Kim">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Efternamn</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Svensson">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="inputAddress">Föddelseår</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="2000">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">Månad</label>
                                    <select id="inputState" class="form-control">
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
                                <div class="form-group col-3">
                                    <label for="inputAddress">Dag</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="01">
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputAddress2">Fyra sista</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="XXXX">
                                </div>
                            </div>
                            <div class="form-group container-fluid noPadding">
                                <label for="inputCity">Adress</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Vintergatan 42"> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                            <label for="inputZip">Postnummer</label>
                                            <input type="text" class="form-control" id="inputZip" placeholder="13337">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputCity">Postort</label>
                                    <input type="text" class="form-control" id="inputCity" placeholder="Vintergårda">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">E-post</label>
                                    <input type="email" class="form-control" id="" placeholder="Kim">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Bekräfta e-post</label>
                                    <input type="email" class="form-control" id="lastName" placeholder="Svensson">
                                </div>
                                <div class="form-group container-fluid noPadding">
                                        <label for="inputCity">Telefon</label>
                                        <input type="text" class="form-control" id="inputCity" placeholder="0713-371337"> 
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 5%;">    
                            <div><h2>Kontaktuppgifter målsman</h2></div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstNameAdvocate">Förnamn målsman</label>
                                    <input type="text" class="form-control" id="" placeholder="Kalle">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastNameAdvocate">Efternamn målsman</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Svensson">
                                </div>
                            </div>
                        </div>    
                            <button type="submit" style="margin-top: 10px; font-family: elkwood;" class="btn btn-secondary centerImg">Slutför Anmälan</button>
@endsection