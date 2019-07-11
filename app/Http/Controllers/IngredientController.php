<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientAmount;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
use Illuminate\View\View;

class IngredientController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('ingredient.show', [
            'ingredients' => Ingredient::all()
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('ingredient.create');
    }

    /**
     * @param StoreIngredientRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientRequest $request)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField($request->all());

            Ingredient::create(['name' => $input['ingredientName']]);
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);

        return view('ingredient.update', [
            'ingredient' => $ingredient
        ]);
    }

    /**
     * @param UpdateIngredientRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientRequest $request, $id)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([
                $request->get('ingredientName')
            ]);

            $ingredient = Ingredient::find($id);
            $ingredient->update(['name' => $input[0]]);
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        if (Ingredient::find($id) && Ingredient::destroy($id)) {
            session()->flash('message-destroy-ingredient', 'Ингредиент успешно удалён!');

            return;
        }
        session()->flash('message-destroy-ingredient', 'Ингредиент не удалён!');
    }

    /**
     * @param UpdateIngredientAmount $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateAmount(UpdateIngredientAmount $request, $id)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([$request->get('ingredientAmount')]);

            $recipeId = Recipe::find($request->get('recipeId'));
            $recipeId->ingredients()->where('ingredient_id', $id)->update(['amount' => $input[0]]);
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return Ingredient::pluck('name', 'id')->toArray();
    }
}
