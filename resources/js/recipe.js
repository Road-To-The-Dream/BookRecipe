$(document).ready(function () {
    $(document).on('click', '#save-ingredient', function () {
        createIngredient();
    });

    $(document).on('click', '#create-ingredient', function () {
        $('#ingredientName').val('');
    });

    $(document).on('click', '#add-ingredient', function () {
        let selectId = $("#form-ingredient select").eq(-1).data('id');
        getIngredients(selectId + 1);
    });

    $(document).on('click', '#delete-ingredient', function () {
        $('.ingredient-block-' + $(this).data("id")).remove();
    });

    $(document).on('click', '#destroy', function (event) {
        event.preventDefault();
        destroyRecipe($(this));
    });

    setTimeout(function () {
        $('#delete-message').fadeOut("slow");
    }, 2000);

    $(document).on('click', '#create-recipe', function (event) {
        event.preventDefault();
        createRecipe();
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

            initializeList(1);
        },
        error: function (response) {
            $('.content').empty();
            $('.content').append(response);
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
            $('#ingredientModal').modal('toggle');
            $.notify(
                "Ингредиент успешно добавлен !", {
                    className: 'success',
                    globalPosition: 'bottom left'
                }
            );
        },
        error: function (response) {
            $('#ingredient-error').empty();
            $('#ingredient-error').append(response['responseJSON']['errors']['ingredientName'][0]);
        }
    })
}

function initializeList(id) {
    $('#ingredient-' + id).select2({
        placeholder: "Выберите ингредиент",
        allowClear: true
    });
}

function getIngredients(selectId) {
    return $.ajax({
        url: '/ingredient',
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
        '            <div class="col-5">\n' +
        '                <div class="form-group mt-2">\n' +
        '                    <select id="ingredient-' + selectId + '" name="ingredient-' + selectId + '" class="form-control" data-id="' + selectId + '">\n' +
        '                        <option value="" disabled selected></option>\n' +
        '                    </select>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '\n' +
        '            <div class="col-3">\n' +
        '                <div class="form-group">\n' +
        '                    <div class="col pl-0">\n' +
        '                        <input id="amount' + selectId + '" type="text" class="form-control" name="amount[]" required autofocus>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '\n' +
        '            <div class="col-2 text-center">\n' +
        '                <div class="form-group">\n' +
        '                    <div class="col">\n' +
        '                        <img id="delete-ingredient" src="img/delete.png" data-id="' + selectId + '" alt="delete">\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>');

    for (let key in data) {
        $('#ingredient-' + selectId).append($('<option>', {
            value: key,
            text: data[key]
        }));
    }

    initializeList(selectId);
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
                    globalPosition: 'bottom left'
                }
            );
        },
        error: function (response) {
            $('#recipe-error').empty();

            $.each( response['responseJSON']['errors'], function( key, value ) {
                $('#recipe-error').append(key + ": " + value + "</br>");
            });
        }
    })
}