@extends('layout.app')

@section('title', 'Student Management System')

@include('layout.header')

@section('main')
    <div class="container">
        <h3>Dashboard</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Total students</h4>
                    </div>
                    <div class="card-body">
                        <p>{{$totalStudents}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Teachers</h4>
                    </div>
                    <div class="card-body">
                        <p>{{$totalTeachers}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Attendance</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Present</p>
                                <p>65</p>
                            </div>
                            <div>
                                <p>Absent</p>
                                <p>35</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
