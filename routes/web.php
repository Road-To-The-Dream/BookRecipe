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

Route::resource('recipe', 'RecipeController');

Route::resource('ingredient', 'IngredientController');

Route::patch('ingredient/update-amount/{ingredientId}', 'IngredientController@updateAmount')->name('ingredient.updateAmount');