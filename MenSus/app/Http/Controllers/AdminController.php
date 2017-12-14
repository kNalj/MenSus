<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\users;
use App\classes;
use App\usersClasses;
use DB;

class AdminController extends Controller
{
    public function getLogin () {
        return view('admin.login');
    }

    public function getLogout () {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getDashboard () {
        $users = users::All();
        $classes = classes::All();
        return view('admin.dashboard', ['users' => $users, 'classes' => $classes]);
    }

    public function postLogin (Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        //da bi zna u koju tablicu ce gledat moras mu to rec u auth.php
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => 'admin'])) {
            return redirect()->route('admin.login')->with(['fail' => 'Login failed']);
        }

        return redirect()->route('admin.dashboard');
    }

    public function saveChanges (Request $request) {

        if (isset($request['user'])) {

            $this->validate($request, [
                'email' => 'email|required',
                'role' => 'required'
            ]);


            $user = users::where('id', $request['id'])->first();
            $user->email = $request['email'];
            $user->role = $request['role'];
            $user->status = $request['status'];
            $user->save();

            foreach ($user->classes as $class) {
                DB::table('users_classes')
                    ->where('users_id', $user->id)
                    ->where('classes_id', $class->id)
                    ->update(['status' => $request[$class->id]]);
            }
        }

        if (isset($request['class'])) {

            $this->validate($request, [
                'name' => 'required',
                'ECTS' => 'numeric',
                'classCode' => 'required|max:3',
                'semRedovni' => 'numeric',
                'semVaredni' => 'numeric',
                'izborni' => 'required'
            ]);

            $class = classes::where('id', $request['id'])->first();
            $class->name = $request['name'];
            $class->ECTS = $request['ECTS'];
            $class->classCode = $request['classCode'];
            $class->semRedovni = $request['semRedovni'];
            $class->semVanredni = $request['semVanredni'];
            $class->izborni = $request['izborni'];
            $class->program = $request['program'];
            $class->save();
        }
        return redirect()->route('admin.dashboard');
    }
}
