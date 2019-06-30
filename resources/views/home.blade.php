@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="row mb-5">
                    <div class="col">
                        <img class="mr-3" src="img/ingredients.png" alt="">Мои рецепты
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <img class="mr-3" src="img/recipe.png" alt="">Ингредиенты
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="row mb-3">
                    <div class="col">
                        Мои рецепты
                    </div>
                    <div class="col text-right">
                        <button>Добавить рецепт</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr class="table-head">
                                <th scope="col">
                                    Рецепт <span class="sorting"><img src="img/sorting.png" alt="sort"></span>
                                </th>
                                <th scope="col">
                                    Описание<span class="sorting"><img src="img/sorting.png" alt="sort"></span>
                                </th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>Шарлотка</td>
                                <td>Вкусняшка</td>
                                <td class="text-center">
                                    <img src="img/eye.png" alt="show">
                                    <img src="img/edit.png" alt="edit">
                                    <img src="img/delete.png" alt="delete">
                                </td>
                            </tr>
                            <tr>
                                <td>Борщ</td>
                                <td>На каждый день</td>
                                <td class="text-center">
                                    <img src="img/eye.png" alt="show">
                                    <img src="img/edit.png" alt="edit">
                                    <img src="img/delete.png" alt="delete">
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
