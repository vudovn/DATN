(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

    TGNT.select_status = () => {
        $(document).on("change", ".select_status", function () {
            const statusId = $(this).val();
            const orderId = $(this).data("id");
            const name = $(this).attr('name');
            $.ajax({
                url: `/order/payment-status/${orderId}`, 
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    [name]: statusId,
                },
                dataType: "JSON",
                success: () => {
                    VDmessage.show("success", "Trạng thái đã được cập nhật!");
                },
                error: (xhr) => {
                    VDmessage.show("error", xhr.responseJSON.message);
                },
            });
        });
    }
    
        $(document).ready(function () {
            TGNT.select_status();
        });
})(jQuery);
