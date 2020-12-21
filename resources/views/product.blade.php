@extends('includes.layout')

@section('title', 'товар')

@section('content')
<h1>{{ $product->name }}</h1>
<h2>{{ $product->category->name }}</h2>
<p>Цена: <b>{{ $product->price }} ₽</b></p>
<img src="{{ asset('storage/' . $product->image) }}">
<p>{{ $product->description }}</p>
@if ($product->isAvailable())
<form action="{{ route('basket-add', $product) }}" method="POST">
    <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
    @csrf
</form>
@else
<div>
    <span>Нет в наличии</span>
    <br>
    <span>Сообщить мне, когда товар будет в наличии</span>
    <form action="{{ route('subscribe', $product) }}" method="POST" class="mt-2 form-inline justify-content-center">
        @guest
        @include('includes.input', ['field' => 'email', 'name' => 'email', 'type' => 'email'])
        @endguest
        <button type="submit" class="btn btn-info ml-2" role="button">Отправить</button>
        @csrf
    </form>
</div>
@endif
@endsection