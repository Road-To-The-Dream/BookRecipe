<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
use App\Services\Recipes;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('home', [
            'recipes' => Recipe::all()
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
     * @param RecipeRequest $request
     * @param Recipes $recipeService
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request, Recipes $recipeService)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([
                $request->get('recipeName'),
                $request->get('description')
            ]);

            $newRecipe = Recipe::create(["name" => $input[0], "description" => $input[1]]);
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) ///photos/{photo}/edit
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) ///photos/{photo}
    {
        //
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
