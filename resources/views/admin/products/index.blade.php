@extends('admin.layout')

@section('title', 'Товары')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Товары</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Категория</th>
                            <th class="text-center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $product->name ?? '' }}</td>
                                <td>{{ $product->code ?? '' }}</td>
                                <td>{{ $product->description ?? '' }}</td>
                                <td>{{ $product->price ?? '' }}</td>
                                <td>{{ $product->count ?? '' }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td class="btn-group" role="group">
                                    <a class="btn btn-info mr-2" href="{{ route('products.show', $product) }}">Открыть</a>
                                    <a class="btn btn-success mr-2" href="{{ route('products.edit', $product) }}">Изменить</a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Удалить</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h2>Нет товаров</h2>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
                <a class="btn btn-success ml-2" href="{{ route('products.create') }}">Создать товар</a>
            </div>
        </div>
    </div>
@endsection
