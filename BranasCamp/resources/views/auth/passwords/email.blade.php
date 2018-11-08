@extends('Layouts/template')
@section('content')

<div class="LoginContainer centerTextInDiv">
    <h1 class="whiteColor">Återställ Lösenord</h1>
    <div class="loginBox ">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <input id="email" type="email" class="form-control loginField {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Epost Address">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-white" style="font-family: ChampagneLimousines;">
                    {{ __('Skicka Länk för återställning') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
