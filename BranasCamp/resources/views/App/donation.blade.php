@extends('Layouts/appTemplate')
@section('appContent')
    
<div class="container appFooterSpacer">
    <h1 class="whiteColor" style="text-align:center; padding-top: 15px">Insamling</h1>

    <div style="background-color: white; padding: 15px;">
        <p>
            {!! html_entity_decode($insamling->description)!!}
        </p> 
    </div>   
    
    </div>

@endsection