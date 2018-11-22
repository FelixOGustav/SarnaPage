@extends('Layouts/template')
@section('content')
<div class="container">
    <div class="adminContainer">
        <div class="sidebarContainer">
            <a href="/admin/dashboard" class="adminNavBlock">Dashboard start</a>
            <hr class="adminNavLine">
            
            @can('adduser')
                <a href="/admin/register" class="adminNavBlock">Lägg till användare</a>
                <hr class="adminNavLine">
            @endcan

            @can('registrationlists')
                <a href="/admin/registrationlists" class="adminNavBlock">Deltagar-listor</a>
                <hr class="adminNavLine">
            @endcan

            @can('manageusers')
                <a href="/admin/manageusers" class="adminNavBlock">Hantera användare</a>
                <hr class="adminNavLine">
            @endcan

            @can('managecamps')
                <a href="/admin/managecamps" class="adminNavBlock">Hantera Läger</a>
                <hr class="adminNavLine">
            @endcan

            <a href="{{ route('logout') }}" class="adminNavBlock" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logga ut</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="adminContent">
            @yield('adminContent')
        </div>
    </div>  
</div>
@endsection