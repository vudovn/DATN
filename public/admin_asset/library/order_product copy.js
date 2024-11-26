(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let searchTimeout = "";
    let array = {
        actions: 0,
        perpage: 10,
        publish: 0,
        sort: "id,asc",
        keyword: null,
        filter: null,
    };

    TGNT.getModel = () => {
        let model = $("#filter").data("model");
        return model || "user";
    };

    TGNT.fetchData = (params = {}) => {
        $("#tbody").html(
            `<tr>
                <td colspan="100%" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>`
        );
        const model = TGNT.getModel();
        const url =
            Object.values(array).length > 6
                ? `/getProduct`
                : `/${model}/getData`;
        $.ajax({
            type: "GET",
            url: url,
            data: { ...array, ...params },
            success: function (data) {
                if (url.includes("getProduct")) {
                    $("#content").html(data);
                    TGNT.checkData();
                    function checkAndHighlight(idsArray, dataAttr) {
                        idsArray.forEach((sku) => {
                            $(`.checkInput[${dataAttr}='${sku}']`).prop(
                                "checked",
                                true
                            );
                            $(`#product-item${sku}`).css(
                                "background-color",
                                "#cce6e6"
                            );
                        });
                    }
                    checkAndHighlight(array.idArray, "data-sku");
                    $(".countProduct").html(array.idArray.length);
                    $(".filterProduct .title")
                        .removeClass("alert alert-primary alert-danger")
                        .addClass(
                            `alert ${
                                array.idArray.length > 3
                                    ? "alert-primary"
                                    : "alert-danger"
                            }`
                        );
                    $("#skus").val(array.idArray.join(","));
                } else {
                    $("#tbody").html(data);
                }
                TGNT.checkProductChecked();
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
                $("#tbody").html(
                    `<tr><td colspan="100%" class="text-center">Lỗi khi tải dữ liệu</td></tr>`
                );
            },
        });
    };

    TGNT.searchForm = () => {
        $("#keyword").on("input", function () {
            clearTimeout(searchTimeout);
            array.keyword = $(this).val();
            searchTimeout = setTimeout(
                () => TGNT.fetchData({ keyword: array.keyword }),
                500
            );
        });
    };

    TGNT.filterForm = () => {
        $(".filter-option").on("change", function () {
            array[$(this).attr("name")] = $(this).val();
            TGNT.fetchData(array);
        });
    };

    TGNT.showProduct = () => {
        const productElement = document.querySelector(".show-product");
        // if (skus && skus.length > 0) {
        //     array["idArray"] = skus.split(",");
        //     var point_value = $('#point_value').val();
        //     $("#description_value").html(point_value);
        //     if (productElement) productElement.classList.remove("hidden");
        //     $(this).css("display", "none");
        //     $(".add-product").css("display", "none");
        //     TGNT.fetchData(array);
        // }

        // $(".add-product").on("click", function () {
        // let key = $(this).data("show");
        if (productElement) productElement.classList.remove("hidden");
        $(this).css("display", "none");
        // if (key) {
        array["idArray"] = [];
        TGNT.fetchData(array);
        // }
        // });
    };

    TGNT.paginationForm = () => {
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            TGNT.fetchData({ page });
        });
    };

    TGNT.checkInput = () => {
        $(document).on("change", ".checkInput", function () {
            const sku = $(this).data("sku");
            const id_product = $(this).data("id");
            console.log(id_product);
            const item = $("#product-item" + sku);
            const url = "/admin/order/getProduct";

            if ($(this).prop("checked")) {
                if (!array.idArray.includes(sku) && sku) {
                    array.idArray.push(sku);
                }
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        sku: sku ?? "",
                    },
                    success: function (data) {
                        TGNT.renderRow(data, id_product);
                        TGNT.calculateTotalAmount();
                    },
                    error: function () {
                        console.log("lỗi");
                    },
                });
                $("#product-item" + sku).css("background-color", "#cce6e6");
                TGNT.checkProductChecked();
            } else {
                array.idArray = array.idArray.filter((i) => i !== sku);
                $("#product-item" + sku).css("background-color", "");
                TGNT.removeRow(sku);
                TGNT.deleteV2(id_product, sku);
            }
            $("#skus").val(array.idArray.join(","));
        });
    };

    TGNT.renderRow = (product, id_product) => {
        if (product) {
            $("#product-table-body").append(`   
                    <tr id="product-row-${product.sku}" data-sku="${
                product.sku
            }">
                       <td>
                           <a href="${
                               product.thumbnail
                           }" data-fancybox="gallery">
                               <img src="${product.thumbnail}" alt="${
                product.name
            }" class="product-thumbnail">
                           </a>
                       </td>
                        <td>${product.sku}</td> 
                        <td class="text-wrap">${product.name} ${
                product.title !== undefined ? " - " + product.title : ""
            }</td>
                        <td class='fix-input'>
                            <input type="number" value="1" class="product-quantity form-control" data-price="${
                                product.price
                            }" min="1" max="5" style="width: 60px;">
                        </td> 
                        <td>${TGNT.formatNumber(product.price)}</td>
                        <td class="total-price">${TGNT.formatNumber(
                            product.total ?? product.price * 1
                        )}</td>
                        <td><button type="button" class="btn btn-danger btn-sm rounded delete-product-btn" data-sku="${
                            product.sku
                        }">Xóa</button></td>
                        <td class="hidden">
                            <input type="text" name="product_id[]" value="${id_product}">
                            <input type="text" class="product_quantity_input" name="quantity[]" value="${
                                product.quantity
                            }">
                            <input type="text"  name="price[]" value="${
                                product.price
                            }">
                            <input type="text" name="name_orderDetail[]" value="${
                                product.name
                            }">
                            <input type="text" name="sku[]" value="${
                                product.sku
                            }">
                            <input type="text" name="thumbnail[]" value="${
                                product.thumbnail
                            }">
                            <input type="text" name="total[]" value="${
                                product.total ?? product.price * 1
                            }">
                        </td>
                    </tr>
                `);
            TGNT.deleteProduct();
        }
    };

    TGNT.removeRow = (sku) => {
        if (sku !== undefined) {
            $.ajax({
                type: "GET",
                url: "/admin/order/getProduct",
                data: {
                    sku: sku ? sku : "",
                },
                success: function (data) {
                    $(`#product-row-${data.sku}`).closest("tr").remove();
                    TGNT.calculateTotalAmount();
                },
                error: function (xhr, status, error) {
                    console.log("lỗi");
                },
            });
        }
    };

    TGNT.deleteV2 = (id_product) => {
        $(`tr[data-id=${id_product}]`).remove();
        TGNT.checkProductChecked();
        TGNT.calculateTotalAmount();
    };

    TGNT.deleteProduct = () => {
        $(".delete-product-btn").on("click", function () {
            let _this = $(this);
            _this.parents("tr").remove();
            let sku = _this.parents("tr").find('input[name="sku[]"]').val();
            $(`#checkInput${sku}`).prop("checked", false);
            array.idArray = array.idArray.filter((i) => i !== sku);
            $("#product-item" + sku).css("background-color", "");
            $(".countProduct").html($(".checkInput:checked").length);
            TGNT.calculateTotalAmount();
        });
    };

    TGNT.formatNumber = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    TGNT.calculateTotalAmount = () => {
        let totalAmount = 0;
        $("#product-table-body .total-price").each(function () {
            let priceText = $(this)
                .text()
                .replace("", "")
                .replace(/\./g, "")
                .trim();
            let price = parseInt(priceText);
            totalAmount += price;
        });
        $("#total_amount").val(TGNT.formatNumber(totalAmount));
        $(".total_amount").text(TGNT.formatNumber(totalAmount));
    };

    TGNT.updateQuantity = () => {
        $(document).on("input", ".product-quantity", function () {
            let quantity = $(this).val();
            let price = $(this).data("price");
            let totalPrice = quantity * price;

            $(this).closest("tr").find(".product_quantity_input").val(quantity);
            $(this)
                .closest("tr")
                .find(".total-price")
                .text(TGNT.formatNumber(totalPrice));

            TGNT.calculateTotalAmount();
        });
    };

    TGNT.checkData = () => {
        if (typeof skuInData !== "undefined" && skuInData) {
            skuInData.forEach((sku) => {
                $(`#checkInput${sku}`).prop("checked", true);
                $(`#product-item${sku}`).css("background-color", "#cce6e6");
            });

            TGNT.checkProductChecked();
        }
    };

    TGNT.checkProductChecked = () => {
        $(".countProduct").html($(".checkInput:checked").length);
    };

    $(document).ready(function () {
        TGNT.searchForm();
        TGNT.filterForm();
        TGNT.paginationForm();
        TGNT.fetchData();
        TGNT.showProduct();
        TGNT.checkInput();
        TGNT.renderRow();
        TGNT.removeRow();
        TGNT.deleteProduct();
        TGNT.updateQuantity();
        TGNT.calculateTotalAmount();
    });
})(jQuery);
