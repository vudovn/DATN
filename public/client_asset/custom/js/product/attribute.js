(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    TGNT.changeQuantity = function (e) {
        e.preventDefault();
        var t = e.target,
            n = t.getAttribute("data-field"),
            o = t.closest("div").querySelector('input[name="' + n + '"]'),
            a = parseInt(o.value, 10) || 0;
        if (t.classList.contains("btn-plus")) {
            if (a < 1000) {
                o.value = a + 1;
                return true;
            } else {
                return false;
            }
        } else if (t.classList.contains("btn-minus")) {
            if (a > 1) {
                o.value = a - 1;
                return true;
            } else {
                return false;
            }
        }
    };
    TGNT.updateQuantity = () => {
        let timeUpdate = {};
        $(document).on("click", ".btn-plus, .btn-minus", function (e) {
            let checkQuantity = TGNT.changeQuantity(e);
            const _this = $(this)
                .closest(".input-group")
                .find(".quantity-field");
            let sku = _this.data("sku");
            const quantity = _this.val();
            let url = "/san-pham/ajax/change-quantity";
            if (checkQuantity) {
                clearTimeout(timeUpdate);
                timeUpdate = setTimeout(function () {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "POST",
                        url: url,
                        data: {
                            sku,
                            quantity,
                        },
                        success: function (data) {
                            if (data.status) {
                                VDmessage.show("success", "Cập nhật số lượng");
                            } else {
                                const inventory = data;
                                $(".quantity-field").val(inventory);
                                VDmessage.show(
                                    "warning",
                                    `Chúng tôi chỉ còn ${inventory} sản phẩm`
                                );
                            }
                        },
                        error: function (data) {
                            console.log("lỗi");
                        },
                    });
                }, 500);
            }
        });
    };
    TGNT.selectVariantProduct = () => {
        $(".choose-attribute").on("click", function (e) {
            e.preventDefault();
            const _this = $(this);
            const attribute_id = _this.attr("data-attributeId");
            const attribute_name = _this.text();
            _this
                .addClass("active")
                .attr("disabled", true)
                .siblings()
                .removeClass("active")
                .attr("disabled", false);
            // _this.closest(".attribute-item").find("span").html(attribute_name);
            TGNT.handleAttribute();
        });
    };

    TGNT.handleAttribute = () => {
        const attribute_ids = $(".attribute-value .choose-attribute.active")
            .map(function () {
                return $(this).attr("data-attributeId");
            })
            .get();
        const url = new URL(window.location.href);
        const attrParams = attribute_ids;
        attrParams.sort((a, b) => a - b);
        if (attrParams.length > 0) {
            url.searchParams.set("attr", attrParams.join(","));
        } else {
            url.searchParams.delete("attr");
        }
        const newUrl = url.toString().replace(/%2C/g, ",");
        window.history.pushState({}, "", newUrl);

        const allSelected = $(".attribute")
            .toArray()
            .every((item) => {
                return $(item).find(".choose-attribute.active").length > 0;
            });
        if (allSelected) {
            $.ajax({
                url: "/san-pham/ajax/get-variant",
                type: "GET",
                data: {
                    attribute_id: attribute_ids,
                    product_id: $("input[name=product_id]").val(),
                },
                dataType: "json",
                beforeSend: function () {
                    // $(".loading_tgnt").show();
                },
                success: function (res) {
                    TGNT.renderAlbums(res.data.albums);
                    TGNT.renderInfo(res.data);
                    $(".loading_tgnt").fadeOut("slow");
                },
            });
        }
    };

    TGNT.renderInfo = (data) => {
        $(".product-title").html(`${data.name}`);
        $(".inventory").val(`${data.quantity}`);

        $(".status_spct").html(`
            <strong>Tình trạng: </strong>
                <span class="badge bg-light-danger text-dark-warning product_ct_badge">
                    Hết hàng
                </span>
    `);
        if (data.quantity > 0) {
            $(".status_spct").html(`
                    <strong>Tình trạng: </strong>
                        <span class="badge bg-light-success text-dark-warning product_ct_badge">
                            Còn hàng
                        </span>
            `);
        }

        if (data.sku) {
            $(".compare").data("sku", `${data.sku}`);
            $(".buyNow").attr("data-sku", `${data.sku}`);
            $(".addToCart").attr("data-sku", `${data.sku}`);
        }
        if (data.discount > 0) {
            $(".product-price").html(`
                     <span
                            class="price_base_spct text-danger price">${Math.round(
                                data.price - (data.price * data.discount) / 100
                            )} đ </span>
                        <strike class="price_discount_spct ms-3 price">${
                            data.price
                        } đ</strike>
                `);
        } else {
            $(".product-price").html(`
                     <span class="price_base_spct text-danger price">${data.price} đ</span>
                `);
        }
        TGNT.formatMoney();
    };

    TGNT.checkChange = () => {
        $(".attribute-value").each(function () {
            $(this)
                .find(".choose-attribute")
                .each(function () {
                    if ($(this).hasClass("active")) {
                        $(this).trigger("click");
                    }
                });
        });
    };

    TGNT.formatMoney = () => {
        $(".price").each(function () {
            var value = $(this).text();
            $(this).text(value.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
        });
    };

    TGNT.sliderImg = () => {
        $(".thumbnail-images img").on("click", function () {
            var newImage = $(this).data("image");
            $("#mainImage").fadeOut("slow", function () {
                $("#mainImage").attr("src", newImage);
                $(".img_preview").attr("href", newImage);
                $("#mainImage").fadeIn("slow");
            });
            $(".thumbnail-images img").removeClass("active");
            $(this).addClass("active");
        });
    };

    TGNT.renderAlbums = (albums) => {
        $(".gallery-container").html(albums);
        $(".fotorama").fotorama();
    };

    $(document).ready(function () {
        TGNT.updateQuantity();
        TGNT.selectVariantProduct();
        TGNT.formatMoney();
        // TGNT.checkChange();
    });
})(jQuery);
