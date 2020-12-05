@extends('includes.layout')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
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
                @forelse ($order->products()->with('category')->get() as $product)
                    <tr>
                        <td>
                            <a href="{{ route('product', [$product->category, $product]) }}">
                                <img height="56px" src="{{ asset('storage/' . $product->image) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td><span class="badge">{{ $product->pivot->count }}</span>
                            <div class="btn-group form-inline">
                                <form action="{{ route('basket-remove', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" href=""><span class="glyphicon glyphicon-minus"
                                            aria-hidden="true"></span></button>
                                </form>
                                <form action="{{ route('basket-add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success" href=""><span class="glyphicon glyphicon-plus"
                                            aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </td>
                        <td>{{ $product->price }} ₽</td>
                        <td>{{ $product->getPriceForCount() }} ₽</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <h2>Ваша корзина пуста</h2>
                        </td>
                    </tr>
                @endforelse

                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>{{ $order->getFullSum() }} ₽</td>
                </tr>
            </tbody>
        </table>
        <br>
        @if ($order->getFullSum() > 0)
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
            </div>
        @endif

    </div>
@endsection
