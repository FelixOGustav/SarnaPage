@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <h1>Hantera Användare</h1>
        <table class="table table-hover" style="color: #606569;">
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
    </div>
</div>

@endsection