@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
        <div class="centerTextInDiv">
            <h1>hantera Insamling</h1>
        </div>
        <div class="sidescrollcontent">
            <form method="POST" action="/admin/insamling/update/{{$insamling->id}}" id="insamling">
                {{ csrf_field() }}
                <div class="form-row" style="margin: 0px;">
                    <div class="form-group" style="width: 100%;">
                        <label for="body" style="width: calc(100% - 14px);">Brödtext</label>
                        <textarea name="description" id="description" cols="30" rows="10" form="insamling" style="width: calc(100% - 14px);">
                            {!! html_entity_decode($insamling->description)!!}
                        </textarea>
                    </div>
                </div>  
                <button type="submit" class="buttonStyle"><p>Spara</p></button>
            </form>
        </div>
    </div>

<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=u8ldionpp9fa3j79vndfw9aljw1nhalezrswhqthrb7w9umw"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });
</script>
@endsection