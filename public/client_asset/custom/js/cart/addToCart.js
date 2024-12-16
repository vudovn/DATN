(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let skuItems = [];
    TGNT.addItem = (message = null, sku, quantity, price) => {
        if (!sku || !quantity || !price) {
            VDmessage.show("error", "Dữ liệu không hợp lệ!");
            return;
        }
        let url = "/gio-hang/store";
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
            error: function (xhr) {
                if (xhr.status === 401) {
                    VDmessage.show(
                        "error",
                        "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!"
                    );
                } else {
                    VDmessage.show(
                        "error",
                        "Lỗi hệ thống, vui lòng thử lại sau!"
                    );
                }
            },
        });
    };
    TGNT.buyNow = () => {
        $(document).on("click", ".buyNow", function () {
            if (!window.isLoggedIn) {
                VDmessage.show("error", "Chức năng của người đăng nhập!");
            } else {
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
            }
        });
    };
    TGNT.addToCart = () => {
        $(document).on("click", ".addToCart", function () {
            if (!window.isLoggedIn) {
                VDmessage.show("error", "Chức năng của người đăng nhập!");
            } else {
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
            }
        });
    };
    TGNT.addMultiToCart = () => {
        $(document).on("click", ".addMultiToCart", function () {
            if (!window.isLoggedIn) {
                VDmessage.show("error", "Chức năng của người đăng nhập!");
                return;
            } else {
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
            }
        });
    };
    TGNT.getProductInCollection = () => {
        $(document).on("click", ".getCollection", function () {
            $(".checkboxsku").each(function () {
                if (!$(this).is(":checked")) {
                    $(this).trigger("click");
                }
            });
        });
    };
    TGNT.checkProduct = () => {
        $(document).on("change", ".check-collection", function () {
            let sku = $(this).data("sku");
            let inventory = $(this).data("inventory");
            let price = $(this).data("price");
            let name = $(this).data("name");
            if ($(`#checkboxsku-${sku}`).is(":checked")) {
                skuItems.push({
                    sku: sku,
                    quantity: 1,
                    inventory: inventory,
                    price: price,
                    name: name,
                });
            } else {
                skuItems = skuItems.filter((item) => item.sku !== sku);
            }
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
    TGNT.removeItem = () => {
        $(document).on("click", ".removeItem", function () {
            let _this = $(this);
            let sku = _this.data("sku");
            $(`#cart-item-${sku}`).remove();
            skuItems = skuItems.filter((item) => item.sku !== sku);
        });
    };
    $(document).ready(function () {
        TGNT.buyNow();
        TGNT.addToCart();
        TGNT.getProductInCollection();
        TGNT.addMultiToCart();
        // TGNT.cartCount();
        TGNT.checkProduct();
        TGNT.removeItem();
        // TGNT.cartCount();
    });
})(jQuery);
