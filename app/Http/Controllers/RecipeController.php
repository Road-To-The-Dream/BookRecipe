<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //	/photos
    {
        //
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
