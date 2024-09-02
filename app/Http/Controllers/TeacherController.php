<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    public function index(){
        $data['teachers'] = Teacher::all();
        return view('teacher.index', $data);
    }

    public function store(Request $request){
        try {
          $this->validate($request, [
              'name' => 'required',
              'email' => 'required|email',
              'designation' => 'required',
              'phone' => 'required',
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

          $teacherData = new Teacher();
          $teacherData->name = $request->name;
          $teacherData->email = $request->email;
          $teacherData->Designation = $request->designation;
          $teacherData->phone = $request->phone;
            if($request->hasFile('image')){
                if ($teacherData->image != null)
                {
                    $publicPath= public_path('assets/images/').$teacherData->image;
                    if(File::exists($publicPath)) {
                        unlink($publicPath);
                    }
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $teacherData->image = $imageName;
                }
                else{
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $teacherData->image = $imageName;
                }

            }
            $teacherData->save();
            return redirect()->route('teacher.index')->with('success', 'Teacher Added Successfully');
        }catch (\Exception $e){
            $errors = $e->errors();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function update(Request $request, $id){
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $teacherData = Teacher::find($id);
            $teacherData->name = $request->name;
            $teacherData->email = $request->email;
            $teacherData->Designation = $request->designation;
            $teacherData->phone = $request->phone;
            if($request->hasFile('image')){
                if ($teacherData->image != null)
                {
                    $publicPath= public_path('assets/images/').$teacherData->image;
                    if(File::exists($publicPath)) {
                        unlink($publicPath);
                    }
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $teacherData->image = $imageName;
                }
                else{
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('assets/images/'), $imageName);
                    $teacherData->image = $imageName;
                }

            }
            $teacherData->save();
            return redirect()->route('teacher.index')->with('success', 'Teacher Updated Successfully');
        }catch (\Exception $e){
            $errors = $e->errors();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function view($id){
        $data['teacher'] = Teacher::find(decrypt($id));
        return view('teacher.view', $data);
    }

    public function delete($id)
    {
        try {
            $teacher = Teacher::find(decrypt($id));
            if (is_null($teacher)) {
                return redirect()->back()->with('error', 'Teacher Not Found');
            }
            $teacher->delete();
            return redirect()->route('teacher.index')->with('success', 'Teacher Deleted Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
