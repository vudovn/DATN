(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.check = () => {
        $(".action_wishlist").on("change", function () {
            const _this = $(this);
            const productId = _this.val();
            const dataType = _this.data("type");
            if (_this.data("login") == false) {
                VDmessage.show(
                    "error",
                    "Vui lòng đăng nhập để thực hiện chức năng này"
                );
                _this.prop("checked", false);
                return;
            }
            let url = "/yeu-thich/ajax/action-wishlist";
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    product_id: productId,
                },
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    VDmessage.show("success", res.message);
                    if (dataType == "remove") {
                        _this.closest(".product_item").remove();
                    }
                    $(".wishlist_count").text(res.data.count);
                },
            });
        });
    };
    TGNT.countWishList = () => {
        let url = "/yeu-thich/ajax/count-wishlist";
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (res) {
                $(".wishlist_count").text(res.data);
            },
        });
    };

    $(document).ready(function () {
        TGNT.check();
    });
})(jQuery);
