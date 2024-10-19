<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

public function dashboard()
{
    if (Auth::id()) {
        $usertype = Auth::guard('web')->user()->role;


        if ($usertype === 'admin') {

            $users = User::all()->count();
            $recipes = Recipe::all()->count();
            $ingredients = Ingredient::all()->count();
            $category = Category::all()->count();
            $reviews = Review::all()->count();
            return view('dashboard', compact('users', 'recipes', 'ingredients', 'category', 'reviews'));

            return view('dashboard');

        } elseif ($usertype === 'user') {

            return redirect('home');
        }
    }

    return redirect()->back()->with('error', 'Something Went Wrong');

}
}
