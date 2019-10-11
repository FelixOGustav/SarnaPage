@extends('Layouts/AdminTemplate')
@section('adminContent')

<!-- Modal for confirmation of remove of mail -->
<div class="modal fade" id="removemodal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="text-center">Säker på att du vill ta bort?</h4>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <a href="/admin/mail" class="col modalButtonStyle link"><h3 class="whiteColor">Ta bort</h3></a>
                    <a class="col modalButtonStyle" data-toggle="modal" data-target="#removemodal"><h3 class="whiteColor">Nej</h3></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<!-- Modal for preview of mail -->
<div class="modal fade" id="previewmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <iframe src="/test/mail" frameborder="0" style="height: calc(100vh - 56px); width: 100%;"></iframe>
            </div>
        </div>
    </div>  
</div>
<!-- Modal end -->

<!-- Modal for sending mail -->
<div class="modal fade" id="sendmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content justify-content-center">
            <div class="modal-header justify-content-center">
                <h2 class="text-center">Välj mottagare</h2>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/mail/send" id="sendmails">
                    {{ csrf_field() }}
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label style="vertical-align:middle;">Deltagare</label>
                                </td>
                                <td>
                                    <input type="checkbox" value="1" name="participant" id="participant" style="margin-left: 10px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="vertical-align:middle;">Deltagares målsman</label>
                                </td>
                                <td>
                                    <input type="checkbox" value="1" name="participantAdvocate" id="participantAdvocate" style="margin-left: 10px;">
                                </td>
                            </tr>
                            <tr>
                                    <td>
                                        <label style="vertical-align:middle;">Ledare</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" value="1" name="leader" id="leader" style="margin-left: 10px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="vertical-align:middle;">Ledare målsman</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" value="1" name="leaderAdvocate" id="leaderAdvocate" style="margin-left: 10px;">
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                    <label for="email"><br>Epost för individuellt utskick</label>
                    <p style="font-size: 13px;">Mailet skickas till endast denna address om ovanstående val lämnas tomma</p>
                    <input type="email" name="email" id="email" placeholder="namn@namnsson.se" style="width: calc(100% - 12px); margin-bottom: 25px;">

                    <input type="hidden" id="id" name="id" value="">
                    <button type="submit"class="col modalButtonStyle" style="margin: 0px;" onclick="ViewProgress()"><h3 class="whiteColor">Skicka</h3></button>
                </form>
            </div>
        </div>
    </div>  
</div>
<!-- Modal end -->

    <!-- Modal for sending progress of mail -->
<div class="modal fade" id="progressmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h2 class="text-center">Skickar mail..</h2>
            </div>
            <div class="modal-body ">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="sendingprogress"></div>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- Modal end -->

<div class="panel">
    <div class="centerTextInDiv">
        <h1>Skicka Mass utskick</h1>
    </div>
    <p>
        Här kan du skriva mailen som du vill skicka ut. När du har skrivit ett mail och sparat det dyker det upp i listan nedan 
        och där kan du hantera den. För att skicka att mail klickar du på "välj mottagare" och där väljer du vilken eller vilka 
        grupper som ska ta emot mailet. Du kan även skriva i en mottagare i fältet om du endast vill skicka till den. Användbart 
        om någon av någon anledning inte mottagit ett mail.<br>
    </p>
    <hr>
    <h3>Mails</h3>
    <div class="sidescrollcontent">
        @if($mails)
            <table class="table table-hover" style="min-width: 100%;">
                <thead style="color: #606569;">
                    <tr>
                        <th>Ämne</th>
                        <th>Val</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mails as $mail)
                        <tr style="color: #606569;">
                            <td>{{$mail->subject}}</td>
                            <td>                               
                                <a class="btn btn-secondary" style="color:white;" data-toggle="modal" data-target="#previewmodal" onclick="updatePreviewModal('/test/mail/{{$mail->id}}')">Förhandsgranska</a> 
                                <a class="btn btn-success" style="color:white;" data-toggle="modal" data-target="#sendmodal" onclick="updateSendModal({{$mail->id}})">välj mottagare</a> 
                                <br><br>
                                <a href="/admin/mail/update/{{$mail->id}}" class="btn btn-primary">Ändra</a>
                                <a href="/admin/mail/duplicate/{{$mail->id}}" class="btn btn-info" style="color:white;">Duplicera</a>
                                <a class="btn btn-danger" style="color:white;" data-toggle="modal" data-target="#removemodal" onclick="updateRemoveModal('/admin/mail/remove/{{$mail->id}}')">Ta Bort</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <hr>
    {{-- <h2 id="queuedAmount">I kö: {{$queued}}</h2> --}}
</div>

<div class="panel">
    <div class="centerTextInDiv">
        <h1>Nytt Mail</h1>
    </div>
    <div class="sidescrollcontent">
        <form method="POST" action="/admin/mail/new" id="newMail">
            {{ csrf_field() }}
            <div class="form-row" style="margin: 0px;">
                <div class="form-group" style="width: 100%;">
                    <label for="subject" style="display: flex; width: calc(100% - 12px);">Ämne</label>
                    <input type="text" name="subject" id="subject" required  style="width: calc(100% - 12px);">
                </div>
            </div>
            <div class="form-row" style="margin: 0px;">
                <div class="form-group" style="width: 100%;">
                    <label for="body" style="width: calc(100% - 14px);">Brödtext</label>
                    <textarea name="body" id="body" cols="30" rows="10" form="newMail" style="width: calc(100% - 14px);"></textarea>
                </div>
            </div>  
            <button type="submit" class="buttonStyle" style="background-color: #606569;"><p>Spara</p></button>
        </form>
    </div>
</div>

<script src="https://malsup.github.com/jquery.form.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=u8ldionpp9fa3j79vndfw9aljw1nhalezrswhqthrb7w9umw"></script>
<script>
    tinymce.init({
        selector: '#body',
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

    function updateRemoveModal($url) {
        $('#removemodal .link').attr("href", $url);
    }

    function updatePreviewModal($url) {
        $('#previewmodal iframe').attr("src", $url);
    }

    function updateSendModal($id) {
        $('#id').attr("value", $id);
    }

    function ViewProgress(){
        $('#sendmodal').modal('hide');
        $('#progressmodal').modal('show');
    }


    $(document).ready(function() {
        $('#sendmails').on('submit', function() {
            setInterval(UpdateProgressBar, 500);
        });
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function UpdateProgressBar(){
        console.log("Getting progress..");
        $.ajax({
            url: '/admin/mail/send/progress',
            type: 'POST',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (data) {
                $('#sendingprogress').css('width', data+'%').attr('aria-valuenow', data);
                //$('#queuedAmount').text("I kö: " + data);
            }
        });
    }

</script>

@endsection