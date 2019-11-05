@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <form action="/admin/editcontactgroup/{{$contact_group->id}}" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Namn</h4>
                <input type="text" name="name" id="name" value="{{$contact_group->groupName}}" style="width: calc(100% - 15px);">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection