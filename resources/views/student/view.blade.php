@extends('layout.app')

@section('title', 'Student Management System')

@include('layout.header')

@section('main')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>Student Information</h3>
            <a class="btn btn-dark" href="{{ route('student.index') }}">Back</a>
        </div>
        <hr>
        <div>
            <table>
                    <tbody>
                        <tr>
                            <td class="px-2 py-1">Student Name: </td>
                            <td>{{ $student?->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Picture: </td>
                            <td><img src="{{ asset('assets/images/'.$student?->image) }}" alt="N/A" height="40px"></td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Class: </td>
                            <td>{{ $student?->class }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Phone: </td>
                            <td>{{ $student?->phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Address: </td>
                            <td>{{ $student?->address }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Date of Birth: </td>
                            <td>{{ $student?->dob }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Student Gender: </td>
                            <td>{{ $student?->gender }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Guardian Name: </td>
                            <td>{{ $student?->guardian_name }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">Guardian Phone: </td>
                            <td>{{ $student?->guardian_phone }}</td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>

@endsection
