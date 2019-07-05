<form id="form-show-recipe">
    <!-- Block name, description -->
    <div class="row mb-3">
        <div class="col my-recipe">
            {{ $recipe->name }}
            <a id="edit" href="recipe/{{ $recipe->id }}/edit">
                <img src="{{ asset('img/edit.png') }}" alt="edit">
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p>{{ $recipe->description }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col my-recipe">
            Ингредиенты:
        </div>
    </div>

    <hr>

    @foreach($ingredients as $ingredient)
        <div class="row">
            <div class="col-3 pl-5">
                {{ $ingredient->name }}
            </div>
            <div class="col text-right">
                <input id="ingredientAmount-{{ $ingredient->pivot->ingredient_id }}" type="text"
                       value="{{ $ingredient->pivot->amount }}">
                <a id="update-ingredient-amount"
                   href="{{ route('ingredient.updateAmount', ['ingredientId' => $ingredient->pivot->ingredient_id]) }}"
                   data-recipeId="{{ $recipe->id }}" data-ingredientId="{{ $ingredient->pivot->ingredient_id }}">
                    <img src="{{ asset('img/edit.png') }}" alt="edit">
                </a>
                <a id="destroy-ingredient" href="{{ route('ingredient.destroy', $ingredient->pivot->ingredient_id) }}"
                   data-method="delete">
                    <img src="{{ asset('img/delete.png') }}" alt="delete">
                </a>
            </div>
        </div>
        <hr>
    @endforeach

    <div id="ingredient-error" class="alert alert-danger" role="alert"></div>

</form>
