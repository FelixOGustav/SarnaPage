@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <form action="/admin/editcontact/{{$contact->id}}" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Grupp</h4>
                <select name="group" id="group">
                    @foreach ($contact_groups as $group)
                        <option value="{{$group->id}}" @if($contact->groupID == $group->id) selected @endif>{{$group->groupName}} </option>    
                    @endforeach
                </select>
            </div>
            <div style="color: #606569;">
                <h4>Namn</h4>
                <input type="text" name="name" id="name" value="{{$contact->name}}" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Kontaktuppgift</h4>
                <input type="text" name="contact_info" id="contact_info" value="{{$contact->contact_info}}" style="width: calc(100% - 15px);">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection