@props(['label', 'name', 'value', 'require', 'type', 'readonly'])
<div class="form-row">
    <label for="{{ $name }}" class="control-label text-left">{{ $label }} {!! (isset($require) && $require) ? '<span class="text-danger">*</span>' : '' !!} </label>
    <input 
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        class="form-control @error($name)is-invalid @enderror "
        autocomplete="off"
        placeholder=""
        value="{{ old($name, $value ?? '') }}"
        id="{{ $name }}"
        {{ (isset($readonly) && $readonly === true ) ? 'readonly' : '' }}
    >
</div>

@error($name)
    <small class="error text-danger">{{ $message }}</small>
@enderror