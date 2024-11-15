(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.check = () => {
        $('.add_wishlist').on('change', function () {
            const _this = $(this);
            TGNT.call(_this.val(), _this.data('type'))
            if (_this.data('type') == 'add') {
                _this.data('type', 'remove')
            } else {
                _this.data('type', 'add')
            }

        })
    }

    TGNT.call = (product_id, type) => {
        console.log(type, product_id);
        let url = ''
        if (type == 'add') {
            url = '/yeu-thich/add-wishlist'
        } else {
            url = '/yeu-thich/remove-wishlist'
        }
        $.ajax({
            url: url,
            type: "GET",
            data: {
                product_id: product_id,
            },
            dataType: "json",
            beforeSend: function () {
                // $(".loading_tgnt").fadeIn("slow");
            },
            success: function (res) {
                console.log(res);
                VDmessage.show('success', res.message)
                // $(".loading_tgnt").fadeOut("slow");
            },
        });

    }


    $(document).ready(function () {
        TGNT.check();
    });

})(jQuery);