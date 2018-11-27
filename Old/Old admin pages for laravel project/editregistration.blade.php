@extends('Layouts/AdminTemplate')
@section('adminContent')
    <div class="">
        <h2 style="text-align:left;">Ändra anmälan: {{$reg->id}}</h2>
        @if($leader)
            <form method="POST" action="/admin/editregistration/done/leader/{{$reg->id}}">
        @else            
            <form method="POST" action="/admin/editregistration/done/participant/{{$reg->id}}">
        @endif            
            {{ csrf_field() }}
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <th><label for="firstName">Förnamn</label></th>
                        <th><input type="text"  style="width: 90%;"  id="firstName" name="firstName" value="{{$reg->first_name}}"></th>
                    </tr>
                    <tr>
                        <th><label for="lastName">Efternamn</label></th>
                        <th><input type="text"  style="width: 90%;"  id="lastName" name="lastName" value="{{$reg->last_name}}"></th>
                    </tr>
                    <!-- Epost ledare -->
                    @if($leader)
                    <tr>
                        <th><label>Epost</label></th>
                        <th><input type="email" class="form-control" style="width: 90%;"id="email" name="email" value="{{$reg->email}}"></th>
                    </tr>
                    <tr>
                        <th><label>Epost Anhörig</label></th>
                        <th><input type="email" class="form-control" style="width: 90%;" id="emailAdvocate" name="emailAdvocate" value="{{$reg->email_advocate}}"></th>
                    </tr>
                    <!-- Epost deltagare -->
                    @else
                    <tr>
                        <th><label>Epost</label></th>
                        <th><input type="email" class="form-control" style="width: 90%;" id="email" name="email" value="{{$reg->email}}"></th>
                    </tr>
                    <tr>
                        <th><label>Epost Målsman</label></th>
                        <th><input type="email" class="form-control" style="width: 90%;" id="emailAdvocate" name="emailAdvocate" value="{{$reg->email_advocate}}"></th>
                    </tr>
        
                    @endif
                </tbody>
            </table>
            <div class="centerTextInDiv">
                <button type="submit" class="btn btn-primary" style="margin-top: 35px;">Spara</button> 
            </div>
        </form>
    </div> 
@endsection