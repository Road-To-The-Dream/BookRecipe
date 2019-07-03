<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\Utility;
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
    public function create(): View ///photos/create
    {
        return view('recipe.create', [
            'ingredients' => Ingredient::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * @param RecipeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request) //	/photos
    {
        if ($request->ajax()) {
            $input = Utility::stripXSS([
                $request->get('recipeName'),
                $request->get('description')
            ]);

            $ingredients = [];
            for ($i = 1; $i <= $request->all(); $i++) {
                if (empty($request->get('ingredient-' . $i))) {
                    break;
                } else {
                    array_push($ingredients, (int)$request->get('ingredient-' . $i));
                }
            }

            foreach ($request->get('amount') as $key => $value) {
                $rules['amount.' . $key] = ['amount' => 1]; // you can set rules for all the array items
            }

            $new_recipe = Recipe::create(["name" => $input[0], "description" => $input[1]]);

            $ingredients = [9, 10];
            $amounts = [112, 113];

            $new_recipe->ingredients()->sync([
                1 => ['amount' => 1],
                2 => ['amount' => 1],
                3 => ['amount' => 1]
            ]);
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
    public function show($id) ///photos/{photo}
    {
        //
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
        $recipe = Recipe::find($id);

        if ($recipe) {
            $destroy = Recipe::destroy($id);
        }

        if ($destroy) {
            session()->flash('message', 'Рецепт успешно удалён, success');
        } else {
            session()->flash('message', 'Рецепт не удалён, error');
        }
    }
}
