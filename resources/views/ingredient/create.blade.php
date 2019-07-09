<form id="form-create-recipe">
    <div class="row mb-3">
        <div class="col my-recipe">
            Добавление Игредиента
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="ingredientName" class="col-2 col-form-label">Название</label>

                <div class="col-md-6">
                    <input id="ingredientName" type="text" class="form-control" name="ingredientName" required
                           placeholder="Название рецепта" autofocus>
                </div>
            </div>
        </div>
    </div>

    <div id="ingredient-error" class="alert alert-danger" role="alert"></div>

    <hr>

    <div class="row mb-3">
        <div class="col text-right">
            <a id="save-ingredient" href="#">Сохранить ингредиент</a>
        </div>
    </div>
</form>
