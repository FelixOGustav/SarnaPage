@extends('Layouts/AdminTemplate')
@section('adminContent')

@if(Auth::guest())
    <div class="centerTextInDiv">
        <h1>Du är inte inloggad. Vad gör du här? Hur kom du hit??</h1>
    </div>
@elseif(Auth::user()->level > 0)
    <div class="centerTextInDiv">
        <h1>Du har inte tillgång till detta</h1>
    </div> 
@else
    <div class="centerTextInDiv">
        <h4 style="text-align:left;">Antal anmälda: {{$count}}</h4>
        <h1>Deltagare</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>Förnamn</th>
                    <th>Efternamn</th>
                    <th>Ort</th>
                    <th>Anmäld Tid</th>
                    <th>Bekräftat</th>
                    <th>Ändra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $reg)
                    <tr>
                        <th>{{$reg->id}}</th>
                        <th>{{$reg->first_name}}</th>
                        <th>{{$reg->last_name}}</th>
                        @foreach ($places as $place)
                            @if($place->placeID == $reg->place)
                                <th>{{$place->placename}}</th>
                            @endif
                        @endforeach
                        <th>{{$reg->created_at}}</th>                        
                        @if($reg->verified_at != null)
                            <th><img src="{{URL::asset('img/greenDot.png')}}"></th>
                        @else
                            <th><a href="/admin/registrationlists/participant/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></th>
                        @endif
                        <th><a href="/admin/editregistration/participant/{{$reg->id}}"><img class="centerEditButton brightenOnHover" src="{{URL::asset('img/edit.png')}}"></a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Leaders -->
        <h1>Ledare</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>Förnamn</th>
                    <th>Efternamn</th>
                    <th>Ort</th>
                    <th>Anmäld Tid</th>
                    <th>Bekräftat</th>
                    <th>Ändra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations_leaders as $reg)
                    <tr>
                        <th>{{$reg->id}}</th>
                        <th>{{$reg->first_name}}</th>
                        <th>{{$reg->last_name}}</th>
                        @foreach ($places as $place)
                            @if($place->placeID == $reg->place)
                                <th>{{$place->placename}}</th>
                            @endif
                        @endforeach
                        <th>{{$reg->created_at}}</th>                        
                        @if($reg->verified_at != null)
                            <th><img src="{{URL::asset('img/greenDot.png')}}"></th>
                        @else
                            <th><a href="/admin/registrationlists/leader/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></th>
                        @endif
                        <th><a href="/admin/editregistration/leader/{{$reg->id}}"><img class="centerEditButton brightenOnHover" src="{{URL::asset('img/edit.png')}}"></a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
@endif

@endsection