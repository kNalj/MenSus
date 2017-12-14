@extends('layouts.master')
@section('header')
    @include('includes.headers.classes')
@endsection
@section('content')
    <div class="classbar">
        <h1>Classes</h1>
        @foreach($classes as $class)
            <div class="class">
                <a href="{{ route('classes', ['classCode' => $class->classCode]) }}" >{{ $class->name }}</a><br>
            </div>
        @endforeach
    </div>
    @if($selectedClass != null)
        <div class="description">
            <h1>Description</h1>
            <table width="100%" cellpadding="5" cellspacing="10">
                <tr>
                    <td width="2%">ID</td>
                    <td width="36%">Name</td>
                    <td width="8%%">Code</td>
                    <td width="10%">ECTS</td>
                    <td width="19%">Sem. redovni</td>
                    <td width="19%">Sem. vanredni</td>
                    <td width="10%">Izborni</td>
                </tr>
                <tr>
                    <td>{{ $selectedClass->id }}</td>
                    <td>{{ $selectedClass->name }}</td>
                    <td>{{ $selectedClass->classCode }}</td>
                    <td>{{ $selectedClass->ECTS }}</td>
                    <td>{{ $selectedClass->semRedovni }}</td>
                    <td>{{ $selectedClass->semVanredni }}</td>
                    <td>{{ $selectedClass->izborni }}</td>
                </tr>
                <tr>
                    <td colspan="7">
                        {{ $selectedClass->program }}
                    </td>
                </tr>
            </table>
        </div>
    @endif
@endsection