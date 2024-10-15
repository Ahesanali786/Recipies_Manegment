<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [

        'name',
        'email',
        'password',
        'role',
    ];

    // One User has many Recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // One User has many Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function favoritedRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'favorites')->withTimestamps(); // Replace 'favorites' with your actual pivot table name
    }
}
