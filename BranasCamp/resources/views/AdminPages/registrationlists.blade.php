@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="centerTextInDiv panel">
    <h4 style="text-align:left;">Antal anmälda: {{$count}}</h4>
    @if($type == 'leader')
        <h1>Ledare</h1>
    @else
        <h1>Deltagare</h1>
    @endif
    <div class="sidescrollcontent">
        <table id="regtbl" class="table table-hover">
            <thead>
                <tr class="tableheader">
                    <th class="tblheadcol" id="tbl-id">ID#</th>
                    <th class="tblheadcol" id="tbl-firstname">Förnamn</th>
                    <th class="tblheadcol" id="tbl-lastname">Efternamn</th>
                    <th class="tblheadcol" id="tbl-place">Ort</th>
                    <th class="tblheadcol" id="tbl-time">Anmäld Tid</th>
                    <th class="tblheadcol" id="tbl-confirmed">Bekräftat</th>
                    @can('editregistration')
                        <th class="tblheadcol" id="tbl-edit">Ändra</th>
                    @endcan
                </tr>
            </thead>
            <tbody style="color: #606569;">
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
    $(document).ready( function () {
        $('#regtbl').DataTable({
            paging: false,
            select: false,
            info: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'colvis'
            ]
        });
    });
</script>

@endsection