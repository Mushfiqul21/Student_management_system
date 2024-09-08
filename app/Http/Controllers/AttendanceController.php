<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   public function index(Request $request){
       $data['classrooms'] = Classroom::all();
       $classroomId = $request->input('classroom_id');
       $data['presentStudents'] =Student::where('classroom_id', $classroomId)
           ->where('status', 'present')
           ->count();
       $data['absentStudents'] = Student::where('classroom_id', $classroomId)
           ->where('status', 'absent')
           ->count();
       return view('attendance.index', $data);
   }

}
