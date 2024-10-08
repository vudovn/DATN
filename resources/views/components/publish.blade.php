@props(['label', 'name', 'value', 'required'])
<div class="card">
    <div class="card-header">
        {{ $label }} @if ($required ?? '') <span class="text-danger">*</span> @endif
    </div>
    <div class="card-body">
        <select name="{{ $name }} " class="select2 form-control " id="{{ $name }}">
            <option value="">Chọn trạng thái</option>
            @foreach (__('general.publish') as $key => $option)
                <option value="{{ $option['id'] }}" {{ $value == $option['id'] ? 'selected' : '' }}>{{ $option['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>

@error($name)
    <small class="error text-danger">{{ $message }}</small>
@enderror
