<form>
    <div class="row mb-3">
        <div class="col my-recipe">
            Добавление рецепта
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="name" class="col-2 col-form-label">{{ __('Название') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="email"
                           value="{{ old('name') }}" required placeholder="Название рецепта" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-2 col-form-label">{{ __('Описание') }}</label>

                <div class="col">
                                    <textarea id="description" class="form-control" name="description" rows="6"
                                              required placeholder="Описание"></textarea>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label for="ingredient" class="col-2 col-form-label pl-0">{{ __('Ингредиент') }}</label>

                <select id="ingredient" class="form-control">
                    <option value="" disabled selected></option>
                    <option value="Колбаса">Колбаса</option>
                    <option value="Огурцы">Огурцы</option>
                </select>
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="amount" class="col-form-label pl-0">{{ __('Количество') }}</label>

                <div class="col pl-0">
                    <input id="amount" type="text" class="form-control" name="amount"
                           value="{{ old('amount') }}" required autofocus>
                </div>
            </div>
        </div>

        <div class="col-2 text-center">
            <div class="form-group">
                <label for="amount" class="col-form-label pl-0">{{ __('Удалить') }}</label>

                <div class="col">
                    <img id="delete" src="{{ asset('img/delete.png') }}" alt="delete">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-4">
            <button type="button" class="btn btn-success">Добавить</button>
        </div>
        <div class="col-4 text-right">
            <div class="form-group">
                <label for="amount" class="col-form-label pl-0">{{ __('Нет в списке ?') }}</label>
            </div>
        </div>
        <div class="col-4 text-right">
            <button type="button" class="btn btn-success">Создать новый ингредиент</button>
        </div>
    </div>

    <hr>

    <div class="row mb-3">
        <div class="col text-right">
            <a id="add" href="">Сохранить рецепт</a>
        </div>
    </div>
</form>
