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
                },
                error: function (data) {},
            });
        });
    };
    TGNT.cartCount = () => {
        let _this = $(this);
        let url = "/gio-hang/count";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            success: function (data) {
                VDmessage.show(
                    "success",
                    "Thêm sản phẩm vào giỏ hàng thành công"
                );
            },
            error: function (data) {},
        });
    };
    $(document).ready(function () {
        TGNT.addToCart();
        TGNT.cartCount();
    });
})(jQuery);
