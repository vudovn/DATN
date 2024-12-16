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
                    VDmessage.show("success", res.message);
                    if (dataType == "remove") {
                        _this
                            .closest(".product_item")
                            .fadeOut("slow", function () {
                                $(this).remove();
                                if ($(".listProduct").html().trim() == "") {
                                    $(".listProduct").html(`
                                                                <div class="col-12 py-15 animate__animated animate__fadeIn">
                                <div class="text-center">
                                    <img class="mb-3 mb-3" width="100"
                                        src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png"
                                        alt="">
                                    <p>Chưa có sản phẩm yêu thích nào!</p>
                                    <a class="btn btn-tgnt" href="${$(
                                        ".listProduct"
                                    ).data("url-home")}">Thêm ngay</a>
                                </div>
                            </div>
                                        `);
                                }
                            });

                        // _this.closest(".product_item").remove();
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
