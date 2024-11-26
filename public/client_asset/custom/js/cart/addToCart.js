(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    TGNT.addToCart = () => {
        $(document).on("click", ".addToCart", function () {
            let _this = $(this);
            let id = _this.data("id");
            let sku = _this.attr("data-sku");
            let quantity = $("#quantity").val();
            let price = $("#price").val();
            let url = "/gio-hang/store";
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: url,
                data: {
                    id,
                    sku,
                    quantity,
                    price,
                },
                success: function (data) {
                    VDmessage.show(
                        "success",
                        "Thêm sản phẩm vào giỏ hàng thành công"
                    );
                    TGNT.cartCount();
                },
                error: function (data) {
                    VDmessage.show(
                        "error",
                        "Chức năng của người đăng nhập!"
                    );
                },
            });
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
        TGNT.addToCart();
        TGNT.cartCount();
    });
})(jQuery);

