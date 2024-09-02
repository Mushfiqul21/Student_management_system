@extends('layout.app')

@section('title', 'Teacher Information')

@include('layout.header')

@section('main')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>Teacher Information</h3>
            <a class="btn btn-dark" href="{{ route('teacher.index') }}">Back</a>
        </div>
        <hr>
        <div class="d-flex justify-content-between w-50">
            <h5>{{ $teacher?->name }}</h5>
            <img src="{{ asset('assets/images/' . $teacher?->image) }}" alt="" width="50px" height="50px">
        </div>
        <div>
            <p>Email: {{$teacher?->email}}</p>
            <p>Designation: {{$teacher?->designation}}</p>
            <p>Phone: {{$teacher?->phone}}</p>
        </div>
    </div>
@endsection
