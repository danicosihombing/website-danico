<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    function register(){
        return view("sesi/register");
    }

    function registeruser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'contact' => 'required|string|unique:users',
            'password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'password' => Hash::make($request->input('password')),
        ]);

        return view("sesi/registrasi_success");
    }

    function login(){
        return view("sesi/login");
    }

    function loginuser(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infologin)){
            $user = User::where('email', $request->email)->first();
            return view('sesi/dashboard', compact('user'));
        } else {
            return redirect()->route("/login");
        }
    }

    function logout(){
        return redirect('/login');
    }

    function delete(Request $request)
{
    $loggedInUser = Auth::user();

    if ($loggedInUser) {
        $loggedInUser->delete();

        return view("sesi/login");
    } else {
        return view('sesi/dashboard');
    }
}

function update()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in.');
        }

        return view('sesi.update', compact('user'));
    }

    function updateForm(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
        ]);

        return view("sesi/login");
    }

}
