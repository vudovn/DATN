(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    TGNT.addItem = (message = null, sku, quantity, price) => {
        let url = "/gio-hang/store";
        if (!sku || !quantity || !price) {
            VDmessage.show("error", "Dữ liệu không hợp lệ!");
            return;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: {
                sku,
                quantity,
                price,
            },
            success: function (data) {
                if (message) {
                    VDmessage.show("success", message);
                }
                TGNT.cartCount();
            },
            error: function (data) {
                VDmessage.show("error", "Chức năng của người đăng nhập!");
            },
        });
    };
    TGNT.buyNow = () => {
        $(document).on("click", ".buyNow", function () {
            let message = "Mua ngay";
            let sku = $(this).attr("data-sku");
            let quantity = $("#quantity").val();
            let inventory = $(".inventory").val();
            let price = $("#price").val();
            if (inventory > 0) {
                TGNT.addItem(message, sku, quantity, price);
                window.location.href = "/gio-hang";
            } else {
                VDmessage.show("error", "Đã hết hàng");
            }
        });
    };
    TGNT.addToCart = () => {
        $(document).on("click", ".addToCart", function () {
            let message = "Thêm vào giỏ hàng thành công";
            let sku = $(this).attr("data-sku");
            let quantity = $("#quantity").val();
            let price = $("#price").val();
            let inventory = $(".inventory").val();
            if (inventory > 0) {
                TGNT.addItem(message, sku, quantity, price);
            } else {
                VDmessage.show("error", "Đã hết hàng");
            }
        });
    };
    TGNT.addMultiToCart = () => {
        $(document).on("click", ".addMultiToCart", function () {
            let skuItems = [];
            let names = document.querySelectorAll('input[name="name[]"]');
            let skus = document.querySelectorAll('input[name="sku[]"]');
            let prices = document.querySelectorAll('input[name="price[]"]');
            let inventories = document.querySelectorAll(
                'input[name="inventory[]"]'
            );
            let productIds = document.querySelectorAll(
                'input[name="product_id[]"]'
            );
            for (let i = 0; i < productIds.length; i++) {
                let name = names[i].value;
                let sku = skus[i].value;
                let price = prices[i].value;
                let inventory = inventories[i].value;
                let productId = productIds[i].value;
                skuItems.push({
                    sku: sku,
                    name: name,
                    quantity: 1,
                    inventory: inventory,
                    price: price,
                    product_id: productId,
                });
            }
            let outOfStockItem = skuItems.find((e) => e.inventory <= 0);
            if (outOfStockItem) {
                VDmessage.show(
                    "error",
                    `Sản phẩm: "${outOfStockItem.name}" đã hết hàng`
                );
                return;
            }
            skuItems.forEach((e) => {
                TGNT.addItem(null, e.sku, e.quantity, e.price);
            });
            let message = "Thêm bộ sưu tập vào giỏ hàng";
            VDmessage.show("success", message);
        });
    };
    TGNT.cartCount = () => {
        let url = "/gio-hang/count";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "GET",
            url: url,
            success: function (data) {
                $(".cart_count").html(data);
            },
            error: function (data) {
                console.log("Lỗi");
            },
        });
    };

    $(document).ready(function () {
        TGNT.buyNow();
        TGNT.addToCart();
        TGNT.addMultiToCart();
        // TGNT.cartCount();
    });
})(jQuery);
