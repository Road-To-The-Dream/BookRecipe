<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param UpdateIngredientRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateAmount(UpdateIngredientRequest $request, $id)
    {
        if ($request->ajax()) {
            $input = Utility::cleanField([$request->get('ingredientAmount')]);

            $recipeId = Recipe::find($request->get('recipeId'));
            $recipeId->ingredients()->where('ingredient_id', $id)->update(['amount' => $input[0]]);
        } else {
            return response()->view('errors.403', [], 403);
        }
    }
}
