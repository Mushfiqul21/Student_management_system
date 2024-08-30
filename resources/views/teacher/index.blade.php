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
            <div class="alert alert-success">
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
                                <button type="button" id="editTeacherModalAction" class="btn btn-light"
                                        data-bs-target="#editTeacherModal" data-bs-toggle="modal"
                                        data-id="{{ encrypt($teacher->id) }}"
                                        data-name="{{ $teacher->name }}"
                                        data-email="{{ $teacher->email }}"
                                        data-phone="{{ $teacher->phone }}"
                                        data-designation="{{ $teacher->designation }}">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button class="btn btn-info"><svg width="15" height="15" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><path fill="#ffffff" d="M33.62 17.53c-3.37-6.23-9.28-10-15.82-10S5.34 11.3 2 17.53l-.28.47.26.48c3.37 6.23 9.28 10 15.82 10s12.46-3.72 15.82-10l.26-.48Zm-15.82 8.9C12.17 26.43 7 23.29 4 18c3-5.29 8.17-8.43 13.8-8.43S28.54 12.72 31.59 18c-3.05 5.29-8.17 8.43-13.79 8.43" class="clr-i-outline clr-i-outline-path-1"/><path fill="#ffffff" d="M18.09 11.17A6.86 6.86 0 1 0 25 18a6.86 6.86 0 0 0-6.91-6.83m0 11.72A4.86 4.86 0 1 1 23 18a4.87 4.87 0 0 1-4.91 4.89" class="clr-i-outline clr-i-outline-path-2"/><path fill="none" d="M0 0h36v36H0z"/></svg> </button>
                                <button class="btn btn-light text-danger"><svg width="17" height="17" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>
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
        <!-- Edit teacher modal -->
        <div class="modal fade" id="editTeacherModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Edit Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input  name="id" type="hidden" value="" id="editFormId">
                    <div class="modal-body">
                        <form action="{{ route('teacher.update', encrypt($teacher->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" name="name" value=""
                                       class="form-control @error('name') is-invalid @enderror" id="editName" autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" name="email" value=""
                                       class="form-control @error('email') is-invalid @enderror" id="editEmail">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="editPhone" class="form-label">Phone</label>
                                <input type="number" name="phone" value="" class="form-control @error('phone') is-invalid @enderror" id="editPhone">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Designation Field -->
                            <div class="mb-3">
                                <label for="editDesignation" class="form-label">Designation</label>
                                <input type="text" name="designation" value="" class="form-control @error('designation') is-invalid @enderror" id="editDesignation">
                                @error('designation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                       id="image">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark px-5">Update</button>
                            </div>
                        </form>
                    </div>
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
        $(function () {
            $(document).on('click', "#editTeacherModalAction", function (event) {
                $('#editFormId').val($(this).data('id'));
                $('#editName').val($(this).data('name'));
                $('#editEmail').val($(this).data('email'));
                $('#editPhone').val($(this).data('phone'));
                $('#editDesignation').val($(this).data('designation'));
            });
        });
    </script>
@endpush

