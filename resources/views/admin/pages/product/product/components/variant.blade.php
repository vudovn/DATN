<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <label for="" class="d-flex align-items-center mb-0" style="gap: 10px">
                Sản phẩm có nhiều phiên bản
                <div class="custom-control custom-switch">
                    <input type="checkbox" value="1" name="has_attribute" class="custom-control-input turnOnVariant"
                        id="customSwitch">
                    <label class="custom-control-label" for="customSwitch"></label>
                </div>
            </label>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="attribute_container_product">
                    <div class="form-group">
                        <div class="alert alert-primary">
                            <strong class="text-danger">*</strong> Cho phép bạn tạo nhiều phiên bản sản phẩm với các
                            thuộc tính khác nhau
                        </div>
                        <div class="variant-wrapper hidden">
                            <div class="variant-container row">
                                {{-- <div class="col-3">
                                <p class="mb-2 text-primary">Chọn thuộc tính</p>
                            </div>
                            <div class="col-3">
                                <p class="mb-2 text-primary">Chọn giá trị của thuộc tính</p>
                            </div> --}}
                            </div>
                            <div class="variant-body mb-3">
                                {{-- <div class="row variant-item">
                                <div class="col-3">
                                    <select class="form-control niceSelect" id="attribute_product_1"
                                        name="attribute_product_1">
                                        <option value="">Chọn thuộc tính</option>
                                        <option value="1">Màu sắc</option>
                                        <option value="1">Chất liệu</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="" disabled class="fake-variant form-control custom_input">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger custom_btn">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div> --}}
                            </div>
                            <div class="variant-foot">
                                <div class="parent-add-variant">
                                    <button type="button" class="btn btn-primary add-variant">
                                        Thêm phiên bản mới
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card product-variant">
        <div class="card-header">
            Danh sách phiên bản sản phẩm
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table variantTable ">

                    {{-- <thead>
                        <tr class="bg-dark">
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Màu sắc</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">SKU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="variant-row">
                            <td>
                                <span class="img img-cover">
                                    <img width="50" class="rounded" src="https://placehold.co/600x600?text=The%20Gioi\nNoi%20That" alt="">
                                </span>
                            </td>
                            <td>Đỏ</td>
                            <td>100</td>
                            <td>100.000</td>
                            <td>SKU-001</td>
                        </tr>
                    </tbody> --}}
                </table>
            </div>
            <td colspan="10">
                <div class="updateVariant card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Cập nhật thông tin phiên bản</span>
                            <div>
                                <button type="button" class="btn btn-danger cancleUpdate">
                                    <i class="fa fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-primary saveUpdate">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="control-label text-left">Hình ảnh sản phẩm</label>
                            <div class="card">
                                <div class="card-body pb-2">
                                    @php
                                        // $gallery = old($name, $value ?? '');
                                    @endphp
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="upload-list mt-2">
                                                <ul id="sortableVariant"
                                                    class="albums-variant row align-items-center list-unstyled clearfix data-album sortui ui-sortable"
                                                    style="margin-bottom:0 !important">
                                                    <li
                                                        class="col-xl-2 col-md-3 col-sm-6 mb-3 d-flex justify-content-center align-items-center">
                                                        <a style="font-size: 50px" class="upload-picture-variant"
                                                            data-name="albumsVariant">
                                                            <i class="fa-duotone fa-solid fa-cloud-arrow-up"></i>
                                                        </a>
                                                    </li>

                                                    @if (isset($gallery) && $gallery != '')
                                                        @foreach ($gallery as $key => $val)
                                                            <li
                                                                class="ui-state-default img_li_tgnt col-xl-2 col-md-3 col-sm-6 mb-3">
                                                                <div class="thumb img_albums_tgnt">
                                                                    <span class="span image img-scaledown">
                                                                        <a href="{{ $val }}"
                                                                            data-fancybox="gallery" data-caption="">
                                                                            <img width="100%" class="img-thumbnail"
                                                                                src="{{ $val }}"
                                                                                alt="">
                                                                        </a>
                                                                        <input type="hidden"
                                                                            name="{{ $name }}[]"
                                                                            value="{{ $val }}">
                                                                    </span>
                                                                    <div class="text-center btn_delete_albums_tgnt">
                                                                        <a class="delete-image btn btn-sm btn-danger">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row price-group">
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="sku">SKU <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="sku" id="sku"
                                        value="">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="sku">Số lượng <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="sku" id="sku"
                                        value="">
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
                                        <input type="text" name="price" class="form-control" placeholder="">
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
                                        <input type="number" max="100" name="discount" class="form-control"
                                            placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </div>
    </div>
</div>
<script>
    var attributeCatalogue = @json(
        $attributes->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                ];
            })->values());
</script>
