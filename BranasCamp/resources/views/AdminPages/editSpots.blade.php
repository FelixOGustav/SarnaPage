@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Hantera platser</h2>
        <p style="word-wrap: reak-all; white-space: normal;">Max platser: Oavsett vad max deltagare och ledar är kommer det aldrig kunna anmäla sig fler än detta <br><br>
        Max deltagar platser: Hur många platser det ska finnas. När deltagar platserna är fulla kan deltagare inte längre anmäla sig till den orten. Om Max platser
        inte är uppnått och det finns ledar platser kvar, kommer ledare fortfarande kunna anmäla sig. <br><br>
        Max ledar platser: Hur många platser det ska finnas. När ledar platserna är fulla kan ledare inte längre anmäla sig till den orten. Om Max platser
        inte är uppnått och det finns deltagar platser kvar, kommer deltagare fortfarande kunna anmäla sig. <br><br>
        Detta är till för att garantera minimum ledar platser (Max - Deltagare = Minimum garanterat ledare) <br><br>
        </p>
        <hr>
        <form action="/admin/editSpots/{{$places[0]->camp_id}}/save" method="POST">
            {{ csrf_field() }}
            @foreach ($places as $place)
                <div style="color: #606569;">
                    <h4>{{$place->placename}}</h4>
                    <div class="row" style="margin-left: 0px; margin-right: 0px;">
                        <div class="col-sm-4">
                            <h5 for="{{$place->placeID}}_max">Max platser</h5>
                            <input type="number" name="{{$place->placeID}}_max" id="{{$place->placeID}}_max" value="{{$place->spots}}" style="width: calc(100% - 15px);">
                        </div>
                        <div class="col-sm-4">
                            <h5 for="{{$place->placeID}}_participants">Max deltagar platser</h5>
                            <input type="number" name="{{$place->placeID}}_participants" id="{{$place->placeID}}_participants" value="{{$place->participateSpots}}" style="width: calc(100% - 15px);">
                        </div>
                        <div class="col-sm-4">
                            <h5 for="{{$place->placeID}}_leaders">Max ledar platser</h5>
                            <input type="number" name="{{$place->placeID}}_leaders" id="{{$place->placeID}}_leaders" value="{{$place->leaderSpots}}" style="width: calc(100% - 15px);">
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection