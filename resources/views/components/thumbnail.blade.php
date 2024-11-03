@props(['label', 'name', 'value', 'required'])

<div class="card">
    <div class="card-header">
        {{ $label }} @if ($required ?? '')
            <span class="text-danger">*</span>
        @endif
    </div>
    <div class="card-body">
        <div class="{{ $name }} img-cover image-target">
            <img src="{{ old($name, $value ?? 'https://placehold.co/600x600?text=The Gioi\nNoi That') }}" width="100%"
                class="img-thumbnail img-fluid" alt="Hình ảnh" style="border: 1px solid #008080 !important;">
            <label for="" class="test"><i class="ti ti-edit-circle f-18"></i> Chọn ảnh</label>
        </div>
        <p class="text-muted mt-1" style="font-size: 13px">
            <label for="">Dung lượng file tối đa 1 MB</label>
            <label for="">Định dạng: .JPEG, .PNG</label>
        </p>
        <input type="hidden" name="{{ $name }}" value="{{ old($name, $value ?? '') }}">
    </div>
</div>
<style>
    .image-target {
        position: relative;
        cursor: pointer;
        transition: 0.3s all;
        &:hover .test {
            opacity: 1;
            z-index: 1;
        }

        &:hover img {
            filter: blur(1px);
        }
    }

    .test {
        background-color: #92b4b4;
        opacity: 0;
        color: #236767;
        transition: 0.3s all;
        border-radius: 20px;
        padding: 7px;
        cursor: pointer;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
