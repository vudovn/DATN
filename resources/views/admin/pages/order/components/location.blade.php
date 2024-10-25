<div class="row mb-3">
    <div class="col-4 form-group">
        <label for="province" class="control-label">Tỉnh/Thành Phố</label>
        <select name="province_id" id="province" class="form-control js-choice-province province location" data-target="districts">
            <option value="" disabled selected>Chọn tỉnh/thành phố</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->code }}"
                    {{ isset($order) && $order->province_id == $province->code ? 'selected' : '' }}>
                    {{ $province->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-4 form-group">
        <label for="district" class="control-label">Quận/Huyện</label>
        <select name="district_id" id="district" class="form-control js-choice districts location" data-target="wards">
            <option value="" disabled selected>Chọn quận/huyện</option>
        </select>
    </div>
    <div class="col-4 form-group">
        <label for="ward" class="control-label">Phường/Xã</label>
        <select name="ward_id" id="ward" class="form-control wards js-choice">
            <option value="" disabled selected>Chọn phường/xã</option>
        </select>
    </div>
</div>


{{-- chừ tao 3 cái biến để lưu mấy cái value của 3 thằn trên --}}
<script>
    var province_id = '{{ (isset($order->province_id)) ? $order->province_id : old('province_id') }}'
    var district_id = '{{ (isset($order->district_id)) ? $order->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($order->ward_id)) ? $order->ward_id : old('ward_id') }}'

    $(document).ready(function() {
        
    })
</script>