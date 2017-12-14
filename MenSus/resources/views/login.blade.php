@extends('layouts.master')
@section('header')
    @include('includes.headers.login')
@endsection
@section('content')
    @if(count($errors) > 0)
        <section class="info-box fail">
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        </section>
    @endif

    @if(Session::has('fail'))
        <div class="info-box fail">
            {{ Session::get('fail') }}
        </div>
    @endif
    <div class="login">
        <form action="{{ route('login') }}" method="post">

            <label for="email">Email
                <input type="text" name="email" id="email" />
            </label>

            <label for="password">Password
                <input type="password" name="password" id="password" />
            </label>

            <div class="clear"></div>

            <a href="{{ route('register') }}"><input type="button" value="Register" /></a>

            <input type="submit" value="Login" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
@endsection