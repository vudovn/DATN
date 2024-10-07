@props(['label', 'name', 'value', 'require'])
<div class="form-group">
    <label for="{{ $name }}" class="control-label text-left">{{ $label }} {!! isset($require) && $require ? '<span class="text-danger">*</span>' : '' !!} </label>
    <select name="{{ $name }} " class="select2 form-control" id="{{ $name }}">
        <option value="">Chọn trạng thái</option>
        <option value="true" {{ old($name, $value) == 'true' ? 'selected' : '' }}>Xuất bản</option>
        <option value="false" {{ old($name, $value) == 'false' ? 'selected' : '' }}>Không xuất bản</option>
    </select>
</div>

@error($name)
    <small class="error text-danger">{{ $message }}</small>
@enderror
