@extends('admin.layout')

@section('title', 'Категории' . $category->name)

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
                    <td>{{ $category->id ?? '' }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $category->code ?? '' }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $category->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $category->description ?? '' }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" height="240px"></td>
                </tr>
                <tr>
                    <td>Количество товаров</td>
                    <td>{{ $category->products->count() ?? '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
