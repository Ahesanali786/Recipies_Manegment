<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RecipeController extends Controller
{


    public function index()
    {
        $categories = Category::all();

        return view('recipe-add', compact('categories'));
    }
    public function showList()
    {
        $recipes = Recipe::all();
        return view('recipe-list', compact('recipes'));
    }

    public function addRecipe(Request $request)
    {
        try {
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

            return redirect('recipe-list')->with('success', 'Recipe added successfully.');
        } catch (\Exception $e) {
            return redirect('recipe-add')->with('error', 'Failed to add recipe.');
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


    public function deleteRecipe($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete(); // This will automatically delete ingredients due to cascade delete

        if (Auth::user()->role == 'admin') {
            return redirect('recipe-list')->with('success', 'Recipe Delete successfully.');
        } else {
            return redirect('profile')->with('success', 'Recipe Delete successfully.');
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
}
