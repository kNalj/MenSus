@extends('includes.header')
@section('navItems')
    <li><a href="{{ route('mentor.home') }}" class="active">Home</a></li>
    <li><a href="{{ route('mentor.classes') }}">Predmeti</a></li>
    <li><a href="{{ route('mentor.students') }}">Studenti</a> </li>
    @if(!Auth::user())
        <li><a href="{{ route('login') }}">Login</a></li>
    @else
        <li><a href="{{ route('logout') }}">Logout</a></li>
    @endif
@endsection