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
use App\Http\Middleware\Adminmiddelware;
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
Route::view('user/user-show', 'user/user-show');
Route::view('admin_review', 'admin_review');
Route::view('user/profile', 'user/profile');
Route::view('profile-edit', 'profile-edit');

// Route::middleware([Adminmiddelware::class])->group(function () {
//     Route::post('/register', [RegisterController::class, 'register']);
//     Route::post('/login', [RegisterController::class, 'login']);

//     Route::get('/', function () {
//         return view('register');
//     });
//     Route::view('login', 'login');
// });


// Route::get('/home', [HomeController::class, 'index']);


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
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/{id}', [ProfileController::class, 'showUserProfile']);

// user profile viewing
// Route for showing the user profile
Route::get('profile/{id}', [UserController::class, 'showProfile']);



// reviews
Route::get('/show-reviews/{id}', [RecipeController::class, 'showreviews']);
// Route::get('/admin/reviews', [RecipeController::class, 'showAdminReviews'])->name('admin.reviews');




Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login']);

    Route::get('/', function () {
        return view('register');
    });
    Route::view('login', 'login');
});



Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
Route::post('/unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');



// Route to show the edit profile form
Route::get('/profile-edit/{id}', [profileController::class, 'edit']);

// Route to handle the profile update
Route::post('/profile-edit/{id}', [profileController::class, 'update']);
