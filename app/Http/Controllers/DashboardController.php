<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['totalStudents'] = Student::count();
        $data['totalTeachers'] = Teacher::count();
        return view('dashboard', $data);
    }
}
