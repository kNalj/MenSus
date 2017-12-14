@extends('layouts.master')
@section('header')
    @include('includes.headers.mentorHome')
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

        <div class="allClasses">
            <h1>Classes</h1>
            @foreach($classes as $class)
                <div>
                    <a href="{{ route('mentor.classes', ['class' => $class->classCode]) }}">{{ $class->name }}</a>
                </div>
            @endforeach
        </div>
        <div class="allClasses">
            <h1>Students</h1>
            @foreach($students as $student)
                <div>
                    <a href="{{ route('mentor.students', ['student' => $student->email]) }}">{{ $student->email }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection