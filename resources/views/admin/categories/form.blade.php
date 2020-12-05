<div class="form-group row">
    <label for="name" class="col-md-2">Название</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'text', 'name' => 'name', 'field' => 'name', 'object' => $category])
    </div>

</div>
<div class="form-group row">
    <label for="code" class="col-md-2">Код</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'text', 'name' => 'code', 'field' => 'code', 'object' => $category])
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-2">Описание</label>
    <div class="col-md-4">
        @include('includes.input', ['type' => 'textarea', 'name' => 'description', 'field' => 'description', 'object' =>
        $category, 'rows' => 10])
    </div>
</div>

<div class="form-group row">
    <label for="image" class="col-md-2">Картинка</label>
    <div class="col-md-4">
        <input type="file" name="image" class="form-control-file">
    </div>

</div>
