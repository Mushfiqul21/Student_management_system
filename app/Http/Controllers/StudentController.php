<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data['classrooms'] = Classroom::all();
        if ($request->ajax()) {
            try {
                $data = Student::with('classroom')->select(['id', 'name', 'image', 'classroom_id', 'phone']);
                return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($data) {
                        $imagePath = asset('assets/images/' . $data->image);
                        return '<img src="' . $imagePath . '" alt="Image" class="img-fluid" style="max-width: 60px; height: 30px;">';
                    })
                    ->addColumn('class', function($data) {
                        return $data->classroom ? $data->classroom->name : 'N/A';
                    })
                    ->addColumn('action', function($data) {
                        return '<div class="d-flex justify-content-start gap-1">
                         <button data-url="' . route('student.edit') . '" data-id="' . encrypt($data->id) . '" class=" btn btn-light d-flex editModal" title="' . __("Edit") . '">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>


                        <a href="' . route('student.view', encrypt($data->id)) . '" class=" btn btn-info d-flex " title="' . __("View") . '">  <svg width="15" height="15" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><path fill="#ffffff" d="M33.62 17.53c-3.37-6.23-9.28-10-15.82-10S5.34 11.3 2 17.53l-.28.47.26.48c3.37 6.23 9.28 10 15.82 10s12.46-3.72 15.82-10l.26-.48Zm-15.82 8.9C12.17 26.43 7 23.29 4 18c3-5.29 8.17-8.43 13.8-8.43S28.54 12.72 31.59 18c-3.05 5.29-8.17 8.43-13.79 8.43" class="clr-i-outline clr-i-outline-path-1"/><path fill="#ffffff" d="M18.09 11.17A6.86 6.86 0 1 0 25 18a6.86 6.86 0 0 0-6.91-6.83m0 11.72A4.86 4.86 0 1 1 23 18a4.87 4.87 0 0 1-4.91 4.89" class="clr-i-outline clr-i-outline-path-2"/><path fill="none" d="M0 0h36v36H0z"/></svg> </a>

                        <a href="' . route('student.delete', encrypt($data->id)) . '" class="btn btn-light d-flex text-danger" id="studentDeleteAction" data-confirm="Are you sure you want to delete this user?" title="' . __("Delete") . '"><svg width="17" height="17" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg></a>
                        </div>';
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return view('student.index',$data);
    }


    public function store(Request $request){
        try {
            $this->validate($request, [
                'name' => 'required',
                'classroom_id' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gender' => 'required',
//                'address' => 'required',
//                'phone' => 'required',
//                'dob' => 'required|before:today',
//                'guardian_name' => 'required',
//                'guardian_phone' => 'required',
            ]);
            $studentData = new Student();
            $studentData->name = $request->name;
            $studentData->classroom_id = $request->classroom_id;
            $studentData->gender = $request->gender;
            $studentData->address = $request->address;
            $studentData->phone = $request->phone;
            $studentData->dob = $request->dob;
            $studentData->guardian_name = $request->guardian_name;
            $studentData->guardian_phone = $request->guardian_phone;
            if($request->hasFile('image')){
                if ($studentData->image != null)
                {
                    $publicPath= public_path('assets/images/').$studentData->image;
                    if(File::exists($publicPath)) {
                        unlink($publicPath);
                    }
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $studentData->image = $imageName;
                }
                else{
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $studentData->image = $imageName;
                }

            }
            $studentData->save();
            return redirect()->route('student.index')->with('success', 'Student Added Successfully');
        }catch (\Exception $e){
            $errors = $e->errors();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $data['student'] = Student::find(decrypt($request->id));
            $data['classrooms']= Classroom::all();

            return view('student.edit', $data)->render();
        }
    }

    public function update(Request $request, $id){
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);
            $studentData = Student::find(decrypt($id));
            $studentData->name = $request->name;
            $studentData->classroom_id = $request->classroom_id;
            $studentData->gender = $request->gender;
            $studentData->address = $request->address;
            $studentData->phone = $request->phone;
            $studentData->dob = $request->dob;
            $studentData->guardian_name = $request->guardian_name;
            $studentData->guardian_phone = $request->guardian_phone;
            if($request->hasFile('image')){
                if ($studentData->image != null)
                {
                    $publicPath= public_path('assets/images/').$studentData->image;
                    if(File::exists($publicPath)) {
                        unlink($publicPath);
                    }
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $studentData->image = $imageName;
                }
                else{
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $studentData->image = $imageName;
                }

            }
            $studentData->save();
            return redirect()->route('student.index')->with('success', 'Student Updated Successfully');
        }catch (\Exception $e){
            $errors = $e->errors();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function view($id){
        $data['student'] = Student::find(decrypt($id));
        return view('student.view', $data);
    }

    public function delete($id)
    {
        try {
            $student = Student::find(decrypt($id));
            if (is_null($student)) {
                return redirect()->back()->with('error', 'Student Not Found');
            }
            $student->delete();
            return redirect()->back()->with('success', 'Student Deleted Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}
