@props(['model'])

<div class="card" style="position: sticky; top: 0; z-index:100;">
    <div class="card-header">
        Hành động
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between" style="gap: 5%">
            <button type="submit" name="send" value="send" class="btn btn-primary " style="flex: 1">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Lưu
            </button>
            <a href="{{ route($model.'.index') }}" class="btn btn-danger " style="flex: 1">
                <i class="fa-solid fa-circle-left mr-2"></i>
                Quay lại</a>
        </div>
    </div>
</div>
