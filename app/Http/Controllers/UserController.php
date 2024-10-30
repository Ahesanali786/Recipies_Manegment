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
        return route('profile.index', compact('user', 'recipes'));
    }
    public function index()
    {
        // Retrieve all users
        $users = User::all();

        // Pass users to the view
        return view('users.index', compact('users'));
    }
    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return redirect()->back()->with('status', 'User status updated successfully.');
    }
}
