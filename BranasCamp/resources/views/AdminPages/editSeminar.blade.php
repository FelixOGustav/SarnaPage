@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <h1>Redigera Seminarie</h1>

        <div class=" newActivityPanel" id="newActivity">
            <h4 style="text-align: center;">Nytt seminarium</h4>
            <form action="/admin/seminar/update" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{$seminar->id}}">
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Datum</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="date" name="date" placeholder="ÅÅÅÅ-MM-DD" required value="{{$seminar->date}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Titel</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="titel" name="titel" placeholder="Aktivitet" required value="{{$seminar->titel}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Beskrivning</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="description" name="description" placeholder="Beskrivning" value="{{$seminar->description}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Ansvarig</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="responsible" name="responsible" placeholder="Namn Namnsson" value="{{$seminar->responsible}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Platser</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="spots" name="spots" placeholder="1337" value="{{$seminar->spots}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Plats</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="place" name="place" placeholder="A1337" value="{{$seminar->place}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Gym+</label>
                        <input class="" style="padding-right: 0px;" type="checkbox" id="gym_plus" name="gym_plus" value="1" @if($seminar->gym_plus) checked @endif/>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>  Uppdatera</button>
            </form>
        </div>

    </div>
</div>

@endsection