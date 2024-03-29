<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name'
    ];

    public function recipes()
    {
        $this->belongsToMany(Recipe::class, 'recipes_ingredients');
    }
}
