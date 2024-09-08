@extends('layout.app')

@section('title', 'Student Information')

@include('layout.header')

@section('main')
    <div class="container">
        <h3>Attendance</h3>
        <hr>
        <form action="{{ route('attendance.index') }}" method="GET">
            <div class="mb-5">
                <div class="d-flex justify-content-between gap-1">
                    <select name="classroom_id" id="classroom_id" class="form-select" required>
                        <option selected disabled>Select Student Class</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark">Show</button>
                </div>
            </div>
        </form>
        <table class="table" id="presentStudentsTable">
            <thead>
                <th>Present</th>
                <th>Absent</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$presentStudents}}</td>
                    <td>{{$absentStudents}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>

    </script>
@endpush
