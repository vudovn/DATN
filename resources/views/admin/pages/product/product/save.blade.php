@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$product ?? null">
        <div class="row">
            <!-- Cột bên trái chứa các thông tin cơ bản -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Thông tin sản phẩm
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-album :label="'Hình ảnh sản phẩm'" :name="'albums'" :value="$product->album ?? ''" />

                        <x-editor :label="'Mô tả sản phẩm'" :name="'description'" :value="$product->description ?? ''" class="form-control" />
                    </div>
                </div>
            </div>

            <!-- Cột bên phải chứa các thông tin bổ sung -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        Thông tin bổ sung
                        <div class="card-tools">
                            <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-thumbnail :label="'Ảnh sản phẩm'" :name="'thumbnail'" :value="$product->thumbnail ?? '/uploads/system/no_img.jpg'" />
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <x-seo :value_meta_title="$product->meta_title ?? ''" :value_meta_description="$product->meta_description ?? ''" :value_meta_keywords="$product->meta_keywords ?? ''" />
        </div>
        <x-button :label="'Lưu'" :class="'btn-success'" />
    </x-form>
@endsection
