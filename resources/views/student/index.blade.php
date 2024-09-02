@extends('layout.app')

@section('title', 'Student Information')

@include('layout.header')

@section('main')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>Student List</h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
        </div>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{--Student List--}}
        <div>
            <table class="table" id="studentTable">
                <thead>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        {{--Add Student Modal--}}
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-size">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Student Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Class:</label>
                                <select name="class" id="class" class="form-select" required>
                                    <option selected disabled>Select Student Class</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Picture:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="mb-2 form-label">Gender</label>
                                <div class="d-flex">
                                    <div class="mx-1 d-flex">
                                        <input type="radio" name="gender" value="Male" id="gender_male" class="mr-5">
                                        <label for="gender_male" class="mr-5 px-1">Male</label>
                                    </div>
                                    <div class="mx-1 d-flex">
                                        <input type="radio" name="gender" value="Female" id="gender_female" class="mr-5 px-1">
                                        <label for="gender_female" class="mr-5 px-1">Female</label>
                                    </div>
                                    <div class="mx-1 d-flex">
                                        <input type="radio" name="gender" value="Others" id="gender_others" class="mr-5 px-1">
                                        <label for="gender_others" class="mr-5 px-1">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="col-form-label">Phone Number:</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Student Phone Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="col-form-label">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Student Address" required>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="col-form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Student Date of Birth">
                            </div>
                            <div class="mb-3">
                                <label for="guardian_name" class="col-form-label">Guardian Name:</label>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" placeholder="Enter Student Guardian Name">
                            </div>
                            <div class="mb-3">
                                <label for="guardian_phone" class="col-form-label">Guardian Phone Number:</label>
                                <input type="number" class="form-control" id="guardian_phone" name="guardian_phone" placeholder="Enter Student Guardian Phone NUmber">
                            </div>
                            <div class="mb-3">
                                <label for="guardian_phone" class="col-form-label">Student Status:</label>
                                <select name="class" id="class" class="form-select" required>
                                    <option selected disabled>Status</option>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                </select>
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
        <!-- update student modal -->
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
            $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("student.index") }}',
                columns: [
                    {
                        data: null,
                        name: 'row_number',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Sequential row number
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'class', name: 'class' },
                    { data: 'phone', name: 'phone' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $(document).on('click', '.editModal', function () {
                var url = $(this).data('url');
                var id = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $("#updateStudentModal .modal-content").html(data);
                        $("#updateStudentModal").modal('show');
                    },
                    error: function (error) {
                    }
                });
            });
            $('#studentTable').on('click', '#studentDeleteAction', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var confirmMessage = $(this).data('confirm');

                if (confirm(confirmMessage)) {
                    window.location.href = url;
                }
            });
        });

    </script>
@endpush
