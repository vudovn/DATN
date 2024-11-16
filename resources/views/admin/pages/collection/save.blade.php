@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$collection ?? null">
        <div class="row">
            <!-- thông tin cơ bản -->
            <div class="col-lg-9 col-md-12 mb-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                Thông tin cơ bản
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                    <strong>Lưu ý:</strong> <span class="text-danger">(*)</span> là trường bắt buộc nhập
                                </div>
                                <div class="mb-3">
                                    <x-input :label="'Tên bộ sưu tập'" :name="'name'" :class="'name-collection'" :value="$collection->name ?? old('name')"
                                        :required="true" />
                                </div>
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ $collection->short_description ?? old('short_description') }}</textarea>
                                    @error('short_description')
                                        <small class="error text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                Nội dung bộ sưu tập
                            </div>
                            <x-editor :label="''" :name="'description'" :value="$collection->description ?? old('description')" class="form-control" />
                            @error('description')
                                <small class="error text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="filterProduct">
                                <div class="card-header">
                                    <div class="title alert alert-danger" style="transition: background-color 0.3s ease;"
                                        role="alert">Bạn phải thêm ít nhất là 3 sản phẩm mới hoàn thành bộ sưu tập! <span
                                            style="cursor: pointer" href="#" data-show="show"
                                            class="me-3 link-success add-product">Thêm sản phẩm</span></div>
                                    @error('idProduct')
                                        <small class="error text-danger"><i data-feather="alert-octagon"></i></small>
                                    @enderror
                                </div>
                                <input type="text" name="idProduct" id="idProduct">
                                <script>
                                    var idProduct = @json($idProduct ?? []);
                                </script>
                                <div class="card-body show-product hidden">
                                    <x-filter :model="'collection'" :options="[
                                        'categoriesOther' => $categories,
                                        'categoriesRoom' => $categoryRoom,
                                    ]" />
                                    <p class="text-primary m-0 mt-2">Đã chọn: <span class="text-danger"><span
                                                class="countProduct">0</span> sản phẩm.</span></p>
                                    <div id="content">
                                        @include('admin.pages.product.product.components.filterProduct')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <x-seo :value_meta_title="$collection->meta_title ?? ''" :value_meta_description="$collection->meta_description ?? ''" :value_meta_keywords="$collection->meta_keywords ?? ''" />
                    {{-- <input type="hidden" name="slug" value="{{ Str::slug($collection->name) }}"> --}}
                        </div>
                </div>
            </div>
            <!-- thông tin bổ sung -->
            <div class="col-lg-3 col-md-12 mb-4">
                <x-save_back :model="$config['model']" />
                <x-thumbnail :label="'Ảnh bìa'" :name="'thumbnail'" :value="$collection->thumbnail ?? 'https://placehold.co/600x600?text=The Gioi \nNoi That'" />
                <div class="card">
                    <div class="card-header">
                        Giảm giá
                    </div>

                    <div class="card-body position-relative">
                        <x-input :label="''" :name="'discount'" :class="'name-collection'" :value="$collection->discount ?? old('discount')"
                            :required="false" />
                        <label for="discount" class="text-muted fs-6"
                            style="position: absolute;
                                   top: 53%; right:12%;
                                   transform: translate(-50%, -50%);">%</label>
                    </div>
                </div>
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.publish')" :value="$collection->publish ?? old('publish')" />
            </div>

        </div>
    </x-form>
    <script>
$(document).ready(function() {
    $("#discount").on("input", function() {
        var value = $(this).val();
        
        // Allow only numbers and one decimal point
        var numericValue = value.replace(/[^0-9.]/g, "");
        
        // Ensure only one decimal point and limit to two decimal places
        if ((numericValue.match(/\./g) || []).length > 1) {
            numericValue = numericValue.substring(0, numericValue.lastIndexOf("."));
        }
        
        // Limit to two decimal places if there is a decimal point
        if (numericValue.includes(".")) {
            var parts = numericValue.split(".");
            numericValue = parts[0] + "." + parts[1].substring(0, 2);
        }
        
        var floatValue = parseFloat(numericValue);
        
        // Restrict value between 1 and 100
        if (isNaN(floatValue)) {
            floatValue = "";
        } else if (floatValue > 100) {
            floatValue = 100;
        } else if (floatValue < 1) {
            floatValue = "";
        }
        
        $(this).val(floatValue);
    });
});


    </script>
@endsection
