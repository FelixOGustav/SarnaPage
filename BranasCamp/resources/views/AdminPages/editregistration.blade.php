@extends('Layouts/AdminTemplate')
@section('adminContent')
    <div class="panel">
        <div class="sidescrollcontent">
            <h2 style="text-align:left;">Ändra anmälan: {{$reg->id}}</h2>
            @if($leader)
                <form method="POST" action="/admin/editregistration/done/leader/{{$reg->id}}">
            @else            
                <form method="POST" action="/admin/editregistration/done/participant/{{$reg->id}}">
            @endif            
                    {{ csrf_field() }}
                    <div>
                        <h4 for="firstName">Förnamn</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="firstName" name="firstName" value="{{$reg->first_name}}" required>
                    </div>
                    <div>
                        <h4 for="lastName">Efternamn</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="lastName" name="lastName" value="{{$reg->last_name}}" required>
                    </div>
                    <div>
                        <h4>Epost</h4>
                        <input type="email" style="width: calc(100% - 15px); margin-bottom: 20px;" id="email" name="email" value="{{$reg->email}}" required>
                    </div>
                    <div>
                        <h4>Epost @if($leader)Anhörig @else Målsman @endif</h4>
                        <input type="email" style="width: calc(100% - 15px); margin-bottom: 20px;" id="emailAdvocate" name="emailAdvocate" value="{{$reg->email_advocate}}" required>
                    </div>
                    <div>
                        <h4>Telefon</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="phoneNumber" name="phoneNumber" value="{{$reg->phonenumber}}" required>
                    </div>
                    <div>
                        <h4>Telefon @if($leader)Anhörig @else Målsman @endif</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="phoneNumberAdvocate" name="phoneNumberAdvocate" value="{{$reg->phone_number_advocate}}" required>
                    </div>
                    <div>
                        <h4>Address</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="address" name="address" value="{{$reg->address}}" required>
                    </div>
                    <div>
                        <h4>Postnr</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="zip" name="zip" value="{{$reg->zip}}" required>
                    </div>
                    <div>
                        <h4>Stad</h4>
                        <input type="text" style="width: calc(100% - 15px); margin-bottom: 20px;" id="city" name="city" value="{{$reg->city}}" required>
                    </div>
                    @if(Auth::user()->can('admin'))
                        <div>
                            <h4 for="lastName">Ort</h4>
                            <select id="place" name="place" style="width: calc(100% - 15px); margin-bottom: 20px;" required>
                                @foreach($places as $place)
                                    <option value="{{$place->placeID}}" @if($reg->place == $place->placeID) selected @endif>{{$place->placename}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($leader)
                            <div>
                                <h4 for="kitchen">Kökspersonal</h4>
                                <select name="kitchen" id="kitchen" style="width: calc(100% - 15px); margin-bottom: 20px;" required>
                                    <option value="1"@if($reg->kitchen == 1) selected @endif>Ja, {{$reg->first_name}} är snål</option>
                                    <option value="0"@if($reg->kitchen == 0) selected @endif>Nej, {{$reg->first_name}} vill sova</option>
                                </select>
                            </div>
                        @endif
                    @endif
                    
                    <div class="centerTextInDiv">
                        <button type="submit" class="btn btn-primary" style="margin-top: 35px;">Spara</button> 
                    </div>
                </form>
        </div>
    </div> 
@endsection