@extends('admin.layout')

@section('title', 'Создание категории')

@section('content')
    <form action="{{ route('categories.store') }}" method="POST" class="col-md-12 mt-2" enctype="multipart/form-data">
        @csrf
        @include('admin.categories.form')
        <button type="submit" class="btn btn-success ml-3">Сохранить</button>
    </form>
@endsection
