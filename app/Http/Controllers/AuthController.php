<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{

    public function login(Request $request) {
        
        if(session('user_id')) {
            return redirect('/dashboard');
        }

        if($request->submit) {
            $email = $request->email;
            $pwd = $request->pwd;
            $checkUser = DB::table('students')->where('email',$email)->where('pwd',$pwd);
            if($checkUser->count()==1)
            {
                $user = $checkUser->first();
                // echo '<pre>';
                // print_r($user); die;
                session(['user_id' => $user->id]);
                return redirect('/dashboard');
            }
        }
        return view('login');
    }


    public function dashboard() {

        if(!session('user_id')) {
            return redirect('/login');
        }
        // echo session('user_id');
        return view('dashboard');
    }


    public function logout(Request $request) {

        if(!session('user_id')) {
            return redirect('/login');
        }
        $request->session()->forget('user_id');
        return redirect('/login');
    }

}