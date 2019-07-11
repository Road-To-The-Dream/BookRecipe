@extends('layouts.app')

@section('content')
    <div class="container">

        @if($flash = session('message-destroy-recipe'))
            <div id="message-destroy-recipe" class="alert alert-success" role="alert">
                {{ $flash }}
            </div>
        @endif

        <div class="row">
            <div class="col-3 mt-3">
                <div class="row">
                    <div class="col menu">
                        <a id="show-recipes" href="get-all-recipes" data-method="GET">
                            <img class="mr-3" src="{{ asset('img/ingredients.png') }}" alt="">Мои рецепты
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col menu">
                        <a id="show-ingredients" href="#">
                            <img class="mr-3" src="{{ asset('img/recipe.png') }}" alt="">Ингредиенты
                        </a>
                    </div>
                </div>
                <hr>
                <input type="text" id="flag-update-or-create-recipe" value="" hidden>
            </div>

            <div class="col-1">
                <hr id="border-vertical">
            </div>

            <div class="col-8 mt-4 content">
            </div>
        </div>

    </div>
@endsection