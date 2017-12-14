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
    <div class="login">
        <h1>Register</h1>
        <form action="{{ route('register') }}" method="post">

            <label for="email">Email
                <input type="text" name="email" id="email" />
            </label>

            <label for="password">Password
                <input type="password" name="password" id="password" />
            </label>

            <label for="repeat">Repeat password
                <input type="password" name="repeat" id="repeat" />
            </label>

            <div class="clear"></div>

            <input type="submit" value="Submit" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
@endsection