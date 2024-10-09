@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$product ?? null">
        <div class="row">
            <!-- Cột bên trái chứa các thông tin cơ bản -->
            <div class="col-lg-9 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Thông tin cơ bản
                    </div>
                    <div class="card-body">
                        <x-album :label="'Hình ảnh sản phẩm'" :name="'albums'" :value="$product->album ?? ''" />
                        <x-editor :label="'Mô tả sản phẩm'" :name="'description'" :value="$product->description ?? ''" class="form-control" />
                        {{-- SEO --}}
                        <x-seo :value_meta_title="$product->meta_title ?? ''" :value_meta_description="$product->meta_description ?? ''" :value_meta_keywords="$product->meta_keywords ?? ''" />
                    </div>
                </div>
            </div>

            <!-- Cột bên phải chứa các thông tin bổ sung -->
            <div class="col-lg-3 col-md-12 mb-4">
                <x-save_back  :model="$config['model']"/>
                <x-thumbnail :label="'Ảnh sản phẩm'" :name="'thumbnail'" :value="$product->thumbnail ?? '/uploads/system/no_img.jpg'" />
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$product->publish ?? ''" />
            </div>

        </div>
    </x-form>
@endsection
