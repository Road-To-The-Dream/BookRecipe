@if($flash = session('message-destroy-ingredient'))
    <div id="message-destroy-ingredient" class="alert alert-success" role="alert">
        {{ $flash }}
    </div>
@endif

<div class="row mb-3">
    <div class="col my-recipe">
        Мои ингредиенты
    </div>
    <div class="col text-right">
        <a id="add-ingredient" href="#">Добавить ингредиент</a>
    </div>
</div>

<div class="row">
    <div class="col">
        @if(count($ingredients) > 0)

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr class="table-head">
                    <th id="ingredient-name" scope="col">
                        Меню
                        <span class="sorting"><img src="{{ asset('img/sorting.png') }}"
                                                   alt="sort"></span>
                    </th>
                    <th id="ingredient-action" scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->name }}</td>
                        <td class="text-center" style="padding: 10px 0">
                            <a id="action-edit-ingredient" href="recipe/{{ $ingredient->id }}/edit">
                                <img src="{{ asset('img/edit.png') }}" alt="edit">
                            </a>
                            <a id="action-destroy-ingredient"
                               href="{{ route('ingredient.destroy', $ingredient->id) }}"
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
                    <p class="alert alert-danger">Ingredients not found</p>
                </div>
            </div>
        @endif
    </div>
</div>