<?php

namespace App\Services;

use App\Http\Requests\RecipeRequest;

/**
 * Class Recipes
 * @package App\Services
 */
class Recipes
{
    /**
     * @param RecipeRequest $request
     * @return array
     */
    public function formingIngredientsArray(RecipeRequest $request): array
    {
        $ingredientsId = [];
        for ($i = 1; $i <= $request->all(); $i++) {
            if (empty($request->get('ingredient-' . $i))) {
                break;
            } else {
                array_push($ingredientsId, (int)$request->get('ingredient-' . $i));
            }
        }

        return $ingredientsId;
    }

    /**
     * @param RecipeRequest $request
     * @param $ingredients
     * @return array
     */
    public function formingIngredientsInfoArray(RecipeRequest $request, $ingredients): array
    {
        $recipesIngredients = [];
        for ($i = 0; $i < count($ingredients); $i++) {
            $recipesIngredients[$ingredients[$i]] = ['amount' => $request->get('amount')[$i]];
        }

        return $recipesIngredients;
    }
}
