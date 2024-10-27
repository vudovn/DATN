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




$(document).ready(function(){
    let productsData = []; // Lưu trữ sản phẩm được lấy từ API
    
    $('#product-search').on('input', function(){
        let query = $(this).val();
        if(query.length > 0){
            $.ajax({
                // url: "{{ route('order.dataProduct') }}",
                url: `/order/dataProduct`,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    productsData = data;
                    let filteredProducts = data.filter(product => 
                        product.name.toLowerCase().includes(query.toLowerCase())
                    );

                    let dropdown = $('#product-dropdown');
                    dropdown.empty(); 
                    if (filteredProducts.length > 0) {
                        filteredProducts.forEach(product => {
                            dropdown.append(`<div class="product-dropdown-item" data-id="${product.id}" data-name="${product.name}" data-price="${product.price}">${product.name}</div>`);
                        });
                        dropdown.removeClass('d-none');
                    } else {
                        dropdown.addClass('d-none');
                    }
                },
                error: function(){
                    alert('Không thể tải dữ liệu sản phẩm!');
                }
            });
        } else {
            $('#product-dropdown').addClass('d-none');
        }
    });

    // Xử lý khi chọn sản phẩm từ danh sách thả xuống
    $(document).on('click', '.product-dropdown-item', function(){
        let productId = $(this).data('id');
        let productName = $(this).data('name');
        let productPrice = $(this).data('price');
        let quantity = 1; // Mặc định số lượng là 1, có thể điều chỉnh

        // Tính tổng tiền
        let totalPrice = quantity * productPrice;

        // Thêm sản phẩm vào bảng
        $('#product-table-body').append(`
            <tr>
                <td>${productId}</td>
                <td>${productName}</td>
                <td class='fix-input'><input type="number" value="${quantity}" class="product-quantity" data-price="${productPrice}" style="width: 60px;"></td>
                <td>${productPrice} VNĐ</td>
                <td class="total-price">${totalPrice} VNĐ</td>
            </tr>
        `);

        // Ẩn dropdown và xóa từ khóa tìm kiếm
        $('#product-search').val('');
        $('#product-dropdown').addClass('d-none');
    });

    // Cập nhật tổng tiền khi thay đổi số lượng sản phẩm
    $(document).on('input', '.product-quantity', function(){
        let quantity = $(this).val();
        let price = $(this).data('price');
        let totalPrice = quantity * price;
        $(this).closest('tr').find('.total-price').text(totalPrice + ' VNĐ');
    });
});
