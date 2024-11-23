(function ($) {
    "use strict";

    var TGNT = {};
    const VDmessage = new VdMessage();
    const _token = $('meta[name="csrf-token"]').attr("content");

    TGNT.editUser = () => {
        const form = $("form.edit-account-form");
        const saveButton = $(".saveEditAccount");
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

            if (phone && phone.length < 10) {
                VDmessage.show("error", "Số điện thoại không hợp lệ");
                return;
            }

            if (!email) {
                VDmessage.show("error", "Vui lòng nhập email");
                return;
            }
            if (!TGNT.validateEmail(email)) {
                VDmessage.show("error", "Email không hợp lệ");
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
                        $(".info_account").html(res.data);
                    }
                },
                error: function () {
                    VDmessage.show("error", "Có lỗi xảy ra, vui lòng thử lại.");
                },
            });
        });
    };

    TGNT.changePassUser = () => {
        const form = $("form.change-pass-account-form");
        const saveButton = $(".changePassAccount");

        saveButton.on("click", function (e) {
            e.preventDefault();
            const url = form.attr("action");
            const data = form.serialize();
            const password_old = form
                .find('input[name="password_old"]')
                .val()
                .trim();
            const password = form.find('input[name="password"]').val().trim();
            const password_c = form
                .find('input[name="password_c"]')
                .val()
                .trim();

            if (!password_old) {
                VDmessage.show("error", "Vui lòng nhập mật khẩu cũ.");
                return;
            }
            if (!password) {
                VDmessage.show("error", "Vui lòng nhập mật khẩu mới.");
                return;
            }
            if (password_old === password) {
                VDmessage.show(
                    "error",
                    "Mật khẩu mới không được trùng với mật khẩu cũ."
                );
                return;
            }
            if (password.length < 8) {
                VDmessage.show(
                    "error",
                    "Mật khẩu mới phải chứa ít nhất 6 ký tự,"
                );
                return;
            }
            if (!password_c) {
                VDmessage.show("error", "Vui lòng nhập xác nhận mật khẩu.");
                return;
            }
            if (password !== password_c) {
                VDmessage.show("error", "Mật khẩu xác nhận không khớp.");
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
                        $(".change-pass-account-form")[0].reset();
                    }
                },
                error: function () {
                    VDmessage.show("error", "Có lỗi xảy ra, vui lòng thử lại.");
                },
            });
        });
    };

    TGNT.validateEmail = (email) => {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return re.test(email);
    };

    // order
    let searchTimeout = "";
    let array = {
        perpage: 3,
        sort: "id,asc",
        keyword: null,
        page: 1,
    };

    TGNT.searchForm = () => {
        $(".keyword_order").on("input", function () {
            clearTimeout(searchTimeout);
            array.keyword = $(this).val();
            array.page = 1;
            searchTimeout = setTimeout(() => TGNT.loadOrderAll(array), 500);
        });
    };

    TGNT.loadOrderAll = (params = {}) => {
        $.ajax({
            url: $("form.search_order_all").attr("action"),
            type: "GET",
            data: params,
            beforeSend: function () {
                $(".list_all_order").html(
                    `
                        <div class="text-center pt-10">
                            <div class="spinner-border text-tgnt" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `
                );
            },
            success: function (res) {
                $(".list_all_order").html(res.data);
            },
        });
    };
    TGNT.loadOrderStatus = (status, url) => {
        $.ajax({
            url: url,
            type: "GET",
            beforeSend: function () {
                $(`.list_${status}_order`).html(
                    `
                        <div class="text-center pt-10">
                            <div class="spinner-border text-tgnt" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `
                );
            },
            success: function (res) {
                $(`.list_${status}_order`).html(res.data);
            },
        });
    };

    TGNT.paginationForm = () => {
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            array.page = page;
            TGNT.loadOrderAll(array);
        });
    };

    TGNT.orderStatus = () => {
        $(".order_status").on("click", function () {
            TGNT.loadOrderStatus($(this).data("status"), $(this).data("url"));
        });
    };

    $(document).ready(function () {
        TGNT.editUser();
        TGNT.changePassUser();
        TGNT.searchForm();
        TGNT.paginationForm();
        TGNT.loadOrderAll(array);
        TGNT.orderStatus();
    });
})(jQuery);
