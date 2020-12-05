@extends('includes.layout')

@section('title', 'Главная')

@section('content')
<h1>Все товары</h1>
<form method="GET" action="{{ route('index') }}">
    <div class="filters row">
        <div class="form-inline col-sm-2 col-md-2 mb-2">
            <label for="price_from">Цена от</label>
            <input type="text" name="price_from" id="price_from" class="form-control" size="6"
                value="{{ request()->price_from }}">
            @error('price_from')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-inline col-sm-2 col-md-2 mb-2">
            <label for="price_to">до</label>
            <input type="text" name="price_to" id="price_to" class="form-control" size="6"
                value="{{ request()->price_to }}">
            @error('price_to')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-check col-sm-2 col-md-2">
            <input type="checkbox" name="hit" id="hit" class="form-check-input" @if (request()->has('hit')) checked
            @endif>
            <label for="hit">Хит</label>
        </div>
        <div class="form-check col-sm-2 col-md-2">
            <input type="checkbox" name="new" id="new" class="form-check-input" @if (request()->has('new')) checked
            @endif>
            <label for="new">Новинка</label>
        </div>
        <div class="form-check col-sm-2 col-md-2">
            <input type="checkbox" name="recommend" id="recommend" class="form-check-input" @if (request()->has('recommend')) checked @endif>
            <label for="recommend">Рекомендуем</label>
        </div>
        <div class="form-group col-sm-2 col-md-2">
            <button class="btn btn-primary">Фильтр</button>
            <a class="btn btn-warning" href="{{ route('index') }}">Сброс</a>
        </div>
    </div>
</form>
<div class="row">
    @foreach ($products as $product)
    @include('includes.card', compact('product'))
    @endforeach
</div>
{{ $products->withQueryString()->links() }}
@endsection