<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name'];

    // One Category has many Recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}


