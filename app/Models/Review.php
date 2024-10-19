<?php

// app/Models/Review.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Review belongs to one Recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Review belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
