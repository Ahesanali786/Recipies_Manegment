<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recipe;


class UserController extends Controller
{
    public function showProfile($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        $recipes = Recipe::where('user_id', $id)->get();

        // Pass the user data to the profile view
        return view('profile', compact('user', 'recipes'));
    }
}
