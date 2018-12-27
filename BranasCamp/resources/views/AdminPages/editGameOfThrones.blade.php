@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <h1>Redigera Dass</h1>

        <div class=" newActivityPanel" id="newActivity">
            <h4 style="text-align: center;">Redigera Dass</h4>
            <form action="/admin/gameofthrones/update" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{$toilet->id}}">
                
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Titel</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="name" name="name" placeholder="Aktivitet" required value="{{$toilet->name}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Beskrivning</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="description" name="description" placeholder="Beskrivning" value="{{$toilet->description}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Ansvariga</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="responsible" name="responsible" placeholder="Namn Namnsson" value="{{$toilet->responsible}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>vinster</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="wins" name="wins" placeholder="1337" value="{{$toilet->wins}}"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Plats</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="place" name="place" placeholder="A1337" value="{{$toilet->place}}"/>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>  Spara</button>
            </form>
        </div>

    </div>
</div>

@endsection