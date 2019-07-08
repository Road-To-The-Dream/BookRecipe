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
     * @param $request
     * @return array
     */
    public function formingIngredientsArray($request): array
    {
        $ingredientsId = [];
        for ($i = 1; $i <= count($request->request); $i++) {
            if (empty($request->get('ingredient-' . $i))) {
                continue;
            } else {
                array_push($ingredientsId, (int)$request->get('ingredient-' . $i));
            }
        }

        return $ingredientsId;
    }

    /**
     * @param $request
     * @param $ingredients
     * @return array
     */
    public function formingIngredientsInfoArray($request, $ingredients): array
    {
        $recipesIngredients = [];
        for ($i = 0; $i < count($ingredients); $i++) {
            $recipesIngredients[$ingredients[$i]] = ['amount' => $request->get('amount')[$i]];
        }

        return $recipesIngredients;
    }
}
