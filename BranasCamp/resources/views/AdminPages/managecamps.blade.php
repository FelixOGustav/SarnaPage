@extends('Layouts/AdminTemplate')
@section('adminContent')

@if(Auth::guest())
    <div class="centerTextInDiv">
        <h1>Du är inte inloggad. Vad gör du här? Hur kom du hit??</h1>
    </div>
@elseif(Auth::user()->level > 0)
<div class="centerTextInDiv">
        <h1>Du har inte fjäskat tillräckligt för att få hantera läger.</h1>
    </div>
@else
    <p>Här kommer du kunna hantera läger men vi är inte klara med det än.</p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID#</th>
                <th>Läger</th>
                <th>Hantera</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camps as $camp)
                <tr>
                    <th>{{$camp->id}}</th>
                    <th>{{$camp->name}}</th>
                    <th><a href="/admin/managecamp/camp/{{$camp->id}}" class="btn btn-primary">Hantera</a></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endif

@endsection