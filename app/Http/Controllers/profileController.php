<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $recipes = Recipe::where('user_id', $user->id)->get();
        return view('profile', compact('user', 'recipes'));
    }
}
