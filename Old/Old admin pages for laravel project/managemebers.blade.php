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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID#</th>
                <th>namn</th>
                <th>Epost</th>
                <th>Hantera</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="/admin/manageusers/user/{{$user->id}}" class="btn btn-primary">Hantera</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endif

@endsection