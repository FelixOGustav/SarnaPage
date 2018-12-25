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
                        <?php $date = '01'; $month = "JANUARI"; ?>
                        @break
                    @default
                        
                @endswitch

            
                <h1 class="whiteColor">{{$date}} {{$month}}</h1>
                <h5 class="whiteColor">Info om dagen</h5>
                @foreach ($days as $day)
                    @if($day->date == '2018-12-'.$date || $day->date == '2019-01-'.$date)
                        <p class="whiteColor" style="font-size: 14px;">{{$day->info}}</p>
                    @endif
                @endforeach
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
                        @if(\Carbon\Carbon::parse($event->time)->format('d') == $date)
                            @if($event->leader != 1 || ($event->leader && $leaderSetting == 1))
                                <tr style="@if($event->leader)background-color: #f9f1a9; @endif">
                                    <td>{{Carbon\Carbon::parse($event->time)->format('H:i')}}</td>
                                    <td>{{$event->titel}}</td>
                                    <td>{{$event->description}}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </section>
    @endfor

</div>

@endsection