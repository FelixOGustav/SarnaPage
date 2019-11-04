@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <h2>Hantera underhållsläge för hemsidan</h2>
        <p>De med admin behörighet kan logga in på sidan genom explorelagret.se/admin/login och använda sidan som vanligt</p>
        <hr>
        <a href="/admin/togglemaintenencemode" class="btn btn-danger">
            @if($maintenenceMode)
                Gå ur underhållsläge
            @else                 
                Sätt på underhållsläge
            @endif
        </a>
    </div>
</div>
<div class="panel">
    <div class="sidescrollcontent">
        <p>Här kommer du kunna hantera läger men vi är inte klara med det än.</p>
        <table class="table table-hover" style="color: #606569;">
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
    </div>
</div>    

@endsection