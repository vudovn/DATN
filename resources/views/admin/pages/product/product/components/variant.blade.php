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
            <div class="form-group mb-0">
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
                <table class="table variantTable">

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
