@extends('layout.app')

@section('title', 'Student Information')

@include('layout.header')

@section('main')
    <div class="container">
        <h3>Attendance</h3>
        <hr>
        <div class="mb-5">
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
        <table class="table">
            <thead>
                <th>Present</th>
                <th>Absent</th>
            </thead>
            <tbody>
                <td>100</td>
                <td>20</td>
            </tbody>
        </table>
    </div>
@endsection
