@extends('includes.layout')

@section('title', 'Оформить заказ')

@section('content')
    <h1>Подтвердите заказ:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Общая стоимость: <b>{{ $order->calculateFullSum() }} ₽.</b></p>
        </div>

        <div class="row justify-content-center">
            <form action="{{ route('basket-confirm') }}" method="POST">
                <p>Укажите свои имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>

                <div class="form-inline">
                    <label for="name" class="col-lg-3 mr-2">Имя: </label>
                    <input type="text" name="name" id="name" value="" class="form-control col-lg-6">
                </div>
                <br>
                <br>
                <div class="form-inline">
                    <label for="phone" class="col-lg-3 mr-2">Номер
                        телефона: </label>
                    <input type="text" name="phone" id="phone" value="" class="form-control col-lg-6">
                </div>
                <br>
                <br>
                <div class="form-inline">
                    <label for="name" class="col-lg-3 mr-2">Email: </label>
                    <input type="text" name="email" id="email" value="" class="form-control col-lg-6">
                </div>
                <br>
                @csrf
                <input type="submit" class="btn btn-success" value="Подтвердите заказ">
            </form>
        </div>
    </div>
@endsection
