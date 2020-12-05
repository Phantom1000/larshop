@extends('admin.layout')

@section('title', 'Редактирование категории')

@section('content')
    <form action="{{ route('categories.update', $category) }}" method="POST" class="col-md-12 mt-2"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.categories.form')
        <button type="submit" class="btn btn-success ml-3">Сохранить</button>
    </form>
@endsection
