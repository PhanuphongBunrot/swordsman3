<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginedController extends Controller
{
    public function login(Request $request)
    {
        // print_r($request->post());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        $hardcodedEmail = 'user@g.com';
        $hardcodedPassword = '123456789';

       
        if ($request->email === $hardcodedEmail && $request->password === $hardcodedPassword) {
          
            Session::put('authenticated', true);

           
            return redirect()->route('home');
        }

        return response()->json(['status' => false], 200);
    }

    public function logout()
    {
        Session::forget('authenticated');

        return redirect('/login');
    }
}
