@extends('Layouts/template')
@section('content')

<div class="LoginContainer centerTextInDiv">
    <h1 class="whiteColor">Logga in</h1>
    <div class="loginBox ">
        <form>
            <div class="form-group">
                <input type="email" class="form-controll loginField" id="InputEmail" placeholder="Epost Address">
            </div>
            <div class="form-group">
                    <input type="password" class="form-controll loginField" id="InputPassword" placeholder="Lösenord">
            </div>
            <a href="#" style="color: white; font-family: ChampagneLimousines;">Glömt lösenord?<br><br></a>
            <button type="submit" class="btn btn-white" style="font-family: ChampagneLimousines;">Logga in</button>
        </form>
    </div>
</div>
@endsection