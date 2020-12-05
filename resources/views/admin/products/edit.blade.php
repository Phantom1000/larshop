@extends('admin.layout')

@section('title', 'Редактирование товара')

@section('content')
    <form action="{{ route('products.update', $product) }}" method="POST" class="col-md-12 mt-2"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products.form')
        <button type="submit" class="btn btn-success ml-3">Сохранить</button>
    </form>
@endsection
