@extends('Layouts/template')
@section('content')

<div class="LoginContainer centerTextInDiv">
    <h1 class="whiteColor">Logga in</h1>
    <div class="loginBox ">
            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-controll loginField {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Epost Address">
            </div>
            <div class="form-group">
                <input type="password" class="form-controll loginField {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required placeholder="Lösenord">
            </div>
            <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label whiteColor" for="remember" style="font-weight: normal;">
                        Kom ihåg mig
                    </label>
                </div>
            <a href="{{ route('password.request') }}" style="color: white; font-family: ChampagneLimousines;">Glömt lösenord?<br><br></a>
            <button type="submit" class="btn btn-white" style="font-family: ChampagneLimousines;">Logga in</button>
        </form>
    </div>
</div>

@endsection
