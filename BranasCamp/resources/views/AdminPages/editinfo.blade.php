@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <form action="/admin/editinfo/{{$info->id}}" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4 for="title">Titel</h4>
                <input type="text" name="title" id="title" value="{{$info->title}}" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4 for="body">Brödtext</h4>
                <textarea type="text" name="body" id="body" style="width: calc(100% - 15px); min-height: 100px;">{{$info->body}}</textarea>
            </div>
            <div style="color: #606569;">
                <h4 for="type">Typ</h4>
                <select name="type" id="type">
                    <option value="sidebyside" @if($info->type == "sidebyside") selected @endif>Side by Side</option>
                    <option value="imagebelow" @if($info->type == "imagebelow") selected @endif>Image below</option>
                </select>
            </div>
            <div style="color: #606569;">
                <h4 for="image">Bild</h4>
                <input type="text" name="image" id="image" value="{{$info->img}}" style="width: calc(100% - 15px);">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection