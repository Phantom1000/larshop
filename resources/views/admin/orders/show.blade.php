@extends('admin.layout')

@section('title', 'Заказ ' . $order->id)

@section('content')
    <div class="panel">
        <h1>Заказ №{{ $order->id }}</h1>
        <p>Заказчик: <b>{{ $order->name }}</b></p>
        <p>Номер телефона: <b>{{ $order->phone }}</b></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Стоимость</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><a href="{{ route('product', [$product->category, $product]) }}">
                                <img height="56px" src="{{ asset('storage/' . $product->image) }}">{{ $product->name }}</a>
                        </td>
                        <td><span class="badge">1</span></td>
                        <td>{{ $product->price }} руб.</td>
                        <td>{{ $product->getPriceForCount() }} руб.</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>{{ $order->calculateFullSum() }} руб.</td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
@endsection
