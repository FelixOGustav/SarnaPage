@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <p>Här kommer du kunna hantera läger men vi är inte klara med det än.</p>
        <table class="table table-hover" style="color: #606569;">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>Läger</th>
                    <th>Status</th>
                    @if($camp->open == 0)
                        <th>Öppna anmälan</th>
                    @else 
                        <th>Stäng anmälan</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{$camp->id}}</th>
                    <th>{{$camp->name}}</th>
                    @if($camp->open == 1)
                        <th>Anmälan öppen</th>
                        <th><a href="/admin/managecamp/close/{{$camp->id}}" class="btn btn-primary">Stäng anmälan</a></th>
                    @else 
                        <th>Anmälan stängd</th>
                        <th><a href="/admin/managecamp/open/{{$camp->id}}" class="btn btn-primary">Öpnna anmälan</a></th>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection