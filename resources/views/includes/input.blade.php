@if ($type === 'textarea')
<textarea name="{{ $name }}" id="{{ $field }}"
    class="form-control {{ ($class ?? '') . ($errors->has($field) ? ' is-invalid' : '') }}"
    rows="{{ $rows ?? 5 }}">{{ old($field) ?? ($object->$field ?? '') }}</textarea>
@elseif ($type === 'select')
<select name="{{ $name }}" id="{{ $field }}" class="form-control {{ $class ?? '' }}">
    <option disabled>Выберите</option>
    @isset($collection, $property)
        @foreach ($collection as $item)
        <option value="{{ $item->id ?? '' }}" @if (isset($object) && $item->id == $object->$field)
            selected
            @endif>{{ $item->$property }}</option>
        @endforeach
    @endisset
</select>
@elseif($type === 'check')
<input class="form-check-input {{ ($class ?? '') . ($errors->has($field) ? ' is-invalid' : '') }}" type="checkbox" 
    @if (isset($object) && $object->$field) checked @endif id="{{ $field }}" name="{{ $name }}">
@else
<input type="{{ $type }}" name="{{ $name }}" id="{{ $field }}"
    class="form-control {{ ($class ?? '') . ($errors->has($field) ? ' is-invalid' : '') }}"
    value="{{ old($field, $object->$field ?? '') }}" autocomplete="{{ $field }}" autofocus />
@endif
@error($field)
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror