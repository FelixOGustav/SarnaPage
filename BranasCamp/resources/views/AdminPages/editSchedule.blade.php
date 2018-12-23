@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="row">
        <div class="col-sm-12">
            <a href="/admin/schedule/2018-12-27" class="btn btn-light dateSelectBtn" style="margin: 5px;">27 Dev</a>
            <a href="/admin/schedule/2018-12-28" class="btn btn-light dateSelectBtn" style="margin: 5px;">28 Dev</a>
            <a href="/admin/schedule/2018-12-29" class="btn btn-light dateSelectBtn" style="margin: 5px;">29 Dev</a>
            <a href="/admin/schedule/2018-12-30" class="btn btn-light dateSelectBtn" style="margin: 5px;">30 Dev</a>
            <a href="/admin/schedule/2018-12-31" class="btn btn-light dateSelectBtn" style="margin: 5px;">31 Dev</a>
            <a href="/admin/schedule/2019-01-01" class="btn btn-light dateSelectBtn" style="margin: 5px;">1 jan</a>
        </div>
    </div>
    <hr>

    <h3>Redigera infon för dagen</h3>
    <form action="/admin/schedule/save/{{$day->id}}" method="post" id="dayInfo">
        {{ csrf_field() }}
        <textarea name="info" id="info" cols="30" rows="4" form="dayInfo" style="width: 100%; text-align:center;">{{$day->info}}</textarea>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Spara</button>
    </form>
    <hr>
    <div>
        <button class="btn btn-success" style="margin: 16px 0px;" type="button" data-toggle="collapse" data-target="#newActivity" aria-expanded="true" aria-controls="newActivity"><i class="fas fa-plus"></i>  Ny Aktivitet</button>
    </div>

    <div class="collapse newActivityPanel" id="newActivity">
        <h4 style="text-align: center;">Ny Aktivitet</h4>
        <form action="/admin/schedule/newactivity" method="post">
            {{ csrf_field() }}
            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Tid</label>
                    <input class="form-control" style="padding-right: 0px;" type="text" id="time" name="time" placeholder="ÅÅÅÅ-MM-DD tt:mm:ss" required/>
                </div>
            </div>
            <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                    <label>Slut tid<span style="font-size: 12px;"> (Kan lämnas tom)</span></label>
                    
                    <input class="form-control" style="padding-right: 0px;" type="text" id="time_end" name="time_end" placeholder="ÅÅÅÅ-MM-DD tt:mm:ss"/>
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
                    <label>Endast för ledare</label>
                    <input type="checkbox" id="leader" name="leader" value="1"/>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>  Lägg till</button>
        </form>
    </div>

    <table class="table table-striped" style="color: #606569;">
        <thead>
            <tr>
                <th></th>
                <th>Start</th>
                <th>Slut</th>
                <th>Titel</th>
                <th>Beskrivning</th>
                <th>Senast ändrad</th>
                <th>Ändrad av</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                @if(Carbon\Carbon::parse($event->time)->format('Y-m-d') == $day->date)
                    <tr style="@if($event->leader)background-color: #f9f1a9; @endif">
                        <td>
                            <span>
                                <a href="/admin/schedule/edit/{{$event->id}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                            
                                <a href="/admin/schedule/delete/{{$event->id}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                            </span>
                        </td>
                        <td>{{Carbon\Carbon::parse($event->time)->format('H:i')}}</td>
                        <td>@if($event->time_end){{Carbon\Carbon::parse($event->time_end)->format('H:i')}}@endif</td>
                        <td>{{$event->titel}} @if($event->gym_plus)<i class="fab fa-google-plus-g"></i>@endif</td>
                        <td>{{$event->description}}</td>
                        <td>{{$event->updated_at}}</td>
                        <td>{{$event->changed_by}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

</div>


<script>
    
    $(document).ready( function () {
        $currentURI = '/{{$uri}}';
        $('.dateSelectBtn').each(function(index){
            if($(this).attr('href') == $currentURI || $(this).attr('href') == $currentURI + '/2018-12-27'){
                $(this).addClass('active');
            }
        });  
        
        /*$('#time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        }); */
    });

</script>

@endsection