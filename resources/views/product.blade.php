@extends('includes.layout')

@section('title', 'товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->code }}</h2>
    <p>Цена: <b>{{ $product->price }} ₽</b></p>
    <img src="{{ asset('storage/' . $product->image) }}">
    <p>{{ $product->description }}</p>
    <form action="{{ route('basket-add', $product) }}" method="POST">
        <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        @csrf
    </form>
@endsection
