<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\classes;
use App\users;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function getHome () {
        return view('home');
    }

    public function getClasses ($classCode = null) {

        $classes = classes::all();

        if ($classCode != null) {
            $selectedClass = classes::where('classCode', $classCode)->first();
        } else {
            $selectedClass = null;
        }
        return view('classes', ['classes' => $classes, 'selectedClass' => $selectedClass]);
    }

    public function getLogin() {
        return view ('login');
    }

    public function getLogout () {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getRegister () {
        return view('register');
    }

    public function postRegister (Request $request) {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|same:repeat'
        ]);

        $user = new users;
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role = 'student';
        $user->save();

        return redirect()->route('login');
    }

    public function postLogin (Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->back()->with(['fail' => 'Do you even exist ?']);
        } else {
            $user = users::where('email', $request['email'])->first();
            if ($user->role == 'student') {
                return redirect()->route('student.home');
            } elseif ($user->role == 'mentor') {
                return redirect()->route('mentor.home');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->with(['fail' => 'Silly admin !! Pls use this login for your admin shenanigans ...', 'email' => 'admin']);
            }
        }
    }
}
