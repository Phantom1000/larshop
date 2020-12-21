<div class="form-group row">
    <label for="name" class="col-md-2">Название</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'text', 'name' => 'name', 'field' => 'name', 'object' => $product])
    </div>
</div>
<div class="form-group row">
    <label for="code" class="col-md-2">Код</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'text', 'name' => 'code', 'field' => 'code', 'object' => $product])
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-2">Описание</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'textarea', 'name' => 'description', 'field' => 'description', 'object' =>
        $product, 'rows' => 10])
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-md-2">Цена</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'number', 'name' => 'price', 'field' => 'price', 'object' => $product])
    </div>
</div>

<div class="form-group row">
    <label for="count" class="col-md-2">Количество</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'number', 'name' => 'count', 'field' => 'count', 'object' => $product])
    </div>
</div>
<div class="form-group row">
    <label for="category" class="col-md-2">Категория</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'select', 'name' => 'category_id', 'field' => 'category_id', 'object' =>
        $product, 'collection' => $categories, 'property' => 'name'])
    </div>
</div>

<div class="form-group row">
    <label for="image" class="col-md-2">Картинка</label>
    <div class="col-md-4">
        <input type="file" name="image">
    </div>
</div>

@foreach (['hit' => 'Хит', 'new' => 'Новинка', 'recommend' => 'Рекомендуемые'] as $field => $title)
<div class="form-check row">
    @include('includes.input', ['type' => 'check', 'object' => $product, 'name' => $field, 'field' => $field])
    <label for="{{ $field }}" class="form-check-label">{{ $title }}</label>
</div>
@endforeach