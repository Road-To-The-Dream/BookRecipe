<?php

namespace App\Services;

use App\Http\Requests\StoreRecipeRequest;

/**
 * Class Recipes
 * @package App\Services
 */
class Recipes
{
    /**
     * @param StoreRecipeRequest $request
     * @return array
     */
    public function formingIngredientsArray(StoreRecipeRequest $request): array
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
     * @param StoreRecipeRequest $request
     * @param $ingredients
     * @return array
     */
    public function formingIngredientsInfoArray(StoreRecipeRequest $request, $ingredients): array
    {
        $recipesIngredients = [];
        for ($i = 0; $i < count($ingredients); $i++) {
            $recipesIngredients[$ingredients[$i]] = ['amount' => $request->get('amount')[$i]];
        }

        return $recipesIngredients;
    }
}
