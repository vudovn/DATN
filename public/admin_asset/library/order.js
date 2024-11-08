(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.select_status = () => {
        $(document).on("change", ".select_status", function () {
            const statusId = $(this).val();
            const orderId = $(this).data("id");
            const name = $(this).attr("name");
            $.ajax({
                url: `/order/payment-status/${orderId}`,
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                            <img src="${product.thumbnail}" alt="${
                        product.name
                    }" class="product-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                            <div class="product-details">
                                <div class="product-name">${product.name}</div>
                                <div class="product-price">${TGNT.formatNumber(
                                    product.price
                                )} VND</div>
                            </div>
                        </div>
                        <div class="product-action">
                            ${
                                product.has_attribute == 1
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

    TGNT.renderRow = (product) => {
        let existingRow = $("#product-table-body").find(
            `tr[data-id="${product.id}"]`
        );
        if (existingRow.length > 0) {
            let currentQuantityInput = existingRow.find(".product-quantity");
            product.quantity = parseInt(currentQuantityInput.val()) + 1;
            currentQuantityInput.val(product.quantity);
            let totalPrice = product.quantity * product.price;
            existingRow
                .find(".total-price")
                .text(TGNT.formatNumber(totalPrice));
        } else {
            $("#product-table-body").append(`
                <tr data-id="${product.id}">
                   <td>
                       <a href="${product.thumbnail}" data-fancybox="gallery">
                           <img src="${product.thumbnail}" alt="${
                product.name
            }" class="product-thumbnail">
                       </a>
                   </td>
                    <td>${product.sku}</td>
                    <td class="text-wrap">${product.name}</td>
                    <td class='fix-input'>
                        <input type="number" value="${
                            product.quantity
                        }" class="product-quantity form-control" data-price="${
                product.price
            }" min="1" max="5" style="width: 60px;">
                    </td>
                    <td>${TGNT.formatNumber(product.price)}</td>
                    <td class="total-price">${TGNT.formatNumber(
                        product.total ?? product.price  *  product.quantity
                    )}</td>
                    <td><button type="button" class="btn btn-danger btn-sm rounded delete-product-btn">Xóa</button></td>
                    <td class="hidden">
                        <input type="text" name="product_id[]" value="${
                            product.id
                        }">
                        <input type="text" class="product_quantity_input" name="quantity[]" value="${
                            product.quantity
                        }">
                        <input type="text"  name="price[]" value="${
                            product.price
                        }">
                        <input type="text" name="name_orderDetail[]" value="${
                            product.name
                        }">
                        <input type="text" name="sku[]" value="${product.sku}">
                        <input type="text" name="thumbnail[]" value="${
                            product.thumbnail
                        }">
                        <input type="text" name="total[]" value="${
                            product.total ?? product.price
                        }">
                    </td>
                </tr>
            `);
        }
    };

    TGNT.calculateTotalAmount = () => {
        let totalAmount = 0;
        $("#product-table-body .total-price").each(function () {
            let priceText = $(this)
                .text()
                .replace("", "")
                .replace(/\./g, "")
                .trim();
            let price = parseInt(priceText);
            totalAmount += price;
        });
        $("#total_amount").val(TGNT.formatNumber(totalAmount));
        $(".total_amount").text(TGNT.formatNumber(totalAmount));
    };

    TGNT.updateQuantity = () => {
        $(document).on("input", ".product-quantity", function () {
            let quantity = $(this).val();
            let price = $(this).data("price");
            let totalPrice = quantity * price;

            $(this).closest("tr").find(".product_quantity_input").val(quantity);
            $(this)
                .closest("tr")
                .find(".total-price")
                .text(TGNT.formatNumber(totalPrice));

            TGNT.calculateTotalAmount();
        });
    };

    TGNT.deleteProduct = () => {
        $(document).on("click", ".delete-product-btn", function () {
            $(this).closest("tr").remove();
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

    TGNT.formatNumber = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    // =======================================================--====4
    TGNT.searchCustomer = () => {
        $('.btn-search-customer').on('click', function() {
            const phoneNumber = $('.search-customer').val().trim();
    
            if (phoneNumber) {
                $.ajax({
                    url: `/order/search_customer`, 
                    method: 'GET',
                    data: { phone: phoneNumber },
                    dataType: 'json',
                    success: function(response) {
                        if (response.data.success && response.data.customer) {
                            VDmessage.show('success', 'Đã tìm thấy khách hàng');
                            const customer = response.data.customer;
                            
                            // Cập nhật thông tin khách hàng
                            $('input[name="name"]').val(customer.name);
                            $('input[name="email"]').val(customer.email);
                            $('input[name="phone"]').val(customer.phone);
                            $('input[name="address"]').val(customer.address);
                            $('#customer_note').val(customer.note || '');
                            
                            // Kiểm tra và update các trường select
                            if (customer.province_id) {
                                $('select[name="province_id"]').val(customer.province_id).trigger('change');
                            }
                            if (customer.district_id) {
                                $('select[name="district_id"]').val(customer.district_id).trigger('change');
                            }
                            if (customer.ward_id) {
                                $('select[name="ward_id"]').val(customer.ward_id).trigger('change');
                            }
                        } else {
                            VDmessage.show('error', 'Không tồn tại khách hàng');
                            $('input[name="name"], input[name="email"], input[name="address"]').val('');
                            $('#customer_note').val('');
                            $('select[name="province_id"], select[name="district_id"], select[name="ward_id"]').val('').trigger('change');
                        }
                        console.log(response);
                    },
                    error: function() {
                        VDmessage.show('error', 'Không tồn tại khách hàng');
                    }
                });
            } else {
                alert('Vui lòng nhập số điện thoại trước khi tìm kiếm.');
            }
        });
    };
    

    $(document).ready(function () {
        TGNT.select_status();
        TGNT.getProduct();
        TGNT.addToTable();
        TGNT.updateQuantity();
        TGNT.deleteProduct();
        TGNT.getVariant();
        TGNT.checkProduct();
        TGNT.calculateTotalAmount();

        // =================
        TGNT.searchCustomer();
    });
})(jQuery);
