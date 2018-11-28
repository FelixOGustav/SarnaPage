@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="centerTextInDiv panel">
    <h4 style="text-align:left;">Antal anmälda: {{$count}}</h4>
    <h1>Deltagare</h1>
    <input type="search" placeholder="hehe">
    <div class="sidescrollcontent">
        <table id="regtbl" class="table table-hover" style="color: #606569;">
            <thead>
                <tr class="tableheader">
                    <th class="tblheadcol">ID#</th>
                    <th class="tblheadcol">Förnamn</th>
                    <th class="tblheadcol">Efternamn</th>
                    <th class="tblheadcol">Ort</th>
                    <th class="tblheadcol">Anmäld Tid</th>
                    <th class="tblheadcol">Bekräftat</th>
                    @can('editregistration')
                        <th class="tblheadcol">Ändra</th>
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
    </div>
</div> 

<script>

    // Initialize tables
    $(document).ready(function() {
        $('#regtbl').dynatable({
            features: {
                paginate: false,
                search: true,
                recordCount: true,
                search: true
            }
        });
    });

</script>

@endsection