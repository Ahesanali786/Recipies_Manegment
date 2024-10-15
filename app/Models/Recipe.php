<?php

// app/Models/Recipe.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use App\Models\Like;
use App\Models\Dislike;


class Recipe extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'preparation_time', 'cooking_time', 'servings', 'category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function isOwnedBy(User $user)
    {
        return $this->user_id === $user->id;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); // Replace 'favorites' with your actual pivot table name
    }
}
