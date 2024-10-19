(function ($) {
    "use strict";
    var TGNT = {};
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });

    TGNT.requestUrl = () => {
        $(document).on("change", ".select_action", function () {
            let _this = $(this);
            console.log(_this.attr("name"));
            let url = new URL(window.location.href);
            let search_params = url.searchParams;
            search_params.set(_this.attr("name"), _this.val());
            url.search = search_params.toString();
            console.log(url);

            window.location.href = url.href;
        });
    };

    TGNT.changeStatusByField = () => {
        $(document).on("change", ".status", function (e) {
            var Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            let _this = $(this);
            let attributes = {
                field: _this.attr("data-field"),
                value: _this.attr("data-value"),
                model: _this.attr("data-model"),
                id: _this.attr("data-id"),
            };

            $.ajax({
                url: "/change/status",
                type: "PUT",
                data: attributes,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    _this.attr("data-value") == 1
                        ? _this.attr("data-value", 2)
                        : _this.attr("data-value", 1);
                    _this.attr("data-publish") == 1
                        ? _this.attr("data-publish", 2)
                        : _this.attr("data-publish", 1);
                    Toast.fire({
                        icon: "success",
                        title: "Cập nhật trạng thái thành công",
                    });
                },
                error: function (error) {
                    Toast.fire({
                        icon: "error",
                        title: "Cập nhật trạng thái thất bại",
                    });
                },
            });
        });
    };

    TGNT.setupAjaxHeader = () => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            },
        });
    };

    TGNT.checkBoxItem = () => {
        if ($(".checkbox-item").length) {
            $(document).on("click", ".checkbox-item", function () {
                let _this = $(this);
                TGNT.changeBackgroud(_this);
                TGNT.allChecked();
                TGNT.handleMultipleAction();
            });
        }
    };

    TGNT.changeBackgroud = (input) =>
        input.closest("tr").toggleClass("active-bg", input.prop("checked"));

    TGNT.allChecked = () => {
        let checkBoxs = $(".checkbox-item");
        $("#checkAll").prop(
            "checked",
            checkBoxs.length &&
                checkBoxs.filter(":checked").length === checkBoxs.length
        );
    };

    TGNT.checkAll = () => {
        let checkAll = $("#checkAll");
        if (checkAll.length) {
            $(document).on("click", "#checkAll", function () {
                let isChecked = checkAll.prop("checked");
                $(".checkbox-item")
                    .prop("checked", isChecked)
                    .each(function () {
                        TGNT.changeBackgroud($(this));
                    });
                TGNT.handleMultipleAction();
            });
        }
    };

    TGNT.handleMultipleAction = () => {
        $("#actions")
            .parent()
            .toggle($(".checkbox-item:checked").length > 0);
    };

    TGNT.hideActions = () => {
        $("#actions").parent().hide();
    };

    TGNT.action = () => {
        if ($("#actions").length) {
            $(document).on("change", "#actions", function () {
                let _this = $(this);
                let method = _this.val() === "delete" ? "DELETE" : "PUT";
                let ids = TGNT.getIds();

                if (ids.length === 0) {
                    alert("Adu hacker!");
                    return false;
                }

                Swal.fire({
                    title: "Bạn có chắc không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm!",
                    cancelButtonText: "Cancel",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/actions",
                            type: method,
                            data: {
                                option: _this.val(),
                                model: $("#model").val(),
                                ids: ids,
                            },
                            dataType: "JSON",
                            success: function (response) {
                                let option = _this.val().split("-");
                                if (option[0] != "delete") {
                                    let isActive =
                                        option[1] == 1 ? true : false;
                                    for (let i = 0; i < ids.length; i++) {
                                        $(".js-switch-" + ids[i])
                                            .find(".js-switch")
                                            .attr(
                                                "data-value",
                                                option[1] == 1 ? 1 : 2
                                            );
                                        $(".js-switch-" + ids[i])
                                            .find(".js-switch")
                                            .attr(
                                                "data-publish",
                                                option[1] == 1 ? 1 : 2
                                            );
                                        $(".js-switch-" + ids[i])
                                            .find(".js-switch")
                                            .attr("checked", isActive);
                                    }
                                } else {
                                    for (let i = 0; i < ids.length; i++) {
                                        $("#customCheckbox" + ids[i])
                                            .parents("tr")
                                            .remove();
                                    }
                                }

                                $(".checkbox-item").prop("checked", false);
                                $("#checkAll").prop("checked", false);
                                TGNT.hideActions();
                                $(".table").find("tr").removeClass("active-bg");

                                var Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: "Thực hiện thành công hành động",
                                });
                            },
                            error: function (error) {
                                console.error(error);
                            },
                        });
                    }
                });
            });
        }
    };

    TGNT.getIds = () => {
        return $(".checkbox-item:checked")
            .map(function () {
                return $(this).val();
            })
            .get();
    };

    TGNT.delete_item = () => {
        $(document).on("click", "#delete_tgnt", function () {
            const _this = $(this);
            const id = _this.data("id");
            const model = _this.data("model");
            const deleteAxis = _this.data("axis");
            const url = "/" + model + "/delete";
            console.log(url);
            
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            // console.log(_this.attr('data-id'));
            Swal.fire({
                title: "Bạn có chắc không?",
                text: "Khi xóa sẽ không thể hoàn tác được!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa!",
                cancelButtonText: "Hủy",
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            model,
                            id,
                        },
                        dataType: "JSON",
                        success: function () {
                            deleteAxis === "column"
                                ? $(
                                      `th[data-axis="${id}"], td[data-axis="${id}"]`
                                  ).remove()
                                : _this.closest("tr").remove();
                            Toast.fire({
                                icon: "success",
                                title: "Xóa thành công",
                            });
                        },
                        error: function () {
                            Toast.fire({
                                icon: "error",
                                title: "Xóa không thành công",
                            });
                        },
                    });
                }
            });
        });
    };

    //     $(document).on("click", "#delete_tgnt", function () {
    //         var Toast = Swal.mixin({
    //             toast: true,
    //             position: "top-end",
    //             showConfirmButton: false,
    //             timer: 3000,
    //         });

    //         let _this = $(this);

    //         // console.log(_this.attr('data-id'));
    //         Swal.fire({
    //             title: "Bạn có chắc không?",
    //             text: "Khi xóa sẽ không thể hoàn tác được!",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Xóa!",
    //             cancelButtonText: "Hủy",
    //             reverseButtons: true,
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     url: "/deleteItem",
    //                     type: "DELETE",
    //                     data: {
    //                         _token: $('meta[name="csrf-token"]').attr(
    //                             "content"
    //                         ),
    //                         model: _this.attr("data-model"),
    //                         id: _this.attr("data-id"),
    //                     },
    //                     dataType: "JSON",
    //                     success: function (response) {
    //                         _this.closest("tr").remove();
    //                         Toast.fire({
    //                             icon: "success",
    //                             title: "Xóa thành công",
    //                         });
    //                     },
    //                     error: function (error) {
    //                         Toast.fire({
    //                             icon: "success",
    //                             title: "Xóa không thành thành công",
    //                         });
    //                     },
    //                 });
    //             }
    //         });
    //     });
    // };
    TGNT.permission_to_role = () => {
        let timeout = "";
        $(document).on("click", ".permission_to_role", function () {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            const _this = $(this);
            _this.attr("disabled", true);
            const permissionName = _this.attr("data-permissionName");
            const roleId = _this.attr("data-roleId");
            const isChecked = _this.is(":checked") ? "checked" : "nochecked";
            $.ajax({
                url: "/user/permission/update",
                type: "PUT",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    permissionName: permissionName,
                    roleId: roleId,
                    is_checked: isChecked,
                },
                dataType: "JSON",
                success: function (response) {
                    _this.attr("is_checked", isChecked);
                    clearTimeout(timeout);

                    setTimeout(() => {
                        _this.attr("disabled", false);
                    }, 1000);

                    timeout = setTimeout(() => {
                        Toast.fire({
                            icon: "success",
                            title: "Cập nhật quyền thành công",
                        });
                    }, 2000);
                },
                error: function () {
                    Toast.fire({
                        icon: "error",
                        title: "Cập nhật quyền không thành công",
                    });
                },
            });
        });
    };
    TGNT.quick_update = () => {
        $(document).ready(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });

            $(".quick_update").on("dblclick", function () {
                let inputUpdate = $("#" + $(this).data("input-id"));
                inputUpdate.removeClass("hidden").focus();
                $(this).addClass("hidden");
            });

            $(document).on("click", function (event) {
                $(".quick_update").each(function () {
                    const _this = $(this);
                    let inputUpdate = $("#" + _this.data("input-id"));

                    if (
                        !_this.is(event.target) &&
                        !inputUpdate.is(event.target) &&
                        !inputUpdate.hasClass("hidden")
                    ) {
                        inputUpdate.addClass("hidden");
                        _this.removeClass("hidden");

                        const value = inputUpdate.val().trim();
                        const model = _this.data("model");
                        const name = _this.attr("name");
                        const id = _this.data("id");
                        const url = "/" + model + "/update"
                        console.log(url);
                        
                        $.ajax({
                            url: url,
                            type: "PUT",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: {
                                model,
                                name,
                                id,
                                value,
                            },
                            dataType: "JSON",
                            success: () => {
                                _this.text(value || "...");
                                Toast.fire({
                                    icon: "success",
                                    title: "Cập nhật thành công!",
                                });
                            },
                            error: (xhr) => {
                                Toast.fire({
                                    icon: "error",
                                    title: xhr.responseJSON.message,
                                });
                            },
                        });
                    }
                });
            });
        });
    };

    TGNT.tagify = () => {
        if ($(".tagify_tgnt").length) {
            new Tagify($(".tagify_tgnt"));
        }
    };

    TGNT.select2 = () => {
        if ($(".select2").length) {
            $(".select2").select2({
                theme: "bootstrap4",
            });
        }
    };

    TGNT.sortui = () => {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
        $("#sortableVariant").sortable();
        $("#sortableVariant").disableSelection();
    };

    TGNT.int = () => {
        $(document).on("change keyup blur", ".int", function () {
            let _this = $(this);
            let value = _this.val();
            if (value === "") {
                $(this).val("0");
            }
            value = value.replace(/\./gi, "");
            _this.val(TGNT.addCommas(value));
            if (isNaN(value)) {
                _this.val("0");
            }
        });

        $(document).on("keydown", ".int", function (e) {
            let _this = $(this);
            let data = _this.val();
            if (data == 0) {
                let unicode = e.keyCode || e.which;
                if (unicode != 190) {
                    _this.val("");
                }
            }
        });
    };

    TGNT.addCommas = (nStr) => {
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str = "";
        for (let i = nStr.length; i > 0; i -= 3) {
            let a = i - 3 < 0 ? 0 : i - 3;
            str = nStr.slice(a, i) + "." + str;
        }
        str = str.slice(0, str.length - 1);
        return str;
    };

    $(document).ready(function () {
        TGNT.setupAjaxHeader();
        TGNT.changeStatusByField();
        TGNT.checkBoxItem();
        TGNT.checkAll();
        TGNT.hideActions();
        TGNT.action();
        TGNT.delete_item();
        TGNT.select2();
        TGNT.tagify();
        TGNT.sortui();
        TGNT.requestUrl();
        TGNT.permission_to_role();
        TGNT.quick_update();
        TGNT.int();
    });
})(jQuery);
