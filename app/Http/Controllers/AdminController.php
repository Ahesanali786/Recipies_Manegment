<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

public function dashboard()
{
    if (Auth::id()) {
        $usertype = Auth::guard('web')->user()->role;


        if ($usertype === 'admin') {

            return view('dashboard');

        } elseif ($usertype === 'user') {

            return redirect('home');
        }
    }

    return redirect()->back()->with('error', 'Something Went Wrong');

}
}
