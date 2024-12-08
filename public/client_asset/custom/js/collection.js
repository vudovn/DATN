(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    TGNT.renderJs = () => {
        $(".point").each((index, element) => {
            var popover = new bootstrap.Popover(
                document.getElementById(element.id),
                {
                    trigger: "focus",
                }
            );
        });
    };


    TGNT.removeProduct = () => { //aaaaaaaaaaaaaaaaaaaaaa
        $(document).on("click", "#removeItem", function () {
            let _this = $(this);
            let id = _this.data("id");
            let skuProduct = _this.attr("data-productSku");
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
                },
                success: function (data) {
                    VDmessage.show("success", "Đã xoá sản phẩm khỏi giỏ hàng");
                    $(`#cart-item-${id}`).remove();
                    let divSku = $(`.cart-item[data-productSku="${skuProduct}"]`);
                    divSku.each(function () {
                        let id = $(this).data("id");
                        TGNT.getProduct(id)
                            .then((productHtml) => {
                                $(`#cart-item-${id}`).replaceWith(productHtml);
                            })
                            .catch((error) => {
                                console.error("Error fetching product:", error);
                            });
                    });
                },
                error: function (data) {},
            });
        });
    };

    $(document).ready(function () {
        TGNT.renderJs();
        TGNT.removeProduct();
    });
})(jQuery);
