$(document).ready(function () {
    $(document).on('click', '#create-ingredient', function () {
        createIngredient();
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

            $('#ingredient').select2({
                placeholder: "Выберите ингредиент",
                allowClear: true
            });
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
        url: 'ingredient/',
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