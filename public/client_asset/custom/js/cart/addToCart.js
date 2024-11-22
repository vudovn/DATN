(function ($) {
    "use strict";
    var TGNT = {};

    TGNT.loadCart = () => {
        $(document).on('click',".buyNow", function(){
            let _this = $(this);
            let id = _this.data('id');
            let sku = _this.data('sku');
            let quantity = $('#quantity').val();
            let price = $('#price').val();
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

                },
                error: function (data) {

                }
            })
        })
    };
    
$(document).ready(function () {
    TGNT.loadCart();
});

})(jQuery);