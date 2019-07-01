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
});

function createRecipe() {
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
        success: function (response) {
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
            setIngredients(response, selectId);
        },
        error: function (response) {
        }
    });
}

function setIngredients(data, selectId) {
    $('#form-ingredient').append('<div class="row ingredient-block-' + selectId + '">\n' +
        '            <div class="col-5">\n' +
        '                <div class="form-group mt-2">\n' +
        '                    <select id="ingredient-' + selectId + '" class="form-control" data-id="' + selectId + '">\n' +
        '                        <option value="" disabled selected></option>\n' +
        '                    </select>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '\n' +
        '            <div class="col-3">\n' +
        '                <div class="form-group">\n' +
        '                    <div class="col pl-0">\n' +
        '                        <input id="amount" type="text" class="form-control" name="amount" required autofocus>\n' +
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