<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

            return redirect()->back()->with('success', 'Review added successfully.');
        } else {
            return redirect()->back()->with('error', 'Recipe not found.');
        }
    }

    public function index()
    {
        return view('review'); // Change this to your Blade view for reviews
    }

    public function getReviews()
    {
        // Fetch reviews with associated users and recipes
        $reviews = Review::with(['user', 'recipe.category'])->get();

        return DataTables::of($reviews)
            ->addColumn('action', function ($review) {
                return '<a href="' . url('review/delete/' . $review->id) . '" onclick="return confirm(\'Are you sure you want to delete this review?\')">
                            <i class="fas fa-trash" style="color: red; margin-left:10px; font-size:20px;"></i>
                        </a>';
            })
            ->editColumn('rating', function ($review) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $review->rating) {
                        $stars .= '<i class="fas fa-star" style="color: gold;"></i>';
                    } else {
                        $stars .= '<i class="far fa-star" style="color: lightgray;"></i>';
                    }
                }
                return $stars; // Return the star HTML
            })
            ->rawColumns(['rating', 'action']) // Allow raw HTML for these columns
            ->make(true);
    }

    public function destroy($reviewId){
        $review = Review::find($reviewId);

        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Review not found.');
        }
    }
}
