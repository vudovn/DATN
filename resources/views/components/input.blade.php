@props(['label', 'name', 'value', 'required', 'type', 'readonly' , 'class' ])
<div class="form-group mb-3">
    <label for="{{ $name }}" class="control-label text-left">{{ $label }} {!! isset($required) && $required ? '<span class="text-danger">*</span>' : '' !!} </label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control @error($name)is-invalid @enderror "
        autocomplete="off" placeholder="" value="{{ old($name, $value ?? '') }}" id="{{ $name }}"
        {{ isset($readonly) && $readonly === true ? 'readonly' : '' }}>
    @error($name)
        <small class="error text-danger">*{{ $message }}</small>
    @enderror
</div>
