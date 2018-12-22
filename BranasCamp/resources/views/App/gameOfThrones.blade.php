@extends('Layouts/appTemplate')
@section('appContent')
    
<div class="container appFooterSpacer">
    <h1 class="whiteColor" style="text-align:center; padding-top: 15px">Toakampen</h1>
    <p class="whiteColor centerTextInDiv" style="font-size: 14px;">Här kommer det finnas generell info om hur toakampen kommer fungera. Detta kommer någon
         skriva ordentligt senare, genom admin-sidan.
    </p>

    <div class="customTable-ish">
        <h5>Dass (plural)</h5>
        <div>
            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#dass1" aria-expanded="true" aria-controls="dass1">Titel på dasset
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="dass1">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta dass kommer erbjuda.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Vinster:</b> 0
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#dass2" aria-expanded="true" aria-controls="dass2">Titel på dasset
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="dass2">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta dass kommer erbjuda.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Vinster:</b> 0
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

        </div>
    </div>


</div>
@endsection