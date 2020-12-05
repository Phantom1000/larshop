@extends('admin.layout')

@section('title', 'Категории' . $product->name)

@section('content')
<div class="col-md-12">
    <table class="table">
        <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id ?? '' }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code ?? '' }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name ?? '' }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description ?? '' }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $product->price ?? '' }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" height="240px"></td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if ($product->new)
                    <span class="badge badge-success">Новинка</span>
                    @endif
                    @if ($product->recommend)
                    <span class="badge badge-warning">Рекомендуемые</span>
                    @endif
                    @if ($product->hit)
                    <span class="badge badge-danger">Хит продаж</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection