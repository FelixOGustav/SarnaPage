@extends('Layouts/AdminTemplate')
@section('adminContent')

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
                @can('editregistration')
                    <th>Ändra</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $reg)
                <tr>
                    <td>{{$reg->id}}</td>
                    <td>{{$reg->first_name}}</td>
                    <td>{{$reg->last_name}}</td>
                    @foreach ($places as $place)
                        @if($place->placeID == $reg->place)
                            <td>{{$place->placename}}</td>
                        @endif
                    @endforeach
                    <td>{{$reg->created_at}}</td>                        
                    @if($reg->verified_at != null)
                        <td><img src="{{URL::asset('img/greenDot.png')}}"></td>
                    @else
                        <td><a href="/admin/registrationlists/participant/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></td>
                    @endif
                    @can('editregistration')                    
                        <td><a href="/admin/editregistration/participant/{{$reg->id}}"><img class="centerEditButton brightenOnHover" src="{{URL::asset('img/edit.png')}}"></a></td>
                    @endcan
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
                @can('editregistration')    
                    <th>Ändra</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations_leaders as $reg)
                <tr>
                    <td>{{$reg->id}}</td>
                    <td>{{$reg->first_name}}</td>
                    <td>{{$reg->last_name}}</td>
                    @foreach ($places as $place)
                        @if($place->placeID == $reg->place)
                            <td>{{$place->placename}}</td>
                        @endif
                    @endforeach
                    <td>{{$reg->created_at}}</td>                        
                    @if($reg->verified_at != null)
                        <td><img src="{{URL::asset('img/greenDot.png')}}"></td>
                    @else
                        <td><a href="/admin/registrationlists/leader/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></td>
                    @endif
                    @can('editregistration')    
                        <td><a href="/admin/editregistration/leader/{{$reg->id}}"><img class="centerEditButton brightenOnHover" src="{{URL::asset('img/edit.png')}}"></a></td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 

@endsection