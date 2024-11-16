(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.check = () => {
        $('.add_wishlist').on('change', function () {
            const _this = $(this);
            const productId = _this.val();
            const actionType = _this.data('type');
    
            // Gọi hàm xử lý thêm hoặc xoá
            TGNT.call(productId, actionType);
    
            // Thay đổi giá trị data-type để cập nhật hành động (add/remove)
            if (actionType == 'add') {
                _this.data('type', 'remove');
                _this.prop('checked', true); // Đánh dấu checkbox là checked khi thêm vào danh sách
            } else {
                _this.data('type', 'add');
                _this.prop('checked', false); // Bỏ đánh dấu checkbox khi xoá khỏi danh sách
            }
        });
    }

    TGNT.remove = () => {
        $('.remove_wishlist').on('change', function () {
            const _this = $(this);
            TGNT.call(_this.val(), _this.data('type'))
            _this.parents('.wishlist-item').remove();
        })
    }

    TGNT.call = (product_id, type) => {
        console.log(type, product_id);
        let url = '';
        if (type == 'add') {
            url = '/yeu-thich/add-wishlist';
        } else {
            url = '/yeu-thich/remove-wishlist';
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
                $(".loading_tgnt").fadeOut("slow");
            },
        });
    }

    $(document).ready(function () {
        TGNT.check();
        TGNT.remove();
    });

})(jQuery);