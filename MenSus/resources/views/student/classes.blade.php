@extends('layouts.master')
@section('header')
    @include('includes.headers.studentClasses')
@endsection
@section('content')
    <div class="content">
        @if(Session::has('fail'))
            <div class="info-box fail">
                {{ Session::get('fail') }}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="info-box success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="user">
            <h1>{{ $student->email }}</h1>
            <div class="allClasses">
                <h1>My classes</h1>
                @foreach($student->classes as $class)
                    <form action="{{route('student.classes')}}" method="post">
                        {{ $class->name }}
                        <input type="submit" value="X">
                        <input type="hidden" name="class" value="{{ $class->id }}">
                        <input type="hidden" name="action" value="out">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                @endforeach
            </div>
            <div class="allClasses">
                <h1>Other classes</h1>

            @foreach($result as $class)
                <div>
                    <form action="" method="post">
                        {{ $class->name }}
                        <input type="submit" value="Enroll">
                        <input type="hidden" name="class" value="{{ $class->id }}">
                        <input type="hidden" name="action" value="in">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection