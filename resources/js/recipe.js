$(document).ready(function () {
    $(document).on('click', '#show-ingredients', function (event) {
        event.preventDefault();
        showListIngredients();
    });

    $(document).on('click', '#modal-save-ingredient', function () {
        createIngredientModal();
    });

    $(document).on('click', '#modal-create-ingredient', function () {
        $('#ingredientName').val('');
    });

    $(document).on('click', '#add-select-ingredients', function () {
        let selectId = $("#form-ingredient select").eq(-1).data('id');
        getIngredientsForSelect(selectId + 1);
    });

    $(document).on('click', '#action-destroy-ingredient-select', function () {
        $('.ingredient-block-' + $(this).data("id")).remove();
    });

    $(document).on('click', '#action-show-recipe', function (event) {
        event.preventDefault();
        showRecipe($(this));
    });

    $(document).on('click', '#action-destroy-recipe', function (event) {
        event.preventDefault();
        destroyRecipe($(this));
    });

    $(document).on('click', '#update-ingredient-amount', function (event) {
        event.preventDefault();
        updateIngredientAmount($(this));
    });

    setTimeout(function () {
        $('#message-destroy-recipe').fadeOut("slow");
    }, 2000);

    $(document).on('click', '#create-recipe', function (event) {
        event.preventDefault();
        createRecipe();
    });

    $(document).on('click', '#add-recipe', function (event) {
        event.preventDefault();
        formCreateRecipe();
    });

    $(document).on('click', '#add-ingredient', function (event) {
        event.preventDefault();
        formCreateIngredient();
    });

    $(document).on('click', '#create-ingredient', function (event) {
        event.preventDefault();
        createIngredient();
    });

    $(document).on('click', '#action-destroy-ingredient', function (event) {
        event.preventDefault();
        destroyIngredient($(this));
    });
});

function formCreateRecipe() {
    $.ajax({
        url: 'recipe/create',
        type: 'get',
        beforeSend: function () {
            $('.content').empty();
            $('.content').append('<div class="d-flex justify-content-center mt-3">\n' +
                '                            <div class="spinner-border" role="status">\n' +
                '                            </div>\n' +
                '                            <p class="mt-1 ml-3">Загрузка . . .</p>\n' +
                '                        </div>');
        },
        success: function (response) {
            $('.content').empty();
            $('.content').append(response);

            initializeSelectIngredients(1);
        },
        error: function (response) {
            $('.content').empty();
            $('.content').append(response);
        }
    })
}

function formCreateIngredient() {
    $.ajax({
        url: 'ingredient/create',
        type: 'get',
        beforeSend: function () {
            $('.content').empty();
            $('.content').append('<div class="d-flex justify-content-center mt-3">\n' +
                '                            <div class="spinner-border" role="status">\n' +
                '                            </div>\n' +
                '                            <p class="mt-1 ml-3">Загрузка . . .</p>\n' +
                '                        </div>');
        },
        success: function (response) {
            $('.content').empty();
            $('.content').append(response);
        },
        error: function (response) {
            $('.content').empty();
            $('.content').append(response);
        }
    })
}

function createIngredientModal() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/ingredient',
        type: 'post',
        data: {ingredientName: $('#ingredientName').val()},
        success: function () {
            $('#ingredientModal').modal('toggle');
            $.notify(
                "Ингредиент успешно добавлен !", {
                    className: 'success',
                    globalPosition: 'bottom right'
                }
            );
        },
        error: function (response) {
            $('#ingredient-error').empty();
            $('#ingredient-error').append(response['responseJSON']['errors']['ingredientName'][0]);
        }
    })
}

function createIngredient() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/ingredient',
        type: 'post',
        data: {ingredientName: $('#ingredientName').val()},
        success: function () {
            $.notify(
                "Ингредиент успешно добавлен !", {
                    className: 'success',
                    globalPosition: 'bottom right'
                }
            );

            showListIngredients();
        },
        error: function (response) {
            $('#ingredient-error').css('display', 'block');
            $('#ingredient-error').empty();
            $('#ingredient-error').append(response['responseJSON']['errors']['ingredientName'][0]);
        }
    })
}

function initializeSelectIngredients(id) {
    $('#ingredient-' + id).select2({
        placeholder: "Выберите ингредиент",
        allowClear: true
    });
}

