@props(['label', 'name', 'value','option', 'required'])
<div class="card">
    <div class="card-header">
        {{ $label }} @if ($required ?? '') <span class="text-danger">*</span> @endif
    </div>
    <div class="card-body">
        <select name="{{ $name }}" class="select2 form-control " id="{{ $name }}">
            <option value="2">Chọn trạng thái</option>
            @foreach ($option as $key => $items)
                <option value="{{ $items['id'] }}" {{ $value == $items['id'] ? 'selected' : '' }}>{{ $items['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>

@error($name)
    <small class="error text-danger">{{ $message }}</small>
@enderror
