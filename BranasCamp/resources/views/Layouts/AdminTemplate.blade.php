@extends('Layouts/template')
@section('content')
<div class="container">
    <div class="adminContainer">
    @if(Auth::user()->level < 1)
        <div class="sidebarContainer">
            <a href="/admin/dashboard" class="adminNavBlock">Dashboard start</a>
            <hr class="adminNavLine">
            <a href="/admin/register" class="adminNavBlock">Lägg till användare</a>
            <hr class="adminNavLine">
            <a href="/admin/registrationlists" class="adminNavBlock">Deltagar-listor</a>
            <hr class="adminNavLine">
            <a href="/admin/manageusers" class="adminNavBlock">Hantera användare</a>
            <hr class="adminNavLine">
            <a href="/admin/managecamps" class="adminNavBlock">Hantera Läger</a>
            <hr class="adminNavLine">
            <a href="{{ route('logout') }}" class="adminNavBlock" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logga ut</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </div>
        <div class="adminContent">
            @yield('adminContent')
        </div>
    
    @elseif(Auth::user()->level < 1000)
    <div class="sidebarContainer">
        <a href="{{ route('logout') }}" class="adminNavBlock" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logga ut</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div class="adminContent">
            @yield('adminContent')
        </div>
    @endif
    </div>  
</div>
@endsection