@extends('layouts.master')
@section('header')
    @include('includes.headers.mentorClasses')
@endsection
@section('content')
    <div class="content">
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
        @if($selectedClass != null)
            <div class="allClasses">
                <h1>details</h1>
                <div>Number of students: {{ $selectedClass->users->count() }}</div>
                <div class="students">
                    <h1>Students</h1>
                    <div class="list">
                        @foreach($selectedClass->users as $student)
                            {{ $student->email }}
                        @endforeach
                    </div>
                </div>
                <div class="infoRightWide">
                    <h1>Description</h1>
                    <form action="{{ route('mentor.classes', ['class' => $selectedClass->classCode]) }}" method="post">
                        <div class="infoLeft">
                            <h2>Name</h2>
                                <input type="text" name="name" value="{{ $selectedClass->name }}">
                        </div>
                        <div class="infoRight">
                            <h2>Code</h2>
                                <input type="text" name="classCode" value="{{ $selectedClass->classCode }}">
                        </div>
                        <div class="infoLeft">
                            <h2>ECTS</h2>
                            <input type="text" name="ECTS" value="{{ $selectedClass->ECTS }}">
                        </div>
                        <div class="infoRight">
                            <h2>Sem. redovni</h2>
                            <input type="text" name="semRedovni" value="{{ $selectedClass->semRedovni }}">
                        </div>
                        <div class="infoLeft">
                            <h2>Sem. vanredni</h2>
                            <input type="text" name="semVanredni" value="{{ $selectedClass->semVanredni }}">
                        </div>
                        <div class="infoRight">
                            <h2>Izborni</h2>
                            <input type="text" name="izborni" value="{{ $selectedClass->izborni }}">
                        </div>
                        <div class="allClasses">
                            <h2>Program</h2>
                            <textarea name="program" rows="4" cols="50" value="{{ $selectedClass->program }}">{{ $selectedClass->program }}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $selectedClass->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="Save">
                    </form>
                    <br/>
                </div>
            </div>
        @endif
    </div>
@endsection