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
        <table id="regtbl" class="table table-hover" style="min-width: 100%;">
            <thead>
                <tr class="tableheader">
                    <th class="tblheadcol" id="tbl-id">ID#</th>
                    <th class="tblheadcol" id="tbl-firstname">Förnamn</th>
                    <th class="tblheadcol" id="tbl-lastname">Efternamn</th>
                    <th class="tblheadcol" id="tbl-place">Ort</th>
                    <th class="tblheadcol" id="tbl-time">Anmäld Tid</th>
                    @can('allergy')
                        <th class="tblheadcol" id="tbl-edit">Allergi</th>
                    @endcan
                    @can('other')
                        <th class="tblheadcol" id="tbl-edit">Övrigt</th>
                    @endcan
                    @can('contact_info')
                        <th class="tblheadcol" id="tbl-edit">Telefon</th>
                        <th class="tblheadcol" id="tbl-edit">Epost</th>
                    @endcan
                    @can('contact_info_advocate')
                    <th class="tblheadcol" id="tbl-edit">Telefon Anhörig</th>
                    <th class="tblheadcol" id="tbl-edit">Epost Anhörig</th>
                    @endcan
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
                        @can('allergy')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->allergy}}</td>
                        @endcan
                        @can('other')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->other}}</td>
                        @endcan
                        @can('contact_info')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->phonenumber}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->email}}</td>
                        @endcan
                        @can('contact_info_advocate')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->phone_number_advocate}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->email_advocate}}</td>
                        @endcan   

                        @if($reg->verified_at != null)
                            <td><img src="{{URL::asset('img/greenDot.png')}}"></td>
                        @else
                            @can('verifieregistration')
                                <td><a href="/admin/registrationlists/participant/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></td>
                            @else
                                <td></td>
                            @endcan
                        @endif
                        
                        @can('editregistration')                    
                            <td><a href="/admin/editregistration/participant/{{$reg->id}}"><i class="fas fa-edit" style="color: #606569;"></i></a></td>
                        @endcan 

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> 

<script>
    $(document).ready( function () {
        var regtbl = $('#regtbl').DataTable({
            paging: false,
            select: false,
            info: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel  <i class="fas fa-file-excel"></i>',
                    titleAttr: 'Excel',
                    className: 'exportbtn',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF  <i class="fas fa-file-pdf"></i>',
                    titleAttr: 'PDF',
                    className: 'exportbtn',
                    exportOptions: {
                        columns:  ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Skriv ut  <i class="fas fa-print"></i>',
                    titleAttr: 'Print',
                    className: 'exportbtn',
                    exportOptions: {
                        columns:  ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    columnText: function ( dt, idx, title ) {
                        return '<i class="fas fa-check"></i>   ' + title;
                    }
                }
            ]
        });

        regtbl.columns('.tblheadcol').visible(false);
        regtbl.columns([0, 1, 2, 11, 12]).visible(true);
        regtbl.draw();
        
        // Datatables adds the class dt-button to buttons. I dont want them, and this is easiest
        // Without changing the source code. This just toggles the class off, which effectivly
        // removes it from the element. This code looks in the element with id regtbl_wrapper
        // And iterates through all child elements that contains the dt-button class and toggles it off
        $('#regtbl_wrapper').find('.dt-button').toggleClass('dt-button');
        
        // Toggle button specific classes
        $('#regtbl_wrapper').find('.buttons-html5').toggleClass('buttons-html5');
        $('#regtbl_wrapper').find('.buttons-excel').toggleClass('buttons-excel');
        $('#regtbl_wrapper').find('.buttons-pdf').toggleClass('buttons-pdf');
        $('#regtbl_wrapper').find('.buttons-print').toggleClass('buttons-print');
        $('#regtbl_wrapper').find('.buttons-collection').toggleClass('buttons-collection');
        $('#regtbl_wrapper').find('.buttons-colvis').toggleClass('buttons-colvis');
    });
</script>

<!-- Removes export buttons -->
@cannot('exportreglists')
<script>
    $(document).ready( function () {
        $('.dt-buttons').find('.exportbtn').remove();
    });
</script>
@endcan

@endsection