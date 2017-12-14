@extends('layouts.master')
@section('header')
    @include('includes.headers.studentHome')
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
            <div class="userClasses">
                <h1>Classes</h1>
                <h2>Nije polozeno</h2>
                @foreach($student->classes as $class)
                    {{--*/$option = DB::table('users_classes')
                                ->where('users_id', $student->id)
                                ->where('classes_id', $class->id)
                                ->first()
                                ->status/*--}}
                @if ($option == 'nije polozeno')
                    <div>
                        <a href="{{route('student.home', ['classCode' => $class->classCode])}}">{{ $class->name }}</a>
                    </div>
                @endif
                @endforeach
                <h2>Polozeno</h2>
                @foreach($student->classes as $class)
                    {{--*/$option = DB::table('users_classes')
                                ->where('users_id', $student->id)
                                ->where('classes_id', $class->id)
                                ->first()
                                ->status/*--}}
                    @if($option == 'polozeno')
                    <div>
                        <a href="{{route('student.home', ['classCode' => $class->classCode])}}">{{ $class->name }}</a>
                    </div>
                    @endif
                @endforeach
            </div>

            <div class="classDescription">
                <h1>Details</h1>
                    @if ($selectedClass)
                        <div class="infoLeft">
                            <h2>Code</h2>
                            {{ $selectedClass->classCode }}
                        </div>
                        <div class="infoRight">
                            <h2>ECTS</h2>
                            {{ $selectedClass->ECTS }}
                        </div>
                        <div class="infoLeft">
                            <h2>izborni</h2>
                            {{ $selectedClass->izborni }}
                        </div>
                        <div class="infoRight">
                            <h2>Semestar:</h2>
                            @if($student->status === 'redovni')
                                {{ $selectedClass->semRedovni }}
                            @elseif ($student->status === 'vanredni')
                                {{ $selectedClass->semVanredni }}
                            @else
                                Unknown
                            @endif
                        </div>
                        <div class="statusInfo">
                            <h1>status</h1>
                            <form action="{{ route('student.save') }}" method="post">
                                {{--*/$option = DB::table('users_classes')
                                ->where('users_id', $student->id)
                                ->where('classes_id', $selectedClass->id)
                                ->first()
                                ->status/*--}}
                                <select name="status">
                                    <option value="{{ $option != null ? $option : 'nije polozeno' }}">{{ $option != null ? $option : 'nije polozeno' }}</option>
                                    <option value="{{ $option == 'polozeno' ? 'nije polozeno' : 'polozeno' }}">{{ $option == 'polozeno' ? 'nije polozeno' : 'polozeno' }}</option>
                                </select>
                                <input type="hidden" name="user" value="{{ $student->id }}">
                                <input type="hidden" name="class" value="{{ $selectedClass->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="Save">
                            </form>
                        </div>
                    @else
                    @foreach($student->classes as $class)
                        <br>
                    @endforeach
                    @endif
            </div>
            <div class="allClasses">
                <h1>Semesters</h1>
                @for($i = 1; $i < 7; $i++)
                    @if($i%2 == 0)
                        <div class="infoRight">
                            <h1>{{$i}}. semestar</h1>
                            @foreach($student->classes as $class)
                                <div>
                                    {{ $student->status == 'redovni' ? $class->semRedovni == $i ? $class->name : '' : $class->semVanredni == $i ? $class->name : '' }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="infoLeft">
                            <h1>{{$i}}. semestar</h1>
                            @foreach($student->classes as $class)
                                <div>
                                    {{ $student->status == 'redovni' ? $class->semRedovni == $i ? $class->name : '' : $class->semVanredni == $i ? $class->name : '' }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endsection