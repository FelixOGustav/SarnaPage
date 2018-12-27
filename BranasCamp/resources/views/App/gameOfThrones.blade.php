@extends('Layouts/appTemplate')
@section('appContent')
    
<div class="container appFooterSpacer">
    <h1 class="whiteColor" style="text-align:center; padding-top: 15px">Toakampen</h1>
    <p class="whiteColor centerTextInDiv" style="font-size: 14px;">{{$info->description}}
    </p>

    @if($info->vote_open)
    <div class="app_button_container">
        <a href="{{$info->link}}" class="app_button">Till Ömröstning!</a>
    </div>
    @endif

    <div class="customTable-ish">
        <h5>Dass (plural)</h5>
        <div>
            @foreach($toilets as $toilet)
                <div class="customTable-ish-row">
                    <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#dass{{$toilet->id}}" aria-expanded="true" aria-controls="dass1">{{$toilet->name}}
                        <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                    </button>
                    <div class="collapse" id="dass{{$toilet->id}}">
                        <p style="font-size: 14px;">{{$toilet->description}}</p>
                        <p style="font-size: 14px;"><b>Antal Vinster:</b> {{$toilet->wins}}
                            <span style="float: right;"><b>Plats:</b> {{$toilet->place}}</span> 
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</div>
@endsection