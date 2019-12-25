@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
     <div class="newActivityPanel" id="newActivity">
        <h4 style="text-align: center;">Redigera Aktivitet</h4>
        <form action="/admin/schedule/update/{{$event->id}}" method="POST">
            {{ csrf_field() }}
            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Tid</label>
                    <input class="form-control" style="padding-right: 0px;" type="text" id="time" name="time" placeholder="ÅÅÅÅ-MM-DD tt:mm:ss" value="{{$event->time}}" required/>
                </div>
            </div>
            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Slut tid<span style="font-size: 12px;"> (Kan lämnas tom)</span></label>
                    
                    <input class="form-control" style="padding-right: 0px;" type="text" id="time_end" name="time_end" placeholder="ÅÅÅÅ-MM-DD tt:mm:ss" value="{{$event->time_end}}"/>
                </div>
            </div>

            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Titel</label>
                    <input class="form-control" style="padding-right: 0px;" type="text" id="titel" name="titel" placeholder="Aktivitet" value="{{$event->titel}}" required/>
                </div>
            </div>

            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Beskrivning</label>
                    <input class="form-control" style="padding-right: 0px;" type="text" id="description" name="description" placeholder="Beskrivning" value="{{$event->description}}"/>
                </div>
            </div>

            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Endast för ledare</label>
                    <input type="checkbox" id="leader" name="leader" value="1"/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Spara</button>
        </form>
    </div>

</div>

@endsection