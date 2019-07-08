<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipes_ingredients')->withPivot('amount');
    }
}
