<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
use App\Services\Recipes;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('home', [
            'recipes' => Recipe::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('recipe.create', [
            'ingredients' => Ingredient::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * @param StoreRecipeRequest $request
     * @param Recipes $recipeService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request, Recipes $recipeService)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([
                $request->get('recipeName'),
                $request->get('recipeDescription')
            ]);

            $newRecipe = Recipe::create(['name' => $input[0], 'description' => $input[1], 'user_id' => Auth::id()]);
            $newRecipe->ingredients()->sync(
                $recipeService->formingIngredientsInfoArray($request, $recipeService->formingIngredientsArray($request))
            );
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        return view('recipe.show', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients()->get()
        ]);
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $recipe = Recipe::find($id);

        return view('recipe.update', [
            'recipe' => $recipe,
            'recipesIngredients' => $recipe->ingredients()->get(),
            'ingredients' => Ingredient::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * @param UpdateRecipeRequest $request
     * @param $id
     * @param Recipes $recipeService
     * @return bool|\Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, $id, Recipes $recipeService)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([
                $request->get('recipeName'),
                $request->get('recipeDescription'),
            ]);

            $recipe = Recipe::find($id);
            $recipe->update(['name' => $input[0], 'description' => $input[1]]);
            $recipe->ingredients()->sync(
                $recipeService->formingIngredientsInfoArray($request, $recipeService->formingIngredientsArray($request))
            );

            return true;
        }

        return response()->view('errors.403', [], 403);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        if (Recipe::find($id) && Recipe::destroy($id)) {
            session()->flash('message-destroy-recipe', 'Рецепт успешно удалён!');

            return;
        }
        session()->flash('message-destroy-recipe', 'Рецепт не удалён!');
    }
}
