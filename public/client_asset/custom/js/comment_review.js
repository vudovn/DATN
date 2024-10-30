(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();

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
            }
        });
    };

    TGNT.loadComment = (product_id) => {
        console.log(product_id);
        setTimeout(() => {
            $("#pills-comment").html(
                `
                <div class="p-3 px-xxl-15">
            <div class="">
                <div class="">
                    <div class="d-flex border-bottom pb-6 mb-6">
                        <img src="https://freshcart.codescandy.com/assets/images/avatar/avatar-10.jpg" alt=""
                            class="rounded-circle avatar-lg">
                        <div class="ms-5">
                            <h6 class="mb-1">Vũ Đỗ</h6>
                            <p class="small">
                                <span class="text-muted">26-9-2024</span>
                            </p>
                            <p>
                                Chất lượng sản phẩm tốt. Nhưng cân nặng có vẻ chưa tới 1kg. Vì
                                nó được gửi trong gói mở nên có khả năng bị ăn trộm ở giữa v.v.
                            </p>
                            <div>
                                <button data-product_id="" data-parent_id="1" data-user_id="" data-status="noactive"
                                    class="btn btn-link text-tgnt btnReply">Phản hồi</button>
                            </div>
    
                            <div class="d-flex mt-4 ms-5 border-start ps-4">
                                <img src="https://freshcart.codescandy.com/assets/images/avatar/avatar-11.jpg"
                                    alt="" class="rounded-circle avatar-sm">
                                <div class="ms-4">
                                    <h6 class="mb-1">Quỳnh An</h6>
                                    <p class="small text-muted">26-9-2024</p>
                                    <p>
                                        <strong class="text-tgnt">Vũ Đỗ</strong> Dỡn hay thiệt vậy cha?
                                    </p>
                                    <div>
                                        <button data-product_id="" data-parent_id="1" data-user_id="1" data-status="noactive"
                                            class="btn btn-link text-tgnt btnReply">Phản hồi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                `
            );
        }, 500);
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
                        TGNT.renderHtml(user_id, parent_id, product_id)
                    );
                    _this.data("status", "active");
                }
            } else {
                _this.next(".formReply").remove();
                _this.data("status", "noactive");
            }
        });
    };

    TGNT.renderHtml = (user_id, parent_id, product_id) => {
        return `
            <form class="formReply animate__animated animate__fadeIn">
                <input type="hidden" name="user_id" value="${user_id}">
                <input type="hidden" name="parent_id" value="${parent_id}">
                <input type="hidden" name="product_id" value="${product_id}">
                <textarea name="content" class="form-control w-100" rows="2" cols="100"></textarea>
                <div class="text-end">
                    <button type="submit" class="btn btn-tgnt mt-2">Gửi</button>
                </div>
            </form>
        `;
    };

    TGNT.commentSubmit = () => {
        $(document).on("submit", ".formReply", function (e) {
            e.preventDefault();
            let _this = $(this);
            let data = _this.serialize();
            _this.find("button").prop("disabled", true);
            VDmessage.show("warning", "Đang phát triển...");
        });
    };

    $(document).ready(function () {
        TGNT.checkTab();
        TGNT.addFormComment();
        TGNT.commentSubmit();
    });
})(jQuery);
