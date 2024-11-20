(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.removeCart = () => {
        $(document).on('click',"#removeItem", function(){
            let _this = $(this);
            let id = _this.data('id');
            let url = "/gio-hang/remove";
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
                    VDmessage.show('success', "Đã xoá sản phẩm khỏi giỏ hàng");
                    $(`#cart-item-${id}`).remove();
                },
                error: function (data) {

                }
            })
        })
    };
$(document).ready(function () {
    TGNT.removeCart();
});

})(jQuery);