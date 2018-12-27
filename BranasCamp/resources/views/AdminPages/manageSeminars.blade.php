@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="sidescrollcontent">
        <h1 style="text-align: center;">Hantera Seminarier</h1>

        <h4>Generell info</h4>
        <form action="/admin/seminar/info/save/" method="post" id="seminarInfo">
            {{ csrf_field() }}
            <div class="row" style="margin: 0px;">
                <textarea name="info" id="info" cols="30" rows="4" form="seminarInfo" style="width: 100%; text-align:center;">{{$seminarInfo->description}}</textarea>
            </div>
            <div class="row" style="margin: 0px; margin-top: 10px;">
               <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Spara</button>
            </div>
        </form>
        <hr>

        <div>
            <button class="btn btn-success" style="margin: 16px 0px;" type="button" data-toggle="collapse" data-target="#newActivity" aria-expanded="true" aria-controls="newActivity"><i class="fas fa-plus"></i>  Nytt seminarium</button>
        </div>
    
        <div class="collapse newActivityPanel" id="newActivity">
            <h4 style="text-align: center;">Nytt seminarium</h4>
            <form action="/admin/seminar/new" method="post">
                {{ csrf_field() }}
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Datum</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="date" name="date" placeholder="ÅÅÅÅ-MM-DD" required/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Titel</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="titel" name="titel" placeholder="Aktivitet" required/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Beskrivning</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="description" name="description" placeholder="Beskrivning"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Ansvarig</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="responsible" name="responsible" placeholder="Namn Namnsson"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Platser</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="spots" name="spots" placeholder="1337"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Plats</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="place" name="place" placeholder="A1337"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Gym+</label>
                        <input class="" style="padding-right: 0px;" type="checkbox" id="gym_plus" name="gym_plus" value="1"/>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>  Lägg till</button>
            </form>
        </div>

        <table class="table table-hover" style="color: #606569;">
            <thead>
                <tr>
                    <th></th>
                    <th>Titel</th>
                    <th>Beskrivning</th>
                    <th>Ansvarig</th>
                    <th>plats</th>
                    <th>Platser</th>
                    <th>datum</th>
                    <th>Gym+</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seminars as $seminar)
                    <tr>
                        <td>
                            <span>
                                <a href="/admin/seminar/edit/{{$seminar->id}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                            
                                <a href="/admin/seminar/delete/{{$seminar->id}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                            </span>
                        </td>
                        <td>{{$seminar->titel}}</td>
                        <td>{{$seminar->description}}</td>
                        <td>{{$seminar->responsible}}</td>
                        <td>{{$seminar->place}}</td>
                        <td>{{$seminar->spots}}</td>
                        <td>{{$seminar->date}}</td>
                        <th>{{$seminar->gym_plus}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection