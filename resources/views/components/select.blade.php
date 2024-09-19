@props(['name', 'options', 'root', 'class', 'label'])

<label for="{{ $name }}" class="control-label">{{ $label }}</label>
<select id="{{ $name }}" name="{{ $name }}"  class="form-control {{ $class ?? '' }}">
    <option value="0">{{ $root }}</option>
    @foreach($options as $key => $val)
    <option {{ $val['id'] == old($name) ? 'selected' : '' }} value="{{ $val['id'] }}">{{ $val['name'] }}</option>
    @endforeach
</select>

@if($errors->has($name))
    <div class="error">{{ $errors->first($name) }}</div>
@endif