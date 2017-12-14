@extends('layouts.master')
@section('header')
    @include('includes.headers.mentorStudents')
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
        <h1>students</h1>
        @foreach($students as $student)
            <div>
                <a href="{{ route('mentor.students', ['student' => $student->email]) }}" >{{ $student->email }}</a>
            </div>
        @endforeach

        <div class="search">
            <form action="{{ route('mentor.students') }}" method="post">
                Search:<input type="text" name="email" placeholder="student email">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="action" value="search">
                <input type="submit" value="Go!">
            </form>
        </div>

        <div class="pagination">
            @if($students->currentPage() !== 1)
                <a href="{{ $students->previoudPageUrl() }}" > < </a>
            @endif
            <a href="" > {{ $students->currentPage() }} </a>
            @if($students->currentPage() !== $students->lastPage() && $students->hasPages())
                <a href="{{ $students->nextPageUrl() }}" > > </a>
            @endif
        </div>
    </div>
    @if($selectedStudent != null)
        <div class="description">
            <h1>Details for: {{ $selectedStudent->email }}</h1>
            <div class="infoLeft">
                <div class="class">
                    <h1>In classes</h1>
                    @foreach($selectedStudent->classes as $class)
                        <div>
                            <form action="{{ route('mentor.students') }}" method="post">
                                {{ $class->name }}
                                <input type="hidden" name="class" value="{{ $class->id }}">
                                <input type="hidden" name="student" value="{{ $selectedStudent->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="action" value="out">
                                <input type="submit" value="X">
                            </form>
                        </div>
                    @endforeach
                </div>
                <br/>
                <br/>
                <div class="class">
                    <h1>Other classes</h1>
                    @foreach($result as $class)
                        <div>
                            <form action="{{ route('mentor.students') }}" method="post">
                                {{ $class->name }}
                                <input type="hidden" name="class" value="{{ $class->id }}">
                                <input type="hidden" name="student" value="{{ $selectedStudent->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="action" value="in">
                                <input type="submit" value="Enroll">
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="infoRight">
                <h1>Semesters</h1>
                    @for($i = 1; $i < 7; $i++)
                        <div class="description">
                            <h1>{{$i}}. semestar</h1>
                            @foreach($selectedStudent->classes as $class)
                                @if($class->semRedovni == $i || $class->semVanredni == $i)
                                    {{--*/
                                    $option = DB::table('users_classes')->where('users_id', $selectedStudent->id)
                                                                        ->where('classes_id', $class->id)
                                                                        ->first()->status
                                    /*--}}
                                    <div>
                                        {{ $student->status == 'redovni' ? $class->semRedovni == $i ? $class->name : '' : $class->semVanredni == $i ? $class->name : '' }}
                                        <form action="{{ route('mentor.students') }}" method="post">
                                            <select name="status">
                                                <option value="{{ $option == 'polozeno' ? 'polozeno' : 'nije polozeno' }}">{{ $option == 'polozeno' ? 'polozeno' : 'nije polozeno' }}</option>
                                                <option value="{{ $option == 'polozeno' ? 'nije polozeno' : 'polozeno' }}">{{ $option == 'polozeno' ? 'nije polozeno' : 'polozeno' }}</option>
                                            </select>
                                            <input type="hidden" name="class" value="{{ $class->id }}">
                                            <input type="hidden" name="student" value="{{ $selectedStudent->id }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="action" value="changeStatus">
                                            <input type="submit" value="save">
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endfor
            </div>
        </div>
    @endif
        <div class="allClasses">
            <h1>Add new student</h1>
            <form action="{{route('mentor.students')}}" method="post">
                <input type="text" name="email" placeholder="**#####@unist.hr">
                <input type="password" name="password" placeholder="password">
                <select name="status">
                    <option value="redovni">redovni</option>
                    <option value="vanredni">vanredni</option>
                </select>

                <input type="hidden" name="action" value="addStudent">
                <input type="submit" value="Add student">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
@endsection