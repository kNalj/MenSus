@extends('layouts.adminMaster')
@section('content')
    <div class="link">
        <a href={{ route('home') }}>HOME</a><br>
    </div>

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
    <div class="content">
        <div class="login">
            <form action="{{ route('admin.login') }}" method="POST">

                <label for="name">Your name</label>
                <input type="text" name="email" id="email" value="{{ Session::get('email') }}" placeholder="Your name">

                <label for="password">Your password</label>
                <input type="password" name="password" id="password" placeholder="Your password">

                <br>

                <input type="submit" value="Login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
@endsection