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
                    @if($camp->late_open == 0)
                        <th>Öppna sen anmälan</th>
                    @else 
                        <th>Stäng sen anmälan</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$camp->id}}</td>
                    <td>{{$camp->name}}</td>
                    @if($camp->open == 1)
                        <td>Anmälan öppen</td>
                    @elseif($camp->late_open == 1)
                        <td>Sen anmälan öppen</td>
                    @else
                        <td>Anmälan stängd</td>
                    @endif

                    @if($camp->open == 1)
                        <td><a href="/admin/managecamp/close/{{$camp->id}}" class="btn btn-primary">Stäng anmälan</a></td>
                    @else 
                        <td><a href="/admin/managecamp/open/{{$camp->id}}" class="btn btn-primary">Öpnna anmälan</a></td>
                    @endif

                    @if($camp->late_open == 1)
                        <td><a href="/admin/managecamp/closelate/{{$camp->id}}" class="btn btn-primary">Stäng sen anmälan</a></td>
                    @else 
                        <td><a href="/admin/managecamp/openlate/{{$camp->id}}" class="btn btn-primary">Öpnna sen anmälan</a></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection