(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.select_status = () => {
        $(document).on('focus', 'select[name="status"]', function () {
            $(this).attr('data-original-value', $(this).val());
        });
        $(document).on("change", ".select_status", function () {
            const statusId = $(this).val();
            const orderId = $(this).data("id");
            const name = $(this).attr("name");
            const old_value = $(this).attr('data-original-value');

            if (name === 'status') {
                const paymentStatus = $(this).parents('tr').find('select[name="payment_status"]').val();
                if (paymentStatus === "completed") {
                    if (statusId === "delivered") {
                        $(this).parents('tr').addClass('bg-blue-100')
                            .find('input, select, button, a, ul').attr('disabled', true);
                        $(this).parents('tr').find('.btn_delete').addClass('disabled_row');
                        $(this).parents('tr').find('.btn_edit').addClass('disabled_row');
                        $(this).parents('tr').find('.btn_link').addClass('disabled_row');
                        $(this).parents('tr').find('input[type="checkbox"]').remove();
                    }
                } else {
                    if (statusId === "delivered") {
                        VDmessage.show('warning', 'Trạng thái thanh toán chưa hoàn thành');
                        $(this).val(old_value);
                        return false;
                    }
                }
            }

            $.ajax({
                url: `/order/payment-status/${orderId}`,
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    [name]: statusId,
                },
                dataType: "JSON",
                success: () => {
                    VDmessage.show("success", "Trạng thái đã được cập nhật!");
                },
                error: (xhr) => {
                    VDmessage.show("error", xhr.responseJSON.message);
                },
            });
        });
    };

    TGNT.getProduct = () => {
        let typingTimer;
        const typingDelay = 500;
        const $productSearch = $("#product-search");
        const $productDropdown = $("#product-dropdown");

        $productSearch.on("input", function () {
            let query = $(this).val().trim();
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                if (query.length > 0) {
                    $productDropdown
                        .empty()
                        .removeClass("d-none")
                        .append(
                            `  <div class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div> `
                        );

                    $.ajax({
                        url: `/order/dataProduct`,
                        method: "GET",
                        dataType: "json",
                        success: function (data) {
                            TGNT.renderDropdown(data.data);
                        },
                        error: function () {
                            $productDropdown.html(
                                "<div class='text-danger'>Không thể tải dữ liệu sản phẩm!</div>"
                            );
                        },
                    });
                } else {
                    $productDropdown.addClass("d-none");
                }
            }, typingDelay);
        });
    };

    TGNT.getVariant = () => {
        $(document).on("click", ".get-variant-btn", function () {
            let _this = $(this);
            let productId = _this.data("id");
            let thumbnail = _this.data("thumbnail");
            let name = _this.data("name");

            $.ajax({
                url: `/order/dataVariantsProduct/${productId}`,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const productVariants = [];

                    data.data.forEach((item) => {
                        productVariants.push({
                            id: productId,
                            sku: item.sku,
                            name: name + " - " + item.title,
                            price: item.price,
                            thumbnail: thumbnail,
                            quantity: 1,
                        });
                    });
                    TGNT.renderDropdown(productVariants);
                },
                error: function () {
                    VDmessage.show("error", "Không thể tải dữ liệu biến thể!");
                },
            });
        });
    };

    TGNT.renderDropdown = (data) => {
        const query = $("#product-search").val().trim().toLowerCase();
        const filteredProducts = data.filter((product) =>
            product.name.toLowerCase().includes(query)
        );
        const $dropdown = $("#product-dropdown");
        $dropdown.empty();

        if (filteredProducts.length > 0) {
            filteredProducts.forEach((product) => {
                $dropdown.append(
                    `<div class="product-dropdown-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="${product.thumbnail}" alt="${product.name
                    }" class="product-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                            <div class="product-details">
                                <div class="product-name">${product.name}</div>
                                <div class="product-price">${TGNT.formatNumber(
                        product.price
                    )} VND</div>
                            </div>
                        </div>
                        <div class="product-action">
                            ${product.has_attribute == 1
                        ? `<button type="button" class="btn btn-primary btn-sm get-variant-btn" 
                                        data-id="${product.id}" 
                                        data-name="${product.name}"
                                        data-thumbnail="${product.thumbnail}">
                                        Chọn biến thể
                                    </button>`
                        : `<button type="button" class="btn btn-primary btn-sm add-product-btn" 
                                        data-id="${product.id}" 
                                        data-name="${product.name}" 
                                        data-price="${product.price}" 
                                        data-sku="${product.sku}" 
                                        data-thumbnail="${product.thumbnail}">
                                        Thêm
                                    </button>`
                    }
                        </div>
                    </div>`
                );
            });
            $dropdown.removeClass("d-none");
        } else {
            $dropdown
                .append(
                    "<div class='text-muted'>Không có sản phẩm phù hợp.</div>"
                )
                .removeClass("d-none");
        }
    };

    TGNT.addToTable = () => {
        $(document).on("click", ".add-product-btn", function () {
            let _this = $(this);
            let productData = {
                id: _this.data("id"),
                name: _this.data("name"),
                price: _this.data("price"),
                sku: _this.data("sku"),
                thumbnail: _this.data("thumbnail"),
                quantity: 1,
            };
            TGNT.renderRow(productData);
            $("#product-search").val("");
            $("#product-dropdown").addClass("d-none");
            TGNT.calculateTotalAmount();
        });
    };


    TGNT.checkProduct = () => {
        console.log(sku);
        if (Array.isArray(productVariants) && productVariants.length > 0) {
            $("#product-table-body").html("")
            productVariants.forEach((product) => {
                TGNT.renderRow(product);
            });
            TGNT.calculateTotalAmount();
        }
    };

    TGNT.select2 = () => {
        if ($(".select2_order").length) {
            $(".select2_order").select2({
                theme: "bootstrap4",
            });
        }
    };

    // =======================================================--====4
    TGNT.searchCustomer = () => {
        let debounceTimer;
        $('.search-customer').on('input', function () {
            const phoneNumber = $(this).val().trim();
    
            clearTimeout(debounceTimer); // Xóa bỏ debounce trước đó nếu có
            debounceTimer = setTimeout(() => {
                if (phoneNumber) {
                    $.ajax({
                        url: `/order/search_customer`,
                        method: 'GET',
                        data: { phone: phoneNumber },
                        dataType: 'json',
                        success: function (response) {
                            if (response.data?.success && response.data.customer) {
                                VDmessage.show('success', 'Đã tìm thấy khách hàng');
                                const customer = response.data.customer;
                                $('input[name="name"]').val(customer.name || '');
                                $('input[name="email"]').val(customer.email || '');
                                $('input[name="phone"]').val(customer.phone || '');
                                $('input[name="address"]').val(customer.address || '');
                                $('#customer_note').val(customer.note || '');
    
                                if (customer.province_id) {
                                    $('select[name="province_id"] option[value="' + customer.province_id + '"]').prop('selected', true);
                                }
    
                                if (customer.district_id) {
                                    $('select[name="district_id"] option[value="' + customer.district_id + '"]').prop('selected', true);
                                }
    
                                if (customer.ward_id) {
                                    $('select[name="ward_id"] option[value="' + customer.ward_id + '"]').prop('selected', true);
                                }
                                TGNT.select2();
                            } else {
                                VDmessage.show('error', 'Không tồn tại khách hàng');
                            }
                            console.log(response);
                        },
                        error: function () {
                            VDmessage.show('error', 'Không tồn tại khách hàng');
                        }
                    });
                } else {
                    VDmessage.show('warning', 'Vui lòng nhập số điện thoại trước khi tìm kiếm.');
                }
            }, 1000); // Debounce 500ms
        });
    };
    

    $(document).ready(function () {
        TGNT.select_status();
        TGNT.getProduct();
        TGNT.addToTable();
        TGNT.checkProduct();
        TGNT.select2();
        // =================
        TGNT.searchCustomer();
    });
})(jQuery);
