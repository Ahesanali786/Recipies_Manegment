<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function home()
    {
        // Fetch all recipes with their reviews
        $recipes = Recipe::with('reviews')->get();
        return view('home', compact('recipes'));
    }
    public function store(Request $request, $recipeId)
    {
        $recipe = Recipe::find($recipeId);

        if ($recipe) {
            Review::create([
                'recipe_id' => $recipe->id,
                'user_id' => $request->user()->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect('home')->with('success', 'Review added successfully.');
        } else {
            return redirect()->back()->with('error', 'Recipe not found.');
        }
    }

}
