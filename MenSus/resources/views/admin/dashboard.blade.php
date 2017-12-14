@extends('layouts.adminMaster')
<div class="link">
    <a href="{{ route('admin.logout') }}">LOGOUT</a> <br/><br/>
</div>
@section('content')
    @if(count($errors) > 0)
        <section class="info-box fail">
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        </section>
    @endif
    USERS: <br/>
    @foreach($users as $user)
        @if($user->role != 'admin')
            <form action="{{ route('admin.save') }}" method="post">
                ID:{{ $user->id }}
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="user" value=true>
                <input type="text" name="email" id="email" value="{{$user->email}}">

                <select name="role" id="role">
                    <option value="{{$user->role}}">{{$user->role}}</option>
                    <option value="{{ $user->role === 'student' ? 'mentor' : 'student' }}">{{ $user->role === 'student' ? 'mentor' : 'student' }}</option>
                </select>
                @if($user->role === 'student')
                    <select name="status" id="status">
                        <option value='{{ $user->status != null ? $user->status : 'vanredni'}}'>{{ $user->status != null ? $user->status : 'vanredni'}}</option>
                        <option value='{{ $user->status === 'redovni' ? 'vanredni' : 'redovni' }}'>{{ $user->status === 'redovni' ? 'vanredni' : 'redovni' }}</option>
                    </select>
                @endif
                <button type="submit">Save</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br/>
                @foreach($user->classes as $class)
                    {{ $class->classCode }}:
                    <input type="text" name="{{ $class->id }}" value="{{
                        DB::table('users_classes')
                        ->where('users_id', $user->id)
                        ->where('classes_id', $class->id)->first()->status }}" placeholder="Upisan/polozen/ponavlja">
                @endforeach
            </form>
            <br/>
        @endif
    @endforeach

    <br/><br/>CLASSES:<br/>
    @foreach($classes as $class)
            <form action="{{ route('admin.save') }}" method="post">
                ID:{{ $class->id }}
                <input type="hidden" name="id" value="{{ $class->id }}">
                <input type="hidden" name="class" value=true>
                <input type="text" name="classCode" value="{{ $class->classCode }}">
                <input type="text" name="name" value="{{ $class->name }}">
                <input type="text" name="ECTS" value="{{ $class->ECTS }}"><br/>
                <input type="text" name="semRedovni" value="{{ $class->semRedovni }}">
                <input type="text" name="semVanredni" value="{{ $class->semVanredni }}">
                <select name="izborni">
                    <option value="{{ $class->izborni ? $class->izborni : 'ne' }}">{{ $class->izborni ? $class->izborni : 'ne' }}</option>
                    <option value="{{ $class->izborni === 'da' ? 'ne' : 'da' }}">{{ $class->izborni === 'da' ? 'ne' : 'da' }}</option>
                </select>
                <br/><textarea name="program" rows="4" cols="50" value="{{ $class->program }}">{{ $class->program }}</textarea>
                <button type="submit">Save</button>
                <br/><br/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        @endforeach
@endsection