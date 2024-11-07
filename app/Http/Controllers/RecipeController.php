<?php

namespace App\Http\Controllers;

use App\Mail\ShareRecipe;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



class RecipeController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        $units = Units::all();

        return view('recipe-add', compact('categories', 'units'));
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
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation_time' => 'required|string',
            'cooking_time' => 'required|string',
            'servings' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name.*' => 'required|string',
            'quantity.*' => 'required|integer',
        ]);

        DB::beginTransaction(); // Start the transaction
        try {
            $existingRecipe = Recipe::where('title', $request->title)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingRecipe) {
                return redirect('recipe-add')->with('error', 'You have already added a recipe with this title.');
            }

            $recipe = new Recipe();
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->preparation_time = $request->preparation_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->servings = $request->servings;
            $recipe->category_id = $request->category_id;
            $recipe->user_id = Auth::id();

            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('webimg'), $imageName);
                $recipe->image = $imageName;
            }
            $recipe->save();

            $ingredient_arr = [];
            foreach ($request->name as $index => $name) {
                $ingredient_arr[$index] = [
                    'name' => $name,
                    'quantity' => (int) $request->quantity[$index],
                    'recipe_id' => $recipe->id,
                    'unit_id' => $request->unit_id[$index]
                ];
            }
            // dd($recipe);
            Ingredient::insert($ingredient_arr);
            DB::commit(); // Commit the transaction

            return redirect('recipe-list')->with('success', 'Recipe added successfully.');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback on error
            dd($e);
            return redirect('recipe-add')->with('error', 'Failed to add recipe: ' . $e->getMessage());
        }
    }



    public function editRecipe($id)
    {
        $recipe = Recipe::with('ingredients')->find($id); // Adjusted to load the associated unit for each ingredient
        $categories = Category::all();
        $units = Units::all();

        // dd($recipe->ingredients[0]->unit_id);
        return view('recipe-edit', compact('recipe', 'categories',  'units'));
    }


    public function updateRecipe(Request $request, $id)
    {
        // dd($request->all());
        DB::beginTransaction(); // Start the transaction
        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return redirect('recipe-list')->with('error', 'Recipe not found.');
            }

            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->preparation_time = $request->preparation_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->servings = $request->servings;
            $recipe->category_id = $request->category_id;

            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('webimg'), $imageName);
                $recipe->image = $imageName;
            }

            $recipe->save();

            // Delete old ingredients
            Ingredient::where('recipe_id', $recipe->id)->delete();

            $ingredient_arr = [];
            foreach ($request->name as $index => $name) {
                $ingredient_arr[$index] = [
                    'name' => $name,
                    'quantity' => (int) $request->quantity[$index],
                    'recipe_id' => $recipe->id,
                    'unit_id' => $request->unit_id[$index] // Adjusted to use the unit_id from the request instead of loading them from the database again.
                ];
            }
            Ingredient::insert($ingredient_arr);
            DB::commit(); // Commit the transaction

            if (Auth::user()->role == 'admin') {
                return redirect('recipe-list')->with('success', 'Recipe updated successfully.');
            } else {
                return redirect('profile')->with('success', 'Recipe updated successfully.');
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback(); // Rollback on error
            return redirect('recipe-edit/' . $id)->with('error', 'Failed to update recipe: ' . $e->getMessage());
        }
    }
    public function deleteRecipe($id, Request $request)
    {
        try {
            // Retrieve the recipe with soft delete enabled
            $recipe = Recipe::findOrFail($id);

            // Soft delete the recipe
            $recipe->delete();
            // Set a flag for the popup to be shown for 5 seconds
            session()->flash('recently_deleted', $recipe->id);

            // Redirect for non-AJAX requests
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
            // Handle errors, including recipe not found or delete failure
            if ($request->ajax()) {
                return response()->json(['error' => 'Error deleting recipe: ' . $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Error deleting recipe: ' . $e->getMessage());
        }
    }
    public function restoreRecipe($id)
    {
        try {
            $recipe = Recipe::withTrashed()->findOrFail($id);


            $recipe->restore();


            if (Auth::user()->role == 'admin') {
                return redirect('recipe-list')->with('success', 'Recipe restored successfully.');
            } else {
                return redirect('profile')->with('success', 'Recipe restored successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error restoring recipe: ' . $e->getMessage());
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
        $recipe = Recipe::with('category', 'ingredients.units')->find($id);
        // dd($recipe);

        return view('recipe-show', compact('recipe'));
    }

    public function onlyUserShow($id)
    {
        // Find the recipe by its ID with the related category and ingredients
        $recipe = Recipe::with('category', 'ingredients')->find($id);
        $units = Units::all();
        // dd($recipe);


        // Pass the recipe data to the view
        return view('recipe-show', compact('recipe', 'units'));
    }
    public function homeRecipe(Request $request)
    {
        try {
            $existingRecipe = Recipe::where('title', $request->title)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingRecipe) {
                return redirect('recipe-add')->with('error', 'You have already added a recipe with this title.');
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
                    'unit_id' => $request->unit_id[$index]

                ];
            }

            // Insert all ingredients at once
            Ingredient::insert($ingredient_arr);
            return redirect('profile')->with('success', 'Recipe added successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect('recipe-add')->with('error', 'Failed to add recipe.');
        }
    }
    // public function showreviews($id)
    // {
    //     $recipe = Recipe::findOrFail($id);
    //     return view('show-reviews', compact('recipe'));
    // }

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

        // Query categories with their recipes, filtering recipes by title or user's name if a search term is provided
        $categories = Category::with(['recipes' => function ($query) use ($search) {
            if ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    });
            }
        }, 'recipes.user', 'recipes.favorites'])
            ->get();

        return view('explore', compact('categories'));
    }

    public function pinRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Ensure the logged-in user is the owner of the recipe
        if (Auth::user()->id !== $recipe->user_id) {
            return redirect()->back()->with('error', 'You can only pin your own recipes.');
        }

        // Toggle the 'pinned' status
        $recipe->pinned = !$recipe->pinned;
        $recipe->save();

        return redirect()->back()->with('success', $recipe->pinned ? 'Recipe pinned successfully!' : 'Recipe unpinned.');
    }
    public function downloadRecipePdf($id)
    {
        // Recipe ka data retrieve karein
        $recipe = Recipe::findOrFail($id);
        $units = Units::all();

        // PDF ke liye ek view ko load karein
        $pdf = Pdf::loadView('recipes.pdf', compact('recipe', 'units'))
            ->setPaper('a4'); // Set the paper size to A4

        // PDF ko download karein
        return $pdf->download('recipe.pdf');
    }
}
