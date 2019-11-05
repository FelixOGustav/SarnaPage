@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <form action="/admin/editfaq/{{$faq->id}}" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Fråga</h4>
                <input type="text" name="question" id="question" value="{{$faq->question}}" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Brödtext</h4>
                <textarea type="text" name="answer" id="answer" style="width: calc(100% - 15px); min-height: 100px;">{{$faq->answer}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection