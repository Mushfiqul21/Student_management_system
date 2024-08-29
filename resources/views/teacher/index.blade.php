@extends('layout.app')

@section('title', 'Teacher Information')

@include('layout.header')

@section('main')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>Teacher List</h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTeacherModal">Add New Teacher</button>
        </div>
        <hr>
        @if (session('success'))
            <div class="alert alert-success" style="padding: 10px; margin-bottom: 15px; border: 1px solid green; background-color: #d4edda; color: #155724;">
                {{ session('success') }}
            </div>
        @endif
        {{--Teacher List--}}
        <div>
            <table class="table" id="teacherTable">
                <thead>
                <th>Teacher Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Phone</th>
                <th>Action</th>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{$teacher?->id}}</td>
                        <td>{{$teacher?->name}}</td>
                        <td>{{$teacher?->email}}</td>
                        <td>{{$teacher?->designation}}</td>
                        <td>{{$teacher?->phone}}</td>
                        <td>
                            <div class="d-flex gap-1 justify-content-start">
                                <button class="btn btn-success">Edit</button><button class="btn btn-primary">View</button><button class="btn btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{--Add Teacher Modal--}}
        <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-size">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Teacher Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Teacher Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="col-form-label">Designation:</label>
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Teacher Designation">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="col-form-label">Phone Number:</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Teacher Phone Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Picture:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- update teacher modal -->
        <div class="modal fade" id="updateStudentModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
                $('#teacherTable').DataTable();
        });
    </script>
@endpush

