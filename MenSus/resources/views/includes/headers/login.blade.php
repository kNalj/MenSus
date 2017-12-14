@extends('includes.header')
@section('navItems')
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('classes') }}">Predmeti</a></li>
    <li><a href="{{ route('login') }}" class="active">Login</a></li>
@endsection