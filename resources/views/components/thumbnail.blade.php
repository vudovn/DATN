@props(['label', 'name', 'value', 'required'])

<div class="card">
    <div class="card-header">
        {{ $label }} @if ($required ?? '') <span class="text-danger">*</span> @endif
    </div>
    <div class="card-body">
        <div class="{{ $name }} img-cover image-target">
            <img 
                src="{{ old($name, $value ?? '/uploads/system/no_img.jpg') }}" 
                width="100%" 
                class="img-thumbnail img-fluid" 
                alt="Hình ảnh">
        </div>
        <input type="hidden" name="{{ $name }}" value="{{ old($name, $value ?? '') }}">
    </div>
</div>

