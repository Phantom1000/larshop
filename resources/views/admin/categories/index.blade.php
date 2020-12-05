@extends('admin.layout')

@section('title', 'Категории')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Категории</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Описание</th>
                            <th>Когда создана</th>
                            <th class="text-center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $category->name ?? '' }}</td>
                                <td>{{ $category->code ?? '' }}</td>
                                <td>{{ $category->description ?? '' }}</td>
                                <td>{{ $category->created_at->format('H:i d.m.Y') ?? '' }}</td>
                                <td class="btn-group" role="group">
                                    <a class="btn btn-info mr-2" href="{{ route('categories.show', $category) }}">Открыть</a>
                                    <a class="btn btn-success mr-2"
                                        href="{{ route('categories.edit', $category) }}">Изменить</a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Удалить</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h2>Нет категорий</h2>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
                <a class="btn btn-success ml-2" href="{{ route('categories.create') }}">Создать категорию</a>
            </div>
        </div>
    </div>
@endsection
