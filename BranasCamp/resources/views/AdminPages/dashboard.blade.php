@extends('Layouts/AdminTemplate')
@section('adminContent')
    <div class="centerTextInDiv">
        <h1>Välkommen {{Auth::user()->name}}</h1>
    </div>
@endsection