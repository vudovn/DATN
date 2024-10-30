(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.select_status = () => {
        $(document).on("change", ".select_status", function () {
            const statusId = $(this).val();
            const orderId = $(this).data("id");
            const name = $(this).attr('name');
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
    }

    $(document).ready(function () {
        TGNT.select_status();
    });
})(jQuery);




$(document).ready(function () {
    let productsData = []; // Lưu trữ sản phẩm được lấy từ API

    $('#product-search').on('input', function () {
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: `/order/dataProduct`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    productsData = data;
                    let filteredProducts = data.filter(product =>
                        product.name.toLowerCase().includes(query.toLowerCase())
                    );

                    let dropdown = $('#product-dropdown');
                    dropdown.empty();
                    if (filteredProducts.length > 0) {
                        filteredProducts.forEach(product => {
                            dropdown.append(`<div class="product-dropdown-item" data-id="${product.id}" data-name="${product.name}" data-price="${product.price}" data-sku="${product.sku}" data-thumbnail="${product.thumbnail}">${product.name}</div>`);
                        });
                        dropdown.removeClass('d-none');
                    } else {
                        dropdown.addClass('d-none');
                    }
                },
                error: function () {
                    alert('Không thể tải dữ liệu sản phẩm!');
                }
            });
        } else {
            $('#product-dropdown').addClass('d-none');
        }
    });

    $(document).on('click', '.product-dropdown-item', function () {
        let _this = $(this);
        let id = _this.data('id');
        let productName = _this.data('name');
        let productSku = _this.data('sku');
        let productPrice = _this.data('price');
        let productQuantity = _this.data('quantity');
    
        $('#product-dropdown').addClass('d-none');
    
        $.ajax({
            url: `/order/dataVariantsProduct/${id}`,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data.data);
    
                $('#product-variant').empty();
    
                if (data.data && data.data.length > 0) {
                    let html = `<option value="">Chọn biến thể</option>`;
                    data.data.forEach((item) => {
                        html += `<option value="${item.id}" data-sku="${item.sku}" data-name="${productName}" data-price="${item.price}" data-quantity="${item.quantity}">${item.title}</option>`;
                    });
    
                    $("#product-variant").append(html);
                    $("#product-variant").removeClass('d-none');
                } else {
                    $("#product-variant").addClass('d-none');
                    addProductToTable(productName, null, productSku, productPrice, productQuantity , id);
                }
            },
            error: function (xhr, status, error) {
                console.error("Có lỗi xảy ra:", error);
            }
        });
    
        $(document).off('change', '#product-variant').on('change', '#product-variant', function () {
            let selectOption = $(this).find('option:selected');
            let productName = selectOption.data('name');
            let variant = selectOption.text();
            let sku = selectOption.data('sku');
            let price = selectOption.data('price');
            let quantity = selectOption.data('quantity');
            let product_id = selectOption.val();
    
            if (selectOption.val()) {
                addProductToTable(productName, variant, sku, price, quantity, product_id);
            }
        });
    
        function addProductToTable(productName, variant, sku, price, quantity,product_id) {
            let existingRow = $(`#product-table-body tr[data-sku="${sku}"]`);
    
            if (existingRow.length > 0) {
                let quantityInput = existingRow.find('.quantity');
                let newQuantity = parseInt(quantityInput.val()) + 1;
                quantityInput.val(newQuantity);
                updateTotalPrice(existingRow, newQuantity, price);
            } else {
                let variantText = variant ? ` - ${variant}` : '';
                let html = `<tr data-sku="${sku}">
                            <td>${sku || ''}</td> 
                            <td>${productName}${variantText}</td>
                            <td><input type="number" name="quantity[]" value="1" class="form-control quantity form-control-sm" data-price="${price}" /></td>
                            <td><span class="product-price">${formatNumber(price)}</span></td> 
                            <td><span class="total-price">${formatNumber(price)}</span></td>
                            <td>
                                <input name="sku[]" value="${sku}" />
                                <input name="product_id[]" value="${product_id}"/>
                                <input name="name_orderDetail[]" value="${productName}${variantText}" />
                                <input name="price[]" value="${price}" />
                                
                            </td>
                            <td><button class="btn btn-danger remove-product">Xóa</button></td>
                        </tr>`;
                $('#product-table-body').append(html);
            }
            calculateTotalAmount();
        }
    
        function updateTotalPrice(row, quantity, price) {
            let totalPrice = quantity * price;
            row.find('.total-price').text(formatNumber(totalPrice) + ' VNĐ');
            calculateTotalAmount();
        }
    });
    
    $(document).on('input', '.quantity', function () {
        let quantity = $(this).val();
        let price = $(this).data('price');
        let totalPrice = quantity * price;
        $(this).closest('tr').find('.total-price').text(formatNumber(totalPrice) + ' VNĐ');
        console.log(totalPrice);    
        
    
        calculateTotalAmount();
    });
    

    $('#product-table-body').on('click', '.delete-product-btn', function () {
        $(this).closest('tr').remove();
        calculateTotalAmount();
    });

    $(document).on('input', '.product-quantity', function () {
        let quantity = $(this).val();
        let price = $(this).data('price');
        let totalPrice = quantity * price;
        $(this).closest('tr').find('.total-price').text(totalPrice + ' VNĐ');

        calculateTotalAmount();
    });

    $('#product-table-body').on('click', '.delete-product-btn', function () {
        $(this).closest('tr').remove();
    });
});

// Hàm định dạng số tiền
function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Hàm tính tổng tiền
function calculateTotalAmount() {
    let totalAmount = 0;

    $('#product-table-body .total-price').each(function () {
        let priceText = $(this).text().replace(' VNĐ', '').replace(/\./g, '').trim();
        let price = parseInt(priceText);
        totalAmount += price;
    });

    $('#total_amount').val(formatNumber(totalAmount) + ' VNĐ');
}


