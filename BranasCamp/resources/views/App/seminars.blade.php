@extends('Layouts/appTemplate')
@section('appContent')
    
<div class="container appFooterSpacer">
    <h1 class="whiteColor" style="text-align:center; padding-top: 15px">Seminarier</h1>
    <p class="whiteColor centerTextInDiv" style="font-size: 14px;">{{$seminarInfo->description}}</p>


    @foreach($dates as $date)
        <div class="customTable-ish">
            <h5>{{Carbon\Carbon::parse($date)->format('d M')}}</h5>
            <div>
                @foreach($seminars as $seminar)
                    @if($seminar->date == $date)
                        <div class="customTable-ish-row">
                            <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#seminar{{$seminar->id}}" aria-expanded="true" aria-controls="seminar1">
                                {{$seminar->titel}} @if($seminar->gym_plus) <i class="fab fa-google-plus-g" style="font-size: 13px; margin-left: 10px;"></i> @endif
                                <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                            </button>
                            <div class="collapse" id="seminar{{$seminar->id}}">
                                <p style="font-size: 14px;">
                                    {{$seminar->description}}
                                </p>
                                <p style="font-size: 14px;">Ansvarig: {{$seminar->responsible}}</p>
                                <p style="font-size: 14px;"><b>Antal Platser:</b> {{$seminar->spots}}
                                    <span style="float: right;"><b>Plats:</b> {{$seminar->place}}</span> 
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    @endforeach
</div>
@endsection