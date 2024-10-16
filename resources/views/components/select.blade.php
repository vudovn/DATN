@props(['name', 'options', 'root', 'class', 'label', 'value', 'required'])

<div class="form-group">
    <label for="{{ $name }}" class="control-label">
        {{ $label }} {!! $required == 'true' ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <select id="{{ $name }}" name="{{ $name }}"  class="form-control {{ $class ?? '' }} select2 @error($name)is-invalid @enderror">
        <option value="0">{{ $root }}</option>
        @foreach($options as $key => $val)
        <option {{ $val['id'] == old($name, $value) ? 'selected' : '' }} value="{{ $val['id'] }}">{{ $val['name'] }}</option>
        @endforeach
    </select>
    
    @error($name)
        <small class="error text-danger">{{ $message }}</small>
    @enderror
</div>