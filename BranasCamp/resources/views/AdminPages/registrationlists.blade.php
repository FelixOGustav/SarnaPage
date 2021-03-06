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
                    <th class="tblheadcol def-vis-col" id="tbl-id">ID#</th>
                    <th class="tblheadcol def-vis-col" id="tbl-firstname">Förnamn</th>
                    <th class="tblheadcol def-vis-col" id="tbl-lastname">Efternamn</th>
                    <th class="tblheadcol def-vis-col" id="tbl-place">Ort</th>

                    @can('age')
                        <th class="tblheadcol" id="tbl-age">Ålder</th>
                        <th class="tblheadcol" id="tbl-birthdate">Födelsedag</th>
                    @endcan
                    
                    @can('persnr')
                    <th class="tblheadcol" id="tbl-lastfour">Sista fyra</th>
                    @endcan

                    <th class="tblheadcol" id="tbl-time">Anmäld Tid</th>

                    @can('allergy')
                        <th class="tblheadcol" id="tbl-allergy">Allergi</th>
                    @endcan

                    @can('other')
                        <th class="tblheadcol" id="tbl-other">Övrigt</th>
                    @endcan
                        
                    @can('member')
                        <th class="tblheadcol" id="tbl-member">Medlem</th>
                    @endcan

                    @can('address')
                        <th class="tblheadcol" id="tbl-address">Address</th>
                        <th class="tblheadcol" id="tbl-postnr">Post nr</th>
                        <th class="tblheadcol" id="tbl-postort">Post Ort</th>
                    @endcan

                    @can('contact_info')
                        <th class="tblheadcol" id="tbl-phone">Telefon</th>
                        <th class="tblheadcol" id="tbl-email">Epost</th>
                    @endcan

                    <th class="tblheadcol" id="tbl-first-name-advocate">Förnamn Anhörig</th>
                    <th class="tblheadcol" id="tbl-last-name-advocate">Efternamn Anhörig</th>

                    @can('contact_info_advocate')
                        <th class="tblheadcol" id="tbl-phone-advocate">Telefon Anhörig</th>
                        <th class="tblheadcol" id="tbl-email-advocate">Epost Anhörig</th>
                    @endcan

                    @can('kitchen')
                        @if($type == 'leader')
                            <th class="tblheadcol" id="tbl-kitchen">Köket</th>
                        @endif
                    @endcan

                    <th class="tblheadcol" id="tbl-gender">Kön</th>
                    
                    <th class="tblheadcol def-vis-col" id="tbl-confirmed">Bekräftat</th>

                    @can('editregistration')
                        <th class="tblheadcol def-vis-col" id="tbl-edit">Ändra</th>
                    @endcan                    

                    @can('admin')
                        <th class="tblheadcol def-vis-col" id="tbl-delete">
                            @if($cancelled == false)
                                Ta bort</th>
                            @else 
                                Återskapa
                            @endif
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
                        
                        @can('age')
                            <td>{{\App\Http\Controllers\CampRegistrationController::GetAgeFromDate($reg->birthdate)}}</td>
                            <td>{{$reg->birthdate}}</td>
                        @endcan

                        @can('persnr')
                        <td>{{$reg->last_four}}</td>
                        @endcan

                        <td>{{$reg->created_at}}</td> 

                        @can('allergy')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->allergy}}</td>
                        @endcan
                        @can('other')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->other}}</td>
                        @endcan

                        @can('member')
                            @if($reg->member)
                                <td class="tblheadcol" id="tbl-edit">Medlem 
                                    @foreach ($places as $place) 
                                        @if($place->placeID == $reg->member_place) 
                                        i {{$place->placename}} 
                                        @endif 
                                    @endforeach
                                </td>
                            @else
                                <td class="tblheadcol" id="tbl-edit">Ej Medlem</td>
                            @endif
                        @endcan

                        @can('address')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->address}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->zip}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->city}}</td>
                        @endcan
                        
                        @can('contact_info')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->phonenumber}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->email}}</td>
                        @endcan

                        <td class="tblheadcol" id="tbl-first-name-advocate">{{$reg->first_name_advocate}}</td>
                        <td class="tblheadcol" id="tbl-last-name-advocate">{{$reg->last_name_advocate}}</td>

                        @can('contact_info_advocate')
                            <td class="tblheadcol" id="tbl-edit">{{$reg->phone_number_advocate}}</td>
                            <td class="tblheadcol" id="tbl-edit">{{$reg->email_advocate}}</td>
                        @endcan 

                        @can('kitchen')
                            @if($type == 'leader')
                                @if($reg->kitchen > 0)
                                    <td>Ja</td>
                                @else
                                    <td>Nej</td>
                                @endif
                            @endif
                        @endcan

                        @if($reg->last_four[2] % 2 == 0)
                            <td class="tblheadcol" id="tbl-gender">Tjej</td>
                        @else
                            <td class="tblheadcol" id="tbl-gender">Kille</td>
                        @endif

                        @if($reg->verified_at != null)
                            <td><img src="{{URL::asset('img/greenDot.png')}}"></td>
                        @else
                            @can('verifieregistration')
                                @if($type == 'participant')
                                    <td><a href="/admin/resendverificationmail/participant/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></td>
                                @elseif($type == 'leader')
                                    <td><a href="/admin/resendverificationmail/leader/{{$reg->id}}" class="btn btn-primary">Skicka mail igen</a></td>
                                @endif
                            @endcan
                        @endif
                        
                        @can('editregistration')                    
                            @if($type == 'participant')
                                <td><a href="/admin/editregistration/participant/{{$reg->id}}"><i class="fas fa-edit" style="color: #606569;"></i></a></td>
                            @else
                                <td><a href="/admin/editregistration/leader/{{$reg->id}}"><i class="fas fa-edit" style="color: #606569;"></i></a></td>
                            @endif
                        @endcan 

                        @can('admin')
                            @if($type == 'participant')
                                @if($cancelled == 'cancelled')
                                    <td><a href="/admin/restoreregistration/participant/{{$reg->id}}" class="btn btn-danger">                                    
                                    <i class="fas fa-life-ring"></i>
                                @else 
                                    <td><a href="/admin/removeregistration/participant/{{$reg->id}}" class="btn btn-danger"> 
                                    <i class="far fa-trash-alt"></i>
                                @endif
                                </a></td>
                            @else 
                                
                                @if($cancelled == 'cancelled')
                                    <td><a href="/admin/restoreregistration/leader/{{$reg->id}}" class="btn btn-danger">
                                    <i class="fas fa-life-ring"></i>
                                @else 
                                    <td><a href="/admin/removeregistration/leader/{{$reg->id}}" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                @endif
                                </a></td>
                            @endif
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
        regtbl.columns(['.def-vis-col']).visible(true);
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