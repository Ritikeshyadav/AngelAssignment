<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageStudentController extends Controller
{
    public function index()
    {
        $students = Student::with('teacher')->orderByDesc('id')->get();
        return view('dashboard',['students'=>$students]);
    }
    
    public function addView()
    {
        $teachers = User::get();
        return view('student.add',['teachers'=>$teachers]);
    }

    public function add(Request $request)
    {
        $validator = validator::make($request->all(),[
            'student_name' => ['required', 'string', 'max:255'],
            'teacher' => ['required'],
            'class' => ['required','max:255'],
            'admission_date' => ['required', 'date'],
            'yearly_fees' => ['required', 'integer'],
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors()->all(),
            ]);
        }

        Student::create([
            'student_name' => $request->student_name,
            'teacher_xid' => $request->teacher,
            'class' => $request->class,
            'admission_date' => $request->admission_date,
            'yearly_fees' => $request->yearly_fees,
        ]);
        return response()->json([
            'status_code' => 200,
            'message' => 'Student created successfully',
        ]);
    }
    
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $teachers = User::get();
        return view('student.edit', compact(['student','teachers']));
    }

    public function update(Request $request)
    {
        $validator = validator::make($request->all(),[
            'student_name' => ['required', 'string', 'max:255'],
            'teacher' => ['required'],
            'student_id' => ['required'],
            'class' => ['required','max:255'],
            'admission_date' => ['required', 'date'],
            'yearly_fees' => ['required', 'integer'],
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors()->all(),
            ]);
        }

        Student::where('id',$request->student_id)->update([
            'student_name' => $request->student_name,
            'teacher_xid' => $request->teacher,
            'class' => $request->class,
            'admission_date' => $request->admission_date,
            'yearly_fees' => $request->yearly_fees,
        ]);
        return response()->json([
            'status_code' => 200,
            'message' => 'Student data updated successfully',
        ]);
    }

    public function delete($id)
    {
        Student::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Student deleted successfully');
    }
}
