@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$product ?? null">
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
                                <x-input :label="'Tên sản phẩm'" :name="'name'" :class="'name-product'" :value="$product->name ?? ''"
                                    :required="true" />
        
                                <div class="form-group">
                                    <label for="short_description">Mô tả ngắn</label>
                                    <textarea class="form-control" name="short_description" id="short_description"
                                        rows="3">{{ $product->short_description ?? '' }}</textarea>
                                </div>
                                {{--  --}}
                                <div class="row price-group">
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="sku" id="sku" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="quantity">Số lượng <span class="text-danger">*</span></label>
                                            <input class="form-control int" value="0" type="text" name="quantity" id="quantity" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="price"> Giá tiền <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" name="price" value="0" class="form-control int" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="sale_price">
                                                Giảm giá
                                            </label>
        
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" max="100" name="discount" class="form-control "
                                                    placeholder="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <x-album :label="'Hình ảnh sản phẩm'" :name="'albums'" :value="$product->album ?? ''" />
                                <x-editor :label="'Mô tả sản phẩm'" :name="'description'" :value="$product->description ?? ''" class="form-control" />
                            </div>
                        </div>
                    </div>

                    @include('admin.pages.product.product.components.variant')

                    <div class="col-lg-12">
                         <x-seo :value_meta_title="$product->meta_title ?? ''" :value_meta_description="$product->meta_description ?? ''" :value_meta_keywords="$product->meta_keywords ?? ''" />
                    </div>
                </div>
            </div>

            <!-- thông tin bổ sung -->
            <div class="col-lg-3 col-md-12 mb-4">
                <x-save_back :model="$config['model']" />
                <x-thumbnail :label="'Ảnh sản phẩm'" :name="'thumbnail'" :value="$product->thumbnail ?? 'https://placehold.co/600x600?text=The Gioi\nNoi That'" />
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$product->publish ?? ''" />
            </div>

        </div>
    </x-form>
   
@endsection
