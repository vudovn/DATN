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
        let productId = $(this).data('id');
        let productName = $(this).data('name');
        let productPrice = $(this).data('price');
        let quantity = 1;
    
        let existingRow = $('#product-table-body').find(`tr[data-id="${productId}"]`);
        if (existingRow.length > 0) {
            let currentQuantityInput = existingRow.find('.product-quantity');
            quantity = parseInt(currentQuantityInput.val()) + 1;
            currentQuantityInput.val(quantity);
    
            let totalPrice = quantity * productPrice;
            existingRow.find('.total-price').text(formatNumber(totalPrice) + ' VNĐ');
        } else {
            $('#product-table-body').append(`
                <tr data-id="${productId}">
                    <td>${productId}</td>
                    <td>${productName}</td>
                    <td class='fix-input'>
                        <input type="number" value="${quantity}" class="product-quantity" data-price="${productPrice}" min="1" style="width: 60px;">
                    </td>
                    <td>${formatNumber(productPrice)} VNĐ</td>
                    <td class="total-price">${formatNumber(quantity * productPrice)} VNĐ</td>
                    <td><button class="btn btn-danger btn-sm rounded delete-product-btn">Xóa</button></td>
                </tr>
            `);
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