function getIngredientsForSelect(selectId) {
    return $.ajax({
        url: 'all-ingredients',
        type: 'get',
        success: function (response) {
            appendIngredients(response, selectId);
        },
        error: function (response) {
        }
    });
}

function appendIngredients(data, selectId) {
    $('#form-ingredient').append('<div class="row ingredient-block-' + selectId + '">\n' +
        '    <div class="col-5">\n' +
        '        <div class="form-group mt-2">\n' +
        '            <select id="ingredient-' + selectId + '" name="ingredient-' + selectId + '" class="form-control"\n' +
        '                    data-id="' + selectId + '">\n' +
        '                <option value="" disabled selected></option>\n' +
        '            </select>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div class="col-3">\n' +
        '        <div class="form-group">\n' +
        '            <div class="col pl-0">\n' +
        '                <input id="amount\' + selectId + \'" type="text" class="form-control" name="amount[]" required autofocus>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div class="col-2 text-center">\n' +
        '        <div class="form-group">\n' +
        '            <div class="col">\n' +
        '                <img id="action-destroy-ingredient-select" src="img/delete.png" data-id="' + selectId + '" alt="delete">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>');

    for (let key in data) {
        $('#ingredient-' + selectId).append($('<option>', {
            value: key,
            text: data[key]
        }));
    }

    initializeSelectIngredients(selectId);
}

function destroyRecipe(link) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post({
        type: link.data('method'),
        url: link.attr('href')
    }).done(function () {
        location.reload();
    });
}

function createRecipe() {
    let data = new FormData(document.getElementById("form-create-recipe"));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/recipe',
        type: 'post',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function () {
            $.notify(
                "Рецепт успешно добавлен !", {
                    className: 'success',
                    globalPosition: 'bottom right'
                }
            );

            setTimeout(function () {
                window.location.href = "/recipe";
            }, 2000);
        },
        error: function (response) {
            $('#recipe-error').empty();
            $('#recipe-error').css('display', 'block');

            $.each(response['responseJSON']['errors'], function (key, value) {
                $('#recipe-error').append(key + ": " + value + "</br>");
            });
        }
    })
}

function showRecipe(link) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: link.attr('href'),
        type: link.data('method'),
        beforeSend: function () {
            $('.content').empty();
            $('.content').append('<div class="d-flex justify-content-center mt-3">\n' +
                '                            <div class="spinner-border" role="status">\n' +
                '                            </div>\n' +
                '                            <p class="mt-1 ml-3">Загрузка . . .</p>\n' +
                '                        </div>');
        },
        success: function (response) {
            $('.content').empty();
            $('.content').append(response);
        },
        error: function (response) {
            $('.content').empty();
            $('.content').append(response);
        }
    })
}

function updateIngredientAmount(link) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: link.attr('href'),
        type: 'patch',
        data: {
            recipeId: link.attr('data-recipeId'),
            ingredientAmount: $('#ingredientAmount-' + link.attr('data-ingredientId')).val()
        },
        success: function () {
            $('#ingredient-error').css('display', 'none');
            $.notify(
                "Ингредиент успешно обновлён !", {
                    className: 'success',
                    globalPosition: 'bottom right'
                }
            );
        },
        error: function (response) {
            $.notify(
                "Ошибка при обновлении !", {
                    className: 'error',
                    globalPosition: 'bottom right'
                }
            );

            $('#ingredient-error').empty();
            $('#ingredient-error').css('display', 'block');

            $.each(response['responseJSON']['errors'], function (key, value) {
                $('#ingredient-error').append(value + "</br>");
            });
        }
    })
}

function showListIngredients() {
    $.ajax({
        url: 'ingredient',
        type: 'get',
        beforeSend: function () {
            $('.content').empty();
            $('.content').append('<div class="d-flex justify-content-center mt-3">\n' +
                '                            <div class="spinner-border" role="status">\n' +
                '                            </div>\n' +
                '                            <p class="mt-1 ml-3">Загрузка . . .</p>\n' +
                '                        </div>');
        },
        success: function (response) {
            $('.content').empty();
            $('.content').append(response);
        },
        error: function (response) {
            $('.content').empty();
            $('.content').append(response);
        }
    })
}

function destroyIngredient(link) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post({
        type: link.data('method'),
        url: link.attr('href')
    }).done(function () {
        showListIngredients();

        setTimeout(function () {
            $('#message-destroy-ingredient').fadeOut("slow");
        }, 2000);
    });
}