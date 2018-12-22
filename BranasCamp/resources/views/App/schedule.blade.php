@extends('Layouts/appTemplate')
@section('appContent')

<div class="scroller">

    <?php $date = 27; $month = "DECEMBER"; ?>
    @for($i = 0; $i < 6; $i++)
        <section class="page">
            <div class="centerTextInDiv">
                @switch($i)
                    @case(0)
                        <?php $date = 27; $month = "DECEMBER"; ?>
                        @break
                    @case(1)
                        <?php $date = 28; $month = "DECEMBER"; ?>
                        @break
                    @case(2)
                        <?php $date = 29; $month = "DECEMBER"; ?>
                        @break
                    @case(3)
                        <?php $date = 30; $month = "DECEMBER"; ?>
                        @break
                    @case(4)
                        <?php $date = 31; $month = "DECEMBER"; ?>
                        @break
                    @case(5)
                        <?php $date = 1; $month = "JANUARI"; ?>
                        @break
                    @default
                        
                @endswitch

            
                <h1 class="whiteColor">{{$date}} {{$month}}</h1>
                <h5 class="whiteColor">Info om dagen</h5>
                <p class="whiteColor" style="font-size: 14px;">Denna dag ska alla deltagare köpa godis till sina ledare.
                    Dom som inte gör det måste städa toaletterna resten av lägret.
                </p>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr class="whiteColor">
                        <th>Tid</th>
                        <th>Aktivitet</th>
                        <th>Beskrivning</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    @foreach($events as $event)
                    <tr>
                        <td>{{Carbon\Carbon::parse($event->time)->format('h:i')}}</td>
                        <td>{{$event->titel}}</td>
                        <td>{{$event->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    @endfor

</div>

@endsection