<?php

// app/Models/Ingredient.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'recipe_id',
    ];

    // Ingredient belongs to one Recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

