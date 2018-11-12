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
        <h1>Deltagare</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>Förnamn</th>
                    <th>Efternamn</th>
                    <th>Ort</th>
                    <th>Anmäld Tid</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
@endif

@endsection