@extends('Layouts/template')
@section('content')

<div class="centerTextInDiv container" style="padding: 50px 5px;">
    <h1>Du är anmäld!</h1>
    <h4>{{$recipient}} har fått ett mail ({{$mail}}) med en länk för att bekräfta anmälan. Länken måste alltså klickas på för att bekräfta anmälan! OBS. Liftkort och skidhyra kommer i början av december</h4>
    <p>Om ni inte fått mailet, kolla i skräppost ett kontakta någon i lägerledningen eller någon ungdomsledare</p>
</div>

@endsection