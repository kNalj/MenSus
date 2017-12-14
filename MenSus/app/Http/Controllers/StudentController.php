<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\users;
use App\classes;
use App\usersClasses;
use DB;

class StudentController extends Controller
{
    public function getHome($classCode = null) {

        $student = Auth::user();

        if ($classCode != null) {
            $selectedClass = classes::where('classCode', $classCode)->first();
        } else {
            $selectedClass = null;
        }

        return view('student.home',['student' => $student, 'selectedClass' => $selectedClass]);
    }

    public function saveChanges (Request $request) {
        DB::table('users_classes')
            ->where('users_id', $request['user'])
            ->where('classes_id', $request['class'])
            ->update(['status' => $request['status']]);

        return redirect()->route('student.home')->with(['success' => 'Changes saved']);
    }

    public function getClasses () {

        $student = Auth::user();
        $classes = classes::all();

        $result = DB::table('classes')->whereNotIn('id', function($q) {
                $student = Auth::user();
                $q->select('classes_id')->from('users_classes')->where('users_id', $student->id);
            })->get();

        return view('student.classes', ['student' => $student, 'classes' => $classes, 'result' => $result]);
    }

    public function postClasses (Request $request) {

        if($request['action'] == 'out') {
            $uc = usersClasses::where('users_id', Auth::user()->id)
                        ->where('classes_id', $request['class']);
            $uc->delete();
        } else {
            $uc = new usersClasses();
            $uc->users_id = Auth::user()->id;
            $uc->classes_id = $request['class'];
            $uc->status = 'nije polozeno';
            $uc->save();
        }

        return redirect()->route('student.classes');
    }


}
