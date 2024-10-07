@props(['label', 'name', 'value'])

<div class="form-group">
    <label for="{{ $name }}" class="control-label text-left">{{ $label }}</label>
    
    <div class="{{ $name }} img-cover image-target">
        <img 
            src="{{ old($name, $value ?? '/uploads/system/no_img.jpg') }}" 
            width="100%" 
            class="img-thumbnail img-fluid" 
            alt="Hình ảnh">
    </div>

    <input type="hidden" name="{{ $name }}" value="{{ old($name, $value ?? '') }}">
</div>
