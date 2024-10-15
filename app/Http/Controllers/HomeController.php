<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth::guard('web')->user()->role;


            if ($usertype === 'admin') {

                return redirect('dashboard');
            } elseif ($usertype === 'user') {

                $recipes = Recipe::all();
                return view('home', compact('recipes'));
            }
        }

        return redirect()->back()->with('error', 'Something Went Wrong');
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
