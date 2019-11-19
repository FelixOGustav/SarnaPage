@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Köande deltagare</h2>
        <p>Skicka länk till den som ska anmäla sig sent</p>
        <table class="table">
            <thead style="color: #606569">
                <td>#</td>
                <td>Name</td>
                <td>Epost</td>
                <td>Telefon</td>
                <td>Länk Skickad</td>
                <td>Skicka länk</td> 
                <td>Ta bort</td>               
            </thead>
            <tbody>
                {{$counter = 0}}
                @foreach($registrationparticipants as $registration)
                {{$counter++}}
                    <tr>
                        <td>
                            <p>{{$counter}}</p>
                        </td>
                        <td>
                            <p>{{$registration->name}}</p>
                        </td>
                        <td>
                            <p>{{$registration->email}}</p>
                        </td>
                        <td>                            
                            @if($registration->phone == null)
                                <p style="color: #d5e0e8"><i>-</i></p>
                            @else
                                <p>{{$registration->phone}}</p>
                            @endif
                        </td>
                        <td>
                            @if($registration->linkId == null)
                                <p>Nej</p>
                            @else
                                <p>Ja</p>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/lateregistration/queues/sendlink/participant/{{$registration->id}}" class="btn btn-info">Skicka inbjudan</a>
                        </td>
                        <td>
                            <a href="/admin/lateregistration/queues/remove/{{$registration->id}}" class="btn btn-danger">Ta bort</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Köande Ledare</h2>
        <p>Skicka länk till den som ska anmäla sig sent</p>
        <table class="table">
            <thead style="color: #606569">
                <td>#</td>
                <td>Name</td>
                <td>Epost</td>
                <td>Telefon</td>
                <td>Länk Skickad</td>
                <td>Skicka länk</td> 
                <td>Ta bort</td>               
            </thead>
            <tbody>
                {{$counter = 0}}
                @foreach($registrationleaders as $registration)
                {{$counter++}}
                    <tr>
                        <td>
                            <p>{{$counter}}</p>
                        </td>
                        <td>
                            <p>{{$registration->name}}</p>
                        </td>
                        <td>
                            <p>{{$registration->email}}</p>
                        </td>
                        <td>
                            @if($registration->phone == null)
                                <p style="color: #d5e0e8"><i>-</i></p>
                            @else
                                <p>{{$registration->phone}}</p>
                            @endif
                        </td>
                        <td>
                            @if($registration->linkId == null)
                                <p>Nej</p>
                            @else
                                <p>Ja</p>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/lateregistration/queues/sendlink/leader/{{$registration->id}}" class="btn btn-info">Skicka inbjudan</a>
                        </td>
                        <td>
                            <a href="/admin/lateregistration/queues/remove/{{$registration->id}}" class="btn btn-danger">Ta bort</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection