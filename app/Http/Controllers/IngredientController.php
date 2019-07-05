<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientCreateRequest;
use App\Http\Requests\IngredientUpdateAmountRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Ingredient::pluck('name', 'id')->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param IngredientCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientCreateRequest $request)
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
     * @param IngredientUpdateAmountRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateAmount(IngredientUpdateAmountRequest $request, $id)
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
