@extends('includes.header')
@section('navItems')
    <li><a href="{{ route('home') }}" >Home</a></li>
    <li><a href="{{ route('classes') }}" class="active">Predmeti</a></li>
    @if(!Auth::user())
    <li><a href="{{ route('login') }}">Login</a></li>
    @else
    <li><a href="{{ route('logout') }}">Logout</a></li>
    @endif
@endsection