<div class="row mb-3">
    <div class="col my-recipe">
        Мои рецепты
    </div>
    <div class="col text-right">
        <a id="add-recipe" href="#">Добавить рецепт</a>
    </div>
</div>

<div class="row">
    <div class="col">
        @if(count($recipes) > 0)

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr class="table-head">
                    <th id="recipe-name" scope="col">
                        Рецепт
                        <span class="sorting"><img src="{{ asset('img/sorting.png') }}"
                                                   alt="sort"></span>
                    </th>
                    <th id="recipe-description" scope="col">
                        Описание
                        <span class="sorting"><img src="{{ asset('img/sorting.png') }}"
                                                   alt="sort"></span>
                    </th>
                    <th id="recipe-action" scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->name }}</td>
                        <td>{{ $recipe->description }}</td>
                        <td class="text-center" style="padding: 10px 0">
                            <a id="action-show-recipe" href="{{ route('recipe.show', $recipe->id) }}">
                                <img src="{{ asset('img/show.png') }}" alt="show">
                            </a>
                            <a id="action-edit-recipe" href="{{ route('recipe.edit', $recipe->id) }}">
                                <img src="{{ asset('img/edit.png') }}" alt="edit">
                            </a>
                            <a id="action-destroy-recipe"
                               href="{{ route('recipe.destroy', $recipe->id) }}"
                               data-method="delete">
                                <img src="{{ asset('img/delete.png') }}" alt="delete">
                            </a>
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