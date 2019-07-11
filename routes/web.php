<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('recipe', 'RecipeController')->middleware('auth');

Route::get('get-all-recipes', 'RecipeController@getRecipes')->middleware('auth');

Route::resource('ingredient', 'IngredientController');

Route::patch('ingredient/update-amount/{ingredientId}', 'IngredientController@updateAmount')->name('ingredient.updateAmount');

Route::get('all-ingredients', 'IngredientController@getIngredients');