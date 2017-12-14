<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\users;
use App\classes;
use App\usersClasses;
use DB;

class MentorController extends Controller
{
    public function getHome () {

        $students = users::where('role', 'student')->get();
        $classes = classes::all();

        return view('mentor.home', [
            'students' => $students,
            'classes' => $classes
        ]);
    }

    public function getClasses ($class = null) {

        $classes = classes::all();

        if ($class != null) {
            $selectedClass = classes::where('classCode', $class)->first();
        } else {
            $selectedClass = null;
        }

        return view('mentor.classes', [
            'classes' => $classes,
            'selectedClass' => $selectedClass
        ]);

    }

    public function postClasses (Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'classCode' => 'required',
            'ECTS' => 'required|numeric',
            'semRedovni' => 'required|numeric',
            'semVanredni' => 'required|numeric',
            'izborni' => 'required|in:da,ne',
            'program' => 'required'
        ]);

        $selectedClass = classes::where('id', $request['id'])->first();
        $selectedClass->name = $request['name'];
        $selectedClass->classCode = $request['classCode'];
        $selectedClass->ECTS = $request['ECTS'];
        $selectedClass->semRedovni = $request['semRedovni'];
        $selectedClass->semVanredni = $request['semVanredni'];
        $selectedClass->izborni = $request['izborni'];
        $selectedClass->program = $request['program'];
        $selectedClass->save();


        return redirect()->route('mentor.classes', [
            'class' => $selectedClass->classCode
        ]);
    }

    public function getStudents ($student = null) {

        $students = users::where('role', 'student')->paginate(10);

        if ($student != null) {

            $selectedStudent = users::where('email', $student)->first();

            $result = DB::table('classes')->whereNotIn('id', function($q) use ($selectedStudent) {
                $q->select('classes_id')->from('users_classes')->where('users_id', $selectedStudent->id);
            })->get();
        } else {
            $selectedStudent = null;
            $result = null;
        }


        return view('mentor.students', [
            'students' => $students,
            'selectedStudent' => $selectedStudent,
            'result' => $result
        ]);

    }

    public function postStudents (Request $request) {


        $selectedStudent = users::where('id', $request['student'])->first();

        if($request['action'] == 'in') {

            $this->validate($request, [
                'email' => 'exists:users,email'
            ]);

            $uc = new usersClasses();
            $uc->users_id = $request['student'];
            $uc->classes_id = $request['class'];
            $uc->status = 'nije polozeno';
            $uc->save();
        } elseif ($request['action'] == 'out') {

            $this->validate($request, [
                'email' => 'exists:users,email'
            ]);

            $uc = usersClasses::where('users_id', $request['student'])
                                ->where('classes_id', $request['class']);
            $uc->delete();
        } elseif ($request['action'] == 'search') {
            $selectedStudent = users::where('email', $request['email'])->first();
        } elseif ($request['action'] == 'changeStatus') {
            usersClasses::where('users_id', $request['student'])
                          ->where('classes_id', $request['class'])
                          ->update(['status' => $request['status']]);
        } elseif ($request['action'] == 'addStudent') {

            $this->validate($request, [
                'email' => 'required|unique:users',
                'password' => 'required'
            ]);

            $s = new users();
            $s->password = bcrypt($request['password']);
            $s->email = $request['email'];
            $s->status = $request['status'];
            $s->role = "student";
            $s->save();

            return redirect()->route('mentor.students');

        }

        return redirect()->route('mentor.students', [
            'student' => $selectedStudent->email
        ]);

    }
}
