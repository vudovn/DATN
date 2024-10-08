@props(['model'])

<div class="form-group">
    <button type="submit" name="send" value="send" class="btn {{ $class }} text-13 flex flex-middle">
        <i class="fa fa-save"></i>
        Lưu
    </button>
    
    <a href=`{{ route("$model.index") }}` class="btn btn-danger">Quay về</a>
</div>