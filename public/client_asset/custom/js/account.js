(function ($) {
    "use strict";

    var TGNT = {};
    const VDmessage = new VdMessage();
    const _token = $('meta[name="csrf-token"]').attr("content");

    TGNT.editUser = () => {
        const form = $("form.edit-account-form");
        const saveButton = $(".saveEditAccount");
        const originalValues = {};
        form.find("input").each(function () {
            const input = $(this);
            originalValues[input.attr("name")] = input.val();
        });
        saveButton.prop("disabled", true);
        form.find("input").on("input", function () {
            let isChanged = false;
            form.find("input").each(function () {
                const input = $(this);
                const name = input.attr("name");
                if (input.val() !== originalValues[name]) {
                    isChanged = true;
                }
            });
            saveButton.prop("disabled", !isChanged);
        });
        saveButton.on("click", function (e) {
            e.preventDefault();
            const url = form.attr("action");
            const data = form.serialize();
            const name = form.find('input[name="name"]').val().trim();
            const email = form.find('input[name="email"]').val().trim();
            const phone = form.find('input[name="phone"]').val().trim();
            if (!name) {
                VDmessage.show("error", "Vui lòng nhập họ tên");
                return;
            }
            if (!email) {
                VDmessage.show("error", "Vui lòng nhập email");
                return;
            }
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "json",
                success: function (res) {
                    VDmessage.show(
                        res.status ? "success" : "error",
                        res.message
                    );
                    if (res.status) {
                        form.find("input").each(function () {
                            const input = $(this);
                            originalValues[input.attr("name")] = input.val();
                        });
                        saveButton.prop("disabled", true);
                        $(".account_name").text(name);
                        $(".account_email").text(email);
                        $(".account_phone").text(phone);
                    }
                },
                error: function () {
                    VDmessage.show("error", "Có lỗi xảy ra, vui lòng thử lại.");
                },
            });
        });
    };

    $(document).ready(function () {
        TGNT.editUser();
    });
})(jQuery);
