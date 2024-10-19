<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class RecipeController extends Controller
{


    public function index()
    {
        $categories = Category::all();

        return view('recipe-add', compact('categories'));
    }
    // public function showList()
    // {
    //     $recipes = Recipe::all();
    //     return view('recipe-list', compact('recipes'));
    // }

    public function showList(Request $request)
    {
        if ($request->ajax()) {
            $recipes = Recipe::with('category')->select('recipes.*');
            return DataTables::of($recipes)
                ->addColumn('action', function ($row) {
                    if (Auth::check() && Auth::user()->role == 'admin') {
                        $editBtn = '<a href="/recipe-edit/' . $row->id . '"><i class="fas fa-edit" style="color: rgb(5, 138, 129); font-size:20px;"></i></a>';
                        $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-btn"><i class="fas fa-trash" style="color: red; font-size:20px;"></i></a>';
                        return $editBtn . ' ' . $deleteBtn;
                    }
                    return '';
                })
                ->addColumn('select', function ($row) {
                    if (Auth::check() && Auth::user()->role == 'admin') {
                        return '<input type="checkbox" name="selected[]" value="' . $row->id . '" class="selectRecipe">';
                    }
                    return '';
                })
                ->rawColumns(['action', 'select'])
                ->make(true);
        }

        return view('recipe-list');
    }

    public function addRecipe(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation_time' => 'required|string',
            'cooking_time' => 'required|string',
            'servings' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as necessary
            'name.*' => 'required|string',
            'quantity.*' => 'required|integer', // Ensure quantities are required and integers
        ]);

        try {
            // Check if the recipe with the same title already exists for the logged-in user
            $existingRecipe = Recipe::where('title', $request->title)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingRecipe) {
                return redirect('recipe-add')->with('success', 'You have already added a recipe with this title.');
            }

            $recipe = new Recipe();
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->preparation_time = $request->preparation_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->servings = $request->servings;
            $recipe->category_id = $request->category_id;
            $recipe->user_id = Auth::id(); // Set the user_id to the current logged-in user

            $image = $request->file('image');

            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Ensure the image is uploaded to the correct folder
                $image->move(public_path('webimg'), $imageName);
                $recipe->image = $imageName;
            }

            $recipe->save();

            // Add Ingredients
            $ingredient_arr = []; // Initialize the ingredients array

            foreach ($request->name as $index => $name) {
                $ingredient_arr[$index] = [ // Populate the array
                    'name' => $name,
                    'quantity' => (int) $request->quantity[$index], // Cast quantity to int
                    'recipe_id' => $recipe->id, // Associate with the recipe
                ];
            }

            // Insert all ingredients at once
            Ingredient::insert($ingredient_arr);

            return redirect('recipe-list')->with('success', 'Recipe added successfully.');
        } catch (\Exception $e) {
            return redirect('recipe-add')->with('error', 'Failed to add recipe: ' . $e->getMessage());
        }
    }



    public function editRecipe($id)
    {
        $recipe = Recipe::with('ingredients')->find($id);
        $categories = Category::all();

        return view('recipe-edit', compact('recipe', 'categories'));
    }

    public function updateRecipe(Request $request, $id)
    {
        try {
            $recipe = Recipe::find($request->id);
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->preparation_time = $request->preparation_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->servings = $request->servings;
            $recipe->category_id = $request->category_id;
            $image =  $request->image;

            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('webimg', $imageName);
                $recipe->image = $imageName;
            }
            $recipe->save();

            // Delete old ingredients
            Ingredient::where('recipe_id', $recipe->id)->delete();

            $ingredient_arr = []; // Initialize the ingredients array

            foreach ($request->name as $index => $name) {
                $ingredient_arr[$index] = [ // Populate the array
                    'name' => $name,
                    'quantity' => (int) $request->quantity[$index], // Cast quantity to int
                    'recipe_id' => $recipe->id, // Associate with the recipe
                ];
            }

            // Insert all ingredients at once
            Ingredient::insert($ingredient_arr);
            if (Auth::user()->role == 'admin') {
                return redirect('recipe-list')->with('success', 'Recipe updated successfully.');
            } else {
                return redirect('profile')->with('success', 'Recipe updated successfully.');
            }
            // return redirect('recipe-list')->with('success', 'Recipe updated successfully.');
        } catch (\Exception $e) {
            return redirect('recipe-edit')->with('error', 'Failed to update recipe.');
        }
    }


    // public function deleteRecipe($id)
    // {
    //     $recipe = Recipe::find($id);
    //     $recipe->delete(); // This will automatically delete ingredients due to cascade delete

    //     if (Auth::user()->role == 'admin') {
    //         return redirect('recipe-list')->with('success', 'Recipe Delete successfully.');
    //     } else {
    //         return redirect('profile')->with('success', 'Recipe Delete successfully.');
    //     }
    // }
    public function deleteRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);

        // Check if the recipe exists
        if (!$recipe) {
            // Handle recipe not found
            if ($request->ajax()) {
                return response()->json(['error' => 'Recipe not found.'], 404);
            }

            return redirect()->back()->with('error', 'Recipe not found.');
        }

        try {
            $recipe->delete(); // This will automatically delete related ingredients if set up correctly

            // Handle redirect for non-AJAX requests
            if (!$request->ajax()) {
                if (Auth::user()->role == 'admin') {
                    return redirect('recipe-list')->with('success', 'Recipe deleted successfully.');
                } else {
                    return redirect('profile')->with('success', 'Recipe deleted successfully.');
                }
            }

            // Handle AJAX request response
            return response()->json(['success' => 'Recipe deleted successfully.']);
        } catch (\Exception $e) {
            // Handle error during deletion
            if ($request->ajax()) {
                return response()->json(['error' => 'Error deleting recipe: ' . $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Error deleting recipe: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $selected = $request->input('selected');

        if (!empty($selected)) {
            Recipe::whereIn('id', $selected)->delete(); // Deletes the selected recipes
            return redirect('recipe-list')->with('success', 'Selected recipes deleted successfully.');
        }

        return redirect('recipe-list')->with('error', 'No recipes selected for deletion.');
    }
    public function showRecipe($id)
    {
        // Find the recipe by its ID with the related category and ingredients
        $recipe = Recipe::with('category', 'ingredients')->find($id);
        // dd($recipe);
        // Pass the recipe data to the view

        return view('recipe-show', compact('recipe'));
    }

    public function onlyUserShow($id)
    {
        // Find the recipe by its ID with the related category and ingredients
        $recipe = Recipe::with('category', 'ingredients')->find($id);
        // dd($recipe);


        // Pass the recipe data to the view
        return view('recipe-show', compact('recipe'));
    }
    public function homeRecipe(Request $request)
    {
        try {
            $existingRecipe = Recipe::where('title', $request->title)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingRecipe) {
                return redirect('recipe-add')->with('success', 'You have already added a recipe with this title.');
            }
            $recipe = new Recipe();
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->preparation_time = $request->preparation_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->servings = $request->servings;
            $recipe->category_id = $request->category_id;
            $recipe->user_id = Auth::id(); // Set the user_id to the current logged-in user

            $image = $request->file('image');

            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Ensure the image is uploaded to the correct folder
                $image->move(public_path('webimg'), $imageName);
                $recipe->image = $imageName;
            }
            // dd($recipe->image);

            $recipe->save();

            // Add Ingredients
            $ingredient_arr = []; // Initialize the ingredients array

            foreach ($request->name as $index => $name) {
                $ingredient_arr[$index] = [ // Populate the array
                    'name' => $name,
                    'quantity' => (int) $request->quantity[$index], // Cast quantity to int
                    'recipe_id' => $recipe->id, // Associate with the recipe
                ];
            }

            // Insert all ingredients at once
            Ingredient::insert($ingredient_arr);
            return redirect('home')->with('success', 'Recipe added successfully.');
        } catch (\Exception $e) {
            return redirect('recipe-add')->with('error', 'Failed to add recipe.');
        }
    }
    public function showreviews($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('show-reviews', compact('recipe'));
    }

    public function toggleFavorite($id)
    {
        $recipe = Recipe::findOrFail($id);
        $user = Auth::user();

        // Toggle favorite
        if ($recipe->favorites()->where('user_id', $user->id)->exists()) {
            $recipe->favorites()->detach($user); // Unfavorite
        } else {
            $recipe->favorites()->attach($user); // Favorite
        }

        // Get updated count of favorites
        $favoritesCount = $recipe->favorites()->count();
        $isFavorited = $recipe->favorites()->where('user_id', $user->id)->exists();

        return response()->json([
            'isFavorited' => $isFavorited,
            'favoritesCount' => $favoritesCount
        ]);
    }
    public function showFavoriteRecipes()
    {
        // Assuming the relationship is set up in User model
        $favoriteRecipes = Auth::user()->favoritedRecipes; // Adjust this line based on your relationship name

        return view('favorite-recipes', compact('favoriteRecipes'));
    }
    public function explore(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::with('recipes.user', 'recipes.favorites')->get();

        // If you want to filter recipes based on search
        if ($search) {
            foreach ($categories as $category) {
                $category->recipes = $category->recipes->filter(function ($recipe) use ($search) {
                    return str_contains($recipe->title, $search);
                });
            }
        }

        return view('explore', compact('categories'));
    }
}
