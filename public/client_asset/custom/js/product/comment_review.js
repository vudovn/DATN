(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let user_id = "";

    TGNT.render = () => {
        $.ajax({
            url: "/san-pham/ajax/get-review",
            type: "GET",
            data: {
                product_id: product_id,
            },
            dataType: "json",
            success: function (res) {
                $(".tab_review_tgnt").html(res.data);
            },
            error: function (err) {
                console.log(err);
            },
        });
    };

    TGNT.add_review = () => {
        $(".add_review_tgnt").on("click", function () {
            const _this = $(this);
            const form = _this.closest("form");
            let rate = 0;
            form.find("input[name=star-radio]").each(function () {
                if ($(this).is(":checked")) {
                    rate = Math.max(rate, $(this).val());
                }
            });
            const content = form.find("textarea[name=content]").val();

            if (!rate) {
                VDmessage.show("error", "Vui lòng chọn số sao đánh giá");
                return;
            }
            if (!content) {
                VDmessage.show("error", "Vui lòng nhập nội dung đánh giá");
                return;
            }

            $.ajax({
                url: "/san-pham/ajax/add-review",
                type: "POST",
                data: {
                    product_id: product_id,
                    rating: rate,
                    content: content,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (res) {
                    if (res.status) {
                        VDmessage.show("success", res.message);
                        TGNT.render();
                        form.find("input[name=star-radio]:checked").prop(
                            "checked",
                            false
                        );
                        form.find("textarea[name=content]").val("");
                        $(".modal").modal("hide");
                    } else {
                        VDmessage.show(
                            "error",
                            "Có lỗi xảy ra, vui lòng thử lại sau"
                        );
                    }
                },
                error: function (err) {
                    console.log(err);
                },
            });
        });
    };

    $(document).ready(function () {
        TGNT.render();
        TGNT.add_review();
    });
})(jQuery);
