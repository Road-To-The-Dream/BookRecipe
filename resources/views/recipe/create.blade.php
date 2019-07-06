<form id="form-create-recipe">
    <!-- Block name, description -->
    <div class="row mb-3">
        <div class="col my-recipe">
            Добавление рецепта
        </div>
    </div>

    <div id="recipe-error" class="alert alert-danger" role="alert"></div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="name" class="col-2 col-form-label">Название</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="recipeName" required
                           placeholder="Название рецепта" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-2 col-form-label">Описание</label>

                <div class="col">
                    <textarea id="description" class="form-control" name="description" rows="6" required
                              placeholder="Описание"></textarea>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Block ingredient -->
    <div id="form-ingredient">
        <div class="row ingredient-block-1">
            <div class="col-5">
                <div class="form-group">
                    <label for="ingredient-1" class="col-2 col-form-label pl-0 mb-3">Ингредиент</label>

                    <select id="ingredient-1" name="ingredient-1" class="form-control" data-id="1">
                        <option value="" selected></option>
                        @foreach($ingredients as $key => $ingredient)
                            <option value="{{ $key }}">{{ $ingredient }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="amount-1" class="col-form-label pl-0 mb-2">Количество</label>

                    <div class="col pl-0">
                        <input id="amount-1" type="text" class="form-control" name="amount[]" required autofocus>
                    </div>
                </div>
            </div>

            <div class="col-2 text-center">
                <div class="form-group">
                    <label for="amount" class="col-form-label pl-0 mb-3">Удалить</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Block add, create ingredient -->
    <div class="row mt-5">
        <div class="col-4">
            <button type="button" id="add-select-ingredients" class="btn btn-success">Добавить</button>
        </div>
        <div class="col-4 text-right">
            <div class="form-group">
                <label for="amount" class="col-form-label pl-0">Нет в списке ?</label>
            </div>
        </div>
        <div class="col-4 text-right">
            <button type="button" id="modal-create-ingredient" class="btn btn-success" data-toggle="modal"
                    data-target="#ingredientModal">Создать новый ингредиент
            </button>
        </div>

        <!-- Modal ingredient -->
        <div class="modal fade" id="ingredientModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавление ингредиента</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-3 col-form-label">Название</label>

                            <div class="col-md-7">
                                <input id="ingredientName" type="text" class="form-control" required
                                       placeholder="Название ингредиента" autofocus>
                                <div id="ingredient-error" class="text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-save-ingredient" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row mb-3">
        <div class="col text-right">
            <a id="create-recipe" href="#">Сохранить рецепт</a>
        </div>
    </div>
</form>
