(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let user_id = "";
    TGNT.checkTab = () => {
        let url = new URL(window.location.href);
        let tab = url.searchParams.get("tab");
        if (tab === "comment") {
            $("#pills-comment-tab").click();
        }
        $(document).on("click", "#pills-comment-tab", function () {
            $(this).prop("disabled", true);
            setTimeout(() => {
                $(this).prop("disabled", false);
            }, 2000);
            if (product_id && product_id !== 0 && product_id !== "") {
                $("#pills-comment").html(
                    `
                        <div class="p-3 px-xxl-15 py-xxl-15 text-center">
                            <div class="spinner-border text-tgnt " role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `
                );
                TGNT.loadComment(product_id);
                // TGNT.loadCommentReply(product_id);
            }
        });
    };

    TGNT.loadComment = (product_id) => {
        let url = "/binh-luan/loadComment";
        $.ajax({
            type: "GET",
            url: url,
            data: {
                product_id: product_id ?? "",
            },
            success: function (response) {
                setTimeout(() => {
                    let html = TGNT.formComment(
                        "formComment",
                        user_id == "" ? 0 : user_id,
                        null,
                        product_id
                    );
                    $.each(response, function (key, value) {
                        if (value.parent_id == null) {
                            html += TGNT.addCommentParent(value);
                        }
                    });
                    $("#pills-comment").html(html);
                    $.each(response, function (key, value) {
                        if (value.parent_id) {
                            if (
                                $(`.list-reply-${value.parent_id}`).length !== 0
                            ) {
                                $(`.list-reply-${value.parent_id}`).prepend(
                                    TGNT.addCommentReply(value)
                                );
                            } else {
                                $(`#commentReply-${value.parent_id}`).after(
                                    TGNT.addCommentReply(value)
                                );
                            }
                        }
                    });
                    $.each(response, function (key, value) {
                        if (!value.parent_id) {
                            let count = document.querySelectorAll(
                                `.list-reply-${value.id} .commentReply`
                            ).length;
                            $(`#countComment${value.id}`).prepend(count);
                        }
                    });
                }, 500);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
    // TGNT.loadCommentReply = (id) => {
    //     let url = "/binh-luan/getReplyComment";
    //     $.ajax({
    //         type: "GET",
    //         url: url,
    //         data: {
    //             id: id ?? "",
    //         },
    //         success: function (response) {
    //             $.each(response, function (key, value) {
    //                 if (value.parent_id) {
    //                     if (
    //                         $(`.list-reply-${value.parent_id}`).length !== 0
    //                     ) {
    //                         $(`.list-reply-${value.parent_id}`).prepend(
    //                             TGNT.addCommentReply(value)
    //                         );
    //                     } else {
    //                         $(`#commentReply-${value.parent_id}`).after(
    //                             TGNT.addCommentReply(value)
    //                         );
    //                     }
    //                 }
    //             });
    //         },
    //         error: function (error) {
    //             console.error("Error:", error);
    //         },
    //     });
    // };
    TGNT.btnLoadCommentReply = () => {
        $(document).on("click", ".btnShow", function () {
            let _this = $(this);
            let id = _this.data("id");
            TGNT.loadCommentReply(id);
        });
    };
    TGNT.addCommentParent = (comment) => {
        if (comment) {
            let data = `
            <div class="p-3 px-xxl-15">
                <div class="d-flex border-bottom pb-6 mb-6">
                    <img src="${comment.avatar}" alt=""
                        class="rounded-circle avatar-lg">
                    <div class="ms-5">
                        <h6 class="mb-1 text-tgnt">${comment.name}</h6>
                        <p class="small m-0 me-2">
                            <span class="text-muted">${TGNT.formatDateTime(
                                comment.created_at
                            )}</span>
                        </p>
                        <p class="m-0">${comment.content}</p>
                        <button class="btnShow btn btn-link text-tgnt p-0 " type="button" data-id="${
                            comment.id
                        }" id="countComment${comment.id}">Phản hồi</button>
                        <button data-product_id="${
                            comment.product_id
                        }" data-parent_id="${comment.id}" data-user_id="${
                comment.user_id
            }" data-status="noactive"
                            class="btn btn-link text-tgnt btnReply p-0" style="font-size:12px">Phản hồi
                        </button>

                        <button data-product_id="${
                            comment.product_id
                        }" data-parent_id="${comment.id}" data-user_id="${
                comment.user_id
            }" data-status="noactive"
                            class="btn btn-link text-tgnt btnEdit p-0" style="font-size:12px">Chỉnh sửa
                        </button>
                        <div class="list-reply-${comment.id}"></div>
                    </div>
                </div>
            </div>`;
            return data;
        }
    };
    TGNT.addCommentReply = (comment) => {
        if (comment) {
            let data = `
            <div class="commentReply d-flex mt-2 ms-3 border-start ps-4" id="commentReply-${
                comment.id
            }">
                <img src="${comment.avatar}"
                    alt="" class="rounded-circle avatar-sm">
                <div class="ms-4">
                    <h6 class="mb-1 text-tgnt">${comment.name}</h6>
                    <p class="small m-0 me-2">
                        <span class="text-muted">${TGNT.formatDateTime(
                            comment.created_at
                        )}</span>
                    </p>
                    <p class="m-0">
                        <strong class="text-tgnt">${
                            comment.parent_name
                        }</strong>  ${comment.content}
                    </p>
                    <button data-product_id="${
                        comment.product_id
                    }" data-parent_id="${comment.id}" data-user_id="${
                comment.user_id
            }" data-status="noactive"
                        class="btn btn-link text-tgnt btnReply p-0" style="font-size:12px">Phản hồi
                    </button>
                </div>
            </div>`;
            return data;
        }
    };
    TGNT.addFormComment = () => {
        $(document).on("click", ".btnReply", function () {
            let _this = $(this);
            let status = _this.data("status");
            let product_id = _this.data("product_id");
            let parent_id = _this.data("parent_id");
            let user_id = _this.data("user_id");
            $(".btnReply").each(function () {
                if ($(this).data("status") === "active" && this !== _this[0]) {
                    $(this).next(".formReply").remove();
                    $(this).data("status", "noactive");
                }
            });

            if (status === "noactive") {
                if (!_this.next(".formReply").length) {
                    _this.after(
                        TGNT.formComment(
                            "formReply",
                            user_id == "" ? 0 : user_id,
                            parent_id,
                            product_id
                        )
                    );
                    _this.data("status", "active");
                }
            } else {
                _this.next(".formReply").remove();
                _this.data("status", "noactive");
            }
        });
    };
    TGNT.formComment = (
        formType = "",
        user_id = "",
        parent_id = "",
        product_id = "",
        content = ""
    ) => {
        return `
            <form class="${formType} animate__animated animate__fadeIn">
                <input type="hidden" name="user_id" value="${user_id}">
                <input type="hidden" name="parent_id" value="${parent_id}">
                <input type="hidden" name="product_id" value="${product_id}">
                <textarea name="content" class="form-control w-100" rows="2" cols="100">${content}</textarea>
                <div class="text-end">
                    <button type="submit" class="btn btn-tgnt mt-2">Gửi</button>
                </div>
            </form>
        `;
    };
    TGNT.commentSubmit = () => {
        $(document).on("submit", ".formComment", function (e) {
            e.preventDefault();
            let _this = $(this);
            let data = new URLSearchParams(_this.serialize());
            const dataObject = {};
            data.forEach((value, key) => {
                dataObject[key] = value;
            });
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/binh-luan",
                data: dataObject,
                success: function (response) {
                    TGNT.loadComment(product_id);
                    // TGNT.loadCommentReply(product_id);
                },
                error: function (error) {
                    console.error("Error:", error);
                },
            });
        });
    };
    TGNT.replySubmit = () => {
        $(document).on("submit", ".formReply", function (e) {
            e.preventDefault();
            let _this = $(this);
            let data = new URLSearchParams(_this.serialize());
            const dataObject = {};
            data.forEach((value, key) => {
                dataObject[key] = value;
            });
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/binh-luan",
                data: dataObject,
                success: function (response) {
                    TGNT.loadComment(product_id);
                    TGNT.loadCommentReply(product_id);
                },
                error: function (error) {
                    console.error("Error:", error);
                },
            });
        });
    };
    TGNT.formatDateTime = (isoDateTime) => {
        if (isoDateTime) {
            const date = new Date(isoDateTime);
            if (isNaN(date)) {
                console.error("Invalid Date Format");
                return "Invalid Date";
            }
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");
            const seconds = String(date.getSeconds()).padStart(2, "0");
            return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
        }
    };
    $(document).ready(function () {
        TGNT.checkTab();
        TGNT.addFormComment();
        TGNT.commentSubmit();
        TGNT.replySubmit();
        TGNT.addCommentParent();
        TGNT.addCommentReply();
        TGNT.formatDateTime();
        TGNT.btnLoadCommentReply();
    });
})(jQuery);
