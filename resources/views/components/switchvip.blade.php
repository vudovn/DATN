@props(['value','model'])
<div class="js-switch-{{ $value->id }}">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input js-switch status"
            id="customSwitch{{ $value->id }}" data-field="publish" data-value="{{ $value->publish }}"
            data-model="{{ $model }}" data-id="{{ $value->id }}" data-publish="{{ $value->publish}}"
            {{ $value->publish === 1 ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch{{ $value->id }}"></label>
    </div>
</div>