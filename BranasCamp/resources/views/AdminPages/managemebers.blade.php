@extends('Layouts/AdminTemplate')
@section('adminContent')

@if(Auth::guest())
    <div class="centerTextInDiv">
        <h1>Du är inte inloggad. Vad gör du här? Hur kom du hit??</h1>
    </div>
@elseif(Auth::user()->level > 0)
<div class="centerTextInDiv">
        <h1>Du har inte fjäskat tillräckligt för att få hantera konton.</h1>
    </div>
@else
    <p>Här kommer du kunna hantera konton men vi är inte klara med det än.</p>
    @foreach ($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
@endif

@endsection