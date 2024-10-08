@props(['label', 'name', 'value', 'require'])
<div class="form-group">
    <button type="button" class="btn btn-primary swalDefaultSuccess">oke</button>
    <label for="{{ $name }}" class="control-label text-left">{{ $label }} {!! isset($require) && $require ? '<span class="text-danger">*</span>' : '' !!} </label>
    <select name="{{ $name }} " class="select2 form-control " id="{{ $name }}">
        <option value="">Chọn trạng thái</option>
        @foreach (__('general.publish') as $key => $option)
            <option value="{{ $option['id'] }}" {{ $value == $option['id'] ? 'selected' : '' }}>{{ $option['name'] }}</option>
        @endforeach
    </select>
</div>

@error($name)
    <small class="error text-danger">{{ $message }}</small>
@enderror
