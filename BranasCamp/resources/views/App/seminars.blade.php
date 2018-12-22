@extends('Layouts/appTemplate')
@section('appContent')
    
<div class="container appFooterSpacer">
    <h1 class="whiteColor" style="text-align:center; padding-top: 15px">Seminarier</h1>
    <p class="whiteColor centerTextInDiv" style="font-size: 14px;">Här kommer det finnas generell info om hur seminarierna kommer fungera. Detta kommer någon
         skriva ordentligt senare, genom admin-sidan.
    </p>

    <div class="customTable-ish">
        <h5>28 Dec</h5>
        <div>
            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#seminar1" aria-expanded="true" aria-controls="seminar1">Titel på seminariet
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="seminar1">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta seminarium kommer handla om.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Platser:</b> 000
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#seminar2" aria-expanded="true" aria-controls="seminar2">Titel på seminariet
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="seminar2">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta seminarium kommer handla om.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Platser:</b> 000
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="customTable-ish">
        <h5>29 Dec</h5>
        <div>
            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#seminar3" aria-expanded="true" aria-controls="seminar3">Titel på seminariet
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="seminar3">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta seminarium kommer handla om.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Platser:</b> 000
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

            <div class="customTable-ish-row">
                <button style="font-size: 18px; font-family: Elkwood; color: #606569;" type="button" data-toggle="collapse" data-target="#seminar4" aria-expanded="true" aria-controls="seminar4">Titel på seminariet
                    <span style="float: right;"><i class="fas fa-angle-down" style="text-align: right;"></i></span>
                </button>
                <div class="collapse" id="seminar4">
                    <p style="font-size: 14px;">
                        Här kommer det finnas mängder med info om vad just detta seminarium kommer handla om.
                    </p>
                    <p style="font-size: 14px;"><b>Antal Platser:</b> 000
                        <span style="float: right;"><b>Plats:</b> Platsen</span> 
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection