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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <x-input :label="'Tên sản phẩm'" :name="'name'" :class="'name-product'" :value="$product->name ?? old('name')"
                                    :required="true" />
        
                                <div class="form-group">
                                    <label for="short_description">Mô tả ngắn</label>
                                    <textarea class="form-control" name="short_description" id="short_description"
                                        rows="3">{{ $product->short_description ?? old('short_description') }}</textarea>
                                </div>
                                {{--  --}}
                                <div class="row price-group">
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="sku" id="sku" value="{{ $product->sku ?? old('sku') }}">
                                            @error('sku')
                                            <small class="error text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="quantity">Số lượng <span class="text-danger">*</span></label>
                                            <input class="form-control int" value="{{ $product->quantity ?? old('quantity') }}" type="text" name="quantity" id="quantity" value="">
                                            @error('quantity')
                                                <small class="error text-danger">{{ $message }}</small>
                                            @enderror
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
                                                <input type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control int" placeholder="">
                                            </div>
                                        </div>
                                        @error('price')
                                                <small class="error text-danger">{{ $message }}</small>
                                            @enderror
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
                                                <input type="number" max="100" name="discount" value="{{ $product->discount ?? old('discount') }}" class="form-control "
                                                    placeholder="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            @error('discount')
                                                <small class="error text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <x-album :label="'Hình ảnh sản phẩm'" :name="'albums'" :value="$product->album ?? old('albums')" />
                                <x-editor :label="'Mô tả sản phẩm'" :name="'description'" :value="$product->description ?? old('description')" class="form-control" />
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
                <x-thumbnail :label="'Ảnh sản phẩm'" :name="'thumbnail'" :value="$product->thumbnail ?? 'https://placehold.co/600x600?text=The Gioi \nNoi That'" />
                <div class="card">
                    <div class="card-header">
                        Chọn danh mục
                    </div>
                    <div class="card-body">
                        @php
                            $oldCategory = old('category') ?? [];
                        @endphp
                       <select name="category" class=" form-control @error('category')is-invalid @enderror" id="">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            @php
                                if($category['is_room'] != 2) continue;
                            @endphp
                            <option value="{{ $category['id'] }}" {{ in_array($category['id'], (old('category') ?? [])) ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Chọn danh mục phòng
                    </div>
                    <div class="card-body">
                        <select name="category_id[]" class="select2 form-control @error('category')is-invalid @enderror" multiple id="">
                            <option value="" disabled>Chọn danh mục</option>
                            @foreach ($categories as $category)
                                @php
                                    if($category['is_room'] != 1 ) continue;
                                @endphp
                                <option value="{{ $category['id'] }}" {{ in_array($category['id'], (old('category') ?? [])) ? 'selected' : '' }}>{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Sản phẩm nổi bật
                    </div>
                    <div class="card-body">
                        <select name="is_featured" class="select2 form-control" id="">
                            <option value="">Sản phẩm</option>
                            <option value="1" {{ $product->discount ?? old('is_featured') == '1' ? 'selected' : ''}}>Nổi bật</option>
                            <option value="2" {{ $product->discount ?? old('is_featured') == '2' ? 'selected' : ''}}>Không nổi bật</option>
                        </select>
                    </div>
                </div>
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$product->publish ?? old('publish')" />
            </div>

        </div>
    </x-form>
   
@endsection
