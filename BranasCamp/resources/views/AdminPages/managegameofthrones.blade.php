@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <h1 style="text-align: center;">Hantera Toakampen</h1>

        <h4>Generell info</h4>
        <form action="/admin/gameofthrones/info/save/{{$info->id}}" method="post" id="description">
            {{ csrf_field() }}
            <div class="row" style="margin: 0px;">
                <textarea name="description" id="description" cols="30" rows="4" form="description" style="width: 100%; text-align:center;">{{$info->description}}</textarea>
            </div>
            <div class="row" style="margin: 0px;">
                <label for="link">Länk till omröstning</label>
                <input style="margin-left: 10px;" name="link" id="link" type="text" value="{{$info->link}}"/>
            </div>
            <div class="row" style="margin: 0px;">
                <label for="vote_open">Omröstning öppen</label>
                <input style="margin-left: 10px; margin-top: 5px;" name="vote_open" id="vote_open" type="checkbox" value="1" @if($info->vote_open) checked @endif/>
            </div>
            <div class="row" style="margin: 0px; margin-top: 10px;">
               <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Spara</button>
            </div>
        </form>
        <hr>

        <div>
            <button class="btn btn-success" style="margin: 16px 0px;" type="button" data-toggle="collapse" data-target="#newActivity" aria-expanded="true" aria-controls="newActivity"><i class="fas fa-plus"></i>  Nytt Dass</button>
        </div>
    
        <div class="collapse newActivityPanel" id="newActivity">
            <h4 style="text-align: center;">Nytt Dass</h4>
            <form action="/admin/gameofthrones/new" method="post">
                {{ csrf_field() }}
                   
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Titel</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="name" name="name" placeholder="Dass Namn" required/>
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
                        <label>Ansvariga</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="responsible" name="responsible" placeholder="Namn Namnsson, Karl Karlsson"/>
                    </div>
                </div>
    
                <div class="container" style="margin-top: 20px">
                    <div style="position: relative">
                        <label>Plats</label>
                        <input class="form-control" style="padding-right: 0px;" type="text" id="place" name="place" placeholder="A1337"/>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>  Lägg till</button>
            </form>
        </div>

        <table class="table table-hover" style="color: #606569;">
            <thead>
                <tr>
                    <th></th>
                    <th>Dass namn</th>
                    <th>Beskrivning</th>
                    <th>Ansvariga</th>
                    <th>vinster</th>
                    <th>plats</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($toilets as $toilet)
                    <tr>
                        <td>
                            <span>
                                <a href="/admin/gameofthrones/edit/{{$toilet->id}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                            
                                <a href="/admin/gameofthrones/delete/{{$toilet->id}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                            </span>
                        </td>
                        <td>{{$toilet->name}}</td>
                        <td>{{$toilet->description}}</td>
                        <td>{{$toilet->responsible}}</td>
                        <td>{{$toilet->wins}}</td>
                        <td>{{$toilet->place}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection