@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-3 mt-3">
                <div class="row">
                    <div class="col menu">
                        <a href="/home"><img class="mr-3" src="{{ asset('img/ingredients.png') }}" alt="">Мои рецепты</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col menu">
                        <a href=""><img class="mr-3" src="{{ asset('img/recipe.png') }}" alt="">Ингредиенты</a>
                    </div>
                </div>
                <hr>
            </div>

            <div class="col-1">
                <hr id="border-vertical">
            </div>

            <div class="col-8 mt-4 content">
                <div class="row mb-3">
                    <div class="col my-recipe">
                        Мои рецепты
                    </div>
                    <div class="col text-right">
                        <a id="add" href="javascript:createRecipe();">Добавить рецепт</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr class="table-head">
                                <th scope="col">
                                    Рецепт <span class="sorting"><img src="{{ asset('img/sorting.png') }}" alt="sort"></span>
                                </th>
                                <th scope="col">
                                    Описание<span class="sorting"><img src="{{ asset('img/sorting.png') }}" alt="sort"></span>
                                </th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>Шарлотка</td>
                                <td>Вкусняшка</td>
                                <td class="text-center">
                                    <img src="{{ asset('img/show.png') }}" alt="show">
                                    <img src="{{ asset('img/edit.png') }}" alt="edit">
                                    <img src="{{ asset('img/delete.png') }}" alt="delete">
                                </td>
                            </tr>
                            <tr>
                                <td>Борщ</td>
                                <td>На каждый день</td>
                                <td class="text-center">
                                    <img src="{{ asset('img/show.png') }}" alt="show">
                                    <img src="{{ asset('img/edit.png') }}" alt="edit">
                                    <img src="{{ asset('img/delete.png') }}" alt="delete">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection