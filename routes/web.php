<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Review;

// use App\Http\Controllers\UserController;


Route::get('logout', [HomeController::class, 'logout']);


Route::get('/category-add', function () {
    return view('category-add');
});
Route::view('recipe-list', 'recipe-list');
Route::view('category-list', 'category-list');
Route::view('recipe-add', 'recipe-add');
// Route::view('user/user-show', 'user/user-show');
Route::view('admin_review', 'admin_review');
// Route::view('user/profile', 'user/profile');
Route::view('profile.edit', 'profile.edit');
Route::view('review', 'review');
Route::view('explore', 'explore');
Route::view('profile/show' , 'profile/show');


Route::get('/home', [HomeController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);

Route::get('/recipes', [RecipeController::class, 'addrcp'])->name('recipes.index');
Route::get('/recipe-add', [RecipeController::class, 'index']);
Route::post('/recipe-add', [RecipeController::class, 'addRecipe']);
// Route::get('/recipe-list', [RecipeController::class, 'showList']);
Route::get('/recipe-list', [RecipeController::class, 'showList'])->name('recipes.list');

Route::get('/recipe-edit/{id}', [RecipeController::class, 'editRecipe']);
Route::post('/recipe-edit/{id}', [RecipeController::class, 'updateRecipe']);
Route::get('/recipe-delete/{id}', [RecipeController::class, 'deleteRecipe']);
// Route::delete('/recipe-delete/{id}', [RecipeController::class, 'deleteRecipe']);



Route::post('/category-add', [CategoryController::class, 'addCategory']);
Route::get('/category-list', [CategoryController::class, 'showCategory']);

Route::get('/category-edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category-edit/{id}', [CategoryController::class, 'update']);

Route::get('/category-delete/{id}', [CategoryController::class, 'delete']);
Route::delete('/recipe-bulk-delete', [RecipeController::class, 'bulkDelete']);
Route::get('/recipe-show/{id}', [RecipeController::class, 'showRecipe']);

//USER
Route::post('/user-add', [RecipeController::class, 'useraddRecipe']);
Route::get('user/user-show/{id}', [RecipeController::class, 'onlyUserShow']);

Route::get('/home', [ReviewController::class, 'home']);
Route::post('/home', [RecipeController::class, 'homeRecipe']);
Route::post('/recipe/{recipe}/review', [ReviewController::class, 'store'])->name('review.store');

//like
// routes/web.php

Route::post('/recipes/{id}/favorite', [RecipeController::class, 'toggleFavorite'])->name('favorites.toggle');

Route::get('/favorite-recipes', [RecipeController::class, 'showFavoriteRecipes'])->name('favorite.recipes');


// Profile
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// Route::get('/profile/{id}', [ProfileController::class, 'show']);


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('profiles/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profiles/update-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

// user profile viewing
// Route for showing the user profile
Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.show');




// reviews
Route::get('/show-reviews/{id}', [RecipeController::class, 'showreviews']);
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
Route::get('/review/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
Route::get('/review/data', [ReviewController::class, 'getReviews'])->name('review.data');




Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login']);

    Route::get('/', function () {
        return view('register');
    });
    Route::view('login', 'login');
});



// Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
// Route::post('/unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');



// Route to show the edit profile form
// Route::get('/profile-edit/{id}', [profileController::class, 'edit']);

// Route to handle the profile update
// Route::post('/profile-edit/{id}', [profileController::class, 'update']);


Route::get('/explore', [RecipeController::class, 'explore'])->name('explore.recipes');


// recipe pin
Route::post('/recipe/{id}/pin', [RecipeController::class, 'pinRecipe'])->name('recipe.pin');

