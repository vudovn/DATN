@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$category ?? null">
        <div class="row">
            <!-- Cột bên trái chứa các thông tin cơ bản -->
            <div class="col-lg-9 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Thông tin cơ bản
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            <strong>Lưu ý:</strong> <span class="text-danger">(*)</span> là trường bắt buộc nhập
                        </div>
                        <x-input :label="'Tên danh mục'" :name="'name'" :value="$category->name ?? ''" :required="true" />
                    </div>
                </div>
                {{-- SEO --}}
                <x-seo :value_meta_title="$category->meta_title ?? ''" :value_meta_description="$category->meta_description ?? ''" :value_meta_keywords="$category->meta_keywords ?? ''" />
            </div>
            <!-- Cột bên phải chứa các thông tin bổ sung -->
            <div class="col-lg-3 col-md-12 mb-4">
                <x-save_back :model="$config['model']" />
                <x-thumbnail :label="'Ảnh danh mục'" :name="'thumbnail'" :value="$category->thumbnail ?? '/uploads/system/no_img.jpg'" :require="true" />
                @if (isset($config['method']) && $config['method'] !== 'edit')

                
                    <div class="card">
                        <label class="card-header">Loại danh mục</label>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_room" id="is_room_yes"
                                    value="1">
                                <label class="form-check-label" for="is_room_yes">Phòng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_room" id="is_room_no" value="2"
                                    checked>
                                <label class="form-check-label" for="is_room_no">Danh mục khác</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <label for="parent_id" class="card-header">
                            Danh mục cha
                        </label>
                        <div class="card-body">
                            <select name="parent_id" class="form-control js-choice">
                                <option value="0">Danh mục gốc</option>
                                {!! $categoryOptions !!}
                            </select>
                        </div>
                    </div>
                    <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$category->publish ?? ''"
                        :require="true" />
                @else
                    <div class="card">
                        <label class="card-header">Loại danh mục</label>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_room" id="is_room_yes"
                                    value="1" {{ $category->is_room == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_room_yes">Phòng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_room" id="is_room_no" value="2"
                                    {{ $category->is_room == 2 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_room_no">Danh mục khác</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <label for="parent_id" class="card-header">
                            Chọn danh mục cha
                        </label>
                        <div class="card-body">
                            <select name="parent_id" class="form-select js-choice">
                                <option value="{{ $category->parent_id }}">
                                    {{ $category->parent ? $category->parent->name : 'Danh mục gốc' }}</option>
                                {!! $categoryOptions !!}
                            </select>
                        </div>
                    </div>
                    <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$category->publish ?? ''" />
                @endif
            </div>
        </div>
    </x-form>
@endsection
