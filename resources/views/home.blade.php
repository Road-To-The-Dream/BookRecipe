@extends('layouts.app')

@section('content')
    <div class="container">

        @if($flash = session('message'))
            <div id="delete-message" class="alert alert-success" role="alert">
                {{ $flash }}
            </div>
        @endif

        <div class="row">
            <div class="col-3 mt-3">
                <div class="row">
                    <div class="col menu">
                        <a href="/recipe"><img class="mr-3" src="{{ asset('img/ingredients.png') }}" alt="">Мои рецепты</a>
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
                        <a id="add-recipe" href="javascript:formCreateRecipe();">Добавить рецепт</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @if(count($recipes) > 0)

                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                <tr class="table-head">
                                    <th scope="col">
                                        Рецепт <span class="sorting"><img src="{{ asset('img/sorting.png') }}"
                                                                          alt="sort"></span>
                                    </th>
                                    <th scope="col">
                                        Описание<span class="sorting"><img src="{{ asset('img/sorting.png') }}"
                                                                           alt="sort"></span>
                                    </th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recipes as $recipe)
                                    <tr>
                                        <td>{{ $recipe->name }}</td>
                                        <td>{{ $recipe->description }}</td>
                                        <td class="text-center">
                                            <a id="show" href="recipe/{{ $recipe->id }}"><img
                                                        src="{{ asset('img/show.png') }}" alt="show"></a>
                                            <a id="edit" href="recipe/{{ $recipe->id }}/edit"><img
                                                        src="{{ asset('img/edit.png') }}" alt="edit"></a>
                                            <a id="destroy" href="{{ route('recipe.destroy', $recipe->id) }}"
                                               data-method="delete"><img src="{{ asset('img/delete.png') }}"
                                                                         alt="delete"></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            <div class="row">
                                <div class="col text-center">
                                    <p class="alert alert-danger">Recipes not found</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection