(function ($) {
    "use strict";
    var TGNT = {};
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
    TGNT.setupProductVariant = () => {
        if ($(".turnOnVariant").length) {
            $(document).on("click", ".turnOnVariant", function () {
                $(".variant-wrapper").toggleClass(
                    "hidden",
                    !$(this).is(":checked")
                );
            });
        }
    };

    TGNT.addVariant = () => {
        if ($(".add-variant").length) {
            $(document).on("click", ".add-variant", function () {
                let html = TGNT.renderVariantItem(attributeCatalogue);
                $(".variant-body").append(html);
                TGNT.checkMaxAttributeGroup(attributeCatalogue);
                TGNT.disabledAttributeCatalogueChoose();
            });
        }
    };

    TGNT.renderVariantItem = (attributeCatalogue) => {
        let html = "";
        html += '<div class="row mb-3 variant-item ">';
        html += '<div class="col-lg-3">';
        html += '<div class="attribute-catalogue">';
        html += '<select name="" id="" class="choose-attribute niceSelect">';
        html += '<option value="">Chọn Nhóm thuộc tính</option>';
        for (let i = 0; i < attributeCatalogue.length; i++) {
            html +=
                '<option value="' +
                attributeCatalogue[i].id +
                '">' +
                attributeCatalogue[i].name +
                "</option>";
        }
        html += "</select>";
        html += "</div>";
        html += "</div>";
        html += '<div class="col-lg-8">';
        html +=
            '<input type="text" name=""disabled class="fake-variant h-100 form-control">';
        html += "</div>";
        html += '<div class="col-lg-1">';
        html +=
            '<button type="button" class="h-100 w-100 remove-attribute btn btn-danger">';
        html += '<i class="fas fa-trash-alt"></i>';
        html += "</button>";
        html += "</div>";
        html += "</div>";

        return html;
    };

    TGNT.chooseVariantGroup = () => {
        $(document).on("change", ".choose-attribute", function () {
            let _this = $(this);
            let attributeCatalogueId = _this.val();
            if (attributeCatalogueId != 0) {
                _this
                    .parents(".col-lg-3")
                    .siblings(".col-lg-8")
                    .html(TGNT.select2Variant(attributeCatalogueId));
                $(".selectVariant").each(function (key, index) {
                    TGNT.getSelect2($(this));
                });
            } else {
                _this
                    .parents(".col-lg-3")
                    .siblings(".col-lg-8")
                    .html(
                        '<input type="text" name="" disabled="" class="fake-variant form-control">'
                    );
            }

            TGNT.disabledAttributeCatalogueChoose();
        });
    };

    TGNT.createProductVariant = () => {
        $(document).on("change", ".selectVariant", function () {
            let _this = $(this);
            TGNT.createVariant();
        });
    };

    TGNT.createVariant = () => {
        let attributes = [];
        let variants = [];
        let attributeTitle = [];

        $(".variant-item").each(function () {
            let _this = $(this);
            let attr = [];
            let attrVariant = [];

            const attributeCatalogueId = _this.find(".choose-attribute").val();
            const optionText = _this
                .find(".choose-attribute option:selected")
                .text();
            const attribute = $(".variant-" + attributeCatalogueId).select2(
                "data"
            );

            for (let i = 0; i < attribute.length; i++) {
                let item = {};
                let itemVariant = {};

                item[optionText] = attribute[i].text;
                itemVariant[attributeCatalogueId] = attribute[i].id;

                attr.push(item);
                attrVariant.push(itemVariant);
            }
            attributeTitle.push(optionText);
            attributes.push(attr);
            variants.push(attrVariant);
        });

        let attributesNew = TGNT.generateVariants(attributes);
        let variantsNew = TGNT.generateVariants(variants);

        let html = TGNT.renderTableHtml(
            attributeTitle,
            attributesNew,
            variantsNew
        );
        $(".table.variantTable").html(html);
    };

    TGNT.generateVariants = (attributes) => {
        let results = [];
        function helper(current, depth) {
            if (depth === attributes.length) {
                results.push(current);
                return;
            }
            attributes[depth].forEach((item) => {
                helper({ ...current, ...item }, depth + 1);
            });
        }
        helper({}, 0);
        return results;
    };

    TGNT.renderTableHtml = (attributeTitle, attributes, variantsNew) => {
        let html = `
            <thead class="animate__animated animate__fadeIn">
                <tr class="table-pri">
                    <th scope="col">Hình ảnh</th>`;
            
                attributeTitle.forEach((element) => {
                    html += `<th scope="col">${element}</th>`;
                });
            
                html += `
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá tiền</th>
                    <th scope="col">SKU</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="animate__animated animate__fadeIn">`;
    
        attributes.forEach((attribute, index) => {
            let attributeArray = [], variantArray = [];
    
            attributeArray = Object.values(attribute);
            variantArray = Object.values(variantsNew[index]);
    
            let attributeString = attributeArray.join(", ");
            let variantString = variantArray.join(", ");
    
            html += `
                <tr class="variant-row">
                    <td>
                        <span class="img img-cover">
                            <a href="https://placehold.co/600x600?text=The%20Gioi\nNoi%20That" class="td-thumbnai-pre" data-fancybox="gallery" data-caption="">
                                <img width="50" class="td-thumbnail rounded" src="https://placehold.co/600x600?text=The%20Gioi\nNoi%20That" alt="">
                            </a>
                        </span>
                    </td>`;
            
            attributeArray.forEach((value) => {
                html += `<td>${value}</td>`;
            });
    
            html += `
                    <td class="td-quantity">-</td>
                    <td class="td-price">-</td>
                    <td class="td-sku">-</td>
                    <td class="hidden td-variant">
                        <input type="text" name="variant[sku][]" value="" class="variant_sku">
                        <input type="text" name="variant[quantity][]" value="" class="variant_quantity">
                        <input type="text" name="variant[price][]" value="" class="variant_price">
                        <input type="text" name="variant[discount][]" value="" class="variant_discount">
                        <input type="text" name="variant[albums][]" value="" class="variant_albums">
                        <input type="text" name="attribute[name][]" value="${attributeString}">
                        <input type="text" name="attribute[id][]" value="${variantString}">
                    </td>
                    <td class="table-actions text-center">
                        <button type="button" class="btn btn-sm btn-primary btnUpdateVariant">
                                <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteVariant">
                            <svg class="icon  svg-icon-ti-ti-trash" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </td>
                </tr>`;
        });
    
        html += `</tbody>`;
        return html;
    };
    
    TGNT.updateVariant = () => {
        $(document).on("click", ".btnUpdateVariant", function () {
            let _this = $(this);
            let parents = _this.parents(".variant-row");
            let variantData = {};
            parents
                .find(".td-variant input[type=text][class^='variant_']")
                .each(function () {
                    let className = $(this).attr("class");
                    variantData[className] = $(this).val();
                    console.log(className);
                });

            console.log(variantData);

            if ($(".updateVariantRow").length == 0) {
                parents.after(TGNT.renderUpdateVariantHtml(variantData));
            }
        });
    };

    TGNT.renderUpdateVariantHtml = (variantData) => {
        let variantAlbums = variantData.variant_albums.split(",");
        console.log(variantAlbums);
    
        let html = `
            <tr class="updateVariantRow animate__animated animate__fadeIn">
                <td colspan="10">
                    <div class="updateVariant card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Cập nhật thông tin phiên bản</span>
                                <div>
                                    <button type="button" class="btn btn-sm btn-danger cancleUpdate">Hủy</button>
                                    <button type="button" class="btn btn-sm btn-primary saveUpdate">Lưu lại</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label text-left">Hình ảnh sản phẩm</label>
                                <div class="card">
                                    <div class="card-body pb-2">
                                        <div class="upload-list mt-2">
                                            <ul id="sortableVariant" class="albums-variant row list-unstyled clearfix sortui ui-sortable" style="margin-bottom:0 !important">
                                                <li class="col-xl-2 col-md-3 col-sm-6 mb-3 d-flex justify-content-center align-items-center">
                                                    <a style="font-size: 50px" class="upload-picture-variant" data-name="variant_albums">
                                                        <i class="fa-duotone fa-solid fa-cloud-arrow-up"></i>
                                                    </a>
                                                </li>`;
    
        if (variantAlbums != "") {
            variantAlbums.forEach((element) => {
                html += TGNT.variantAlbumList(element);
            });
        }
    
        html += `
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row price-group">
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="variant_sku" id="sku" value="${variantData.variant_sku}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="quantity">Số lượng <span class="text-danger">*</span></label>
                                        <input class="form-control int" type="text" name="variant_quantity" id="quantity" value="${TGNT.addCommas(variantData.variant_quantity)}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="variant_price">Giá tiền <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                            <input type="text" name="variant_price" value="${TGNT.addCommas(variantData.variant_price)}" id="variant_price" class="form-control int">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="variant_discount">Giảm giá</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                            <input type="text" name="variant_discount" value="${variantData.variant_discount}" max="100" class="form-control int">
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`;
    
        return html;
    };
    

    TGNT.variantAlbumList = (album) => {
        let html = "";
        html += `<li class="ui-state-default img_li_tgnt col-xl-2 col-md-3 col-sm-6 mb-3">
                    <div class="thumb img_albums_tgnt">
                        <span class="span image img-scaledown">
                            <a href="${album}" data-fancybox="gallery" data-caption="">
                                <img src="${album}" alt="" width="100%" class="img-thumbnail">
                            </a>
                            <input type="hidden" name="variant_albums[]" value="${album}">
                        </span>
                        <div class="btn_delete_albums_tgnt">
                            <button class="delete-image btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </li>`;
        return html;
    };

    TGNT.cancleVariantUpdate = () => {
        $(document).on("click", ".cancleUpdate", function () {
            let _this = $(this);
            _this.parents(".updateVariantRow").remove();
        });
    };

    TGNT.closeUpdateVariant = () => {
        $(".updateVariantRow").remove();
    };

    TGNT.saveVariantUpdate = () => {
        $(document).on("click", ".saveUpdate", function () {
            let variant = {
                sku: $('input[name="variant_sku"]').val(),
                quantity: $('input[name="variant_quantity"]').val(),
                price: $('input[name="variant_price"]').val(),
                discount: $('input[name="variant_discount"]').val(),
                albums: $('input[name="variant_albums[]"]')
                    .map(function () {
                        return $(this).val();
                    })
                    .get(),
            };
            $.each(variant, function (key, value) {
                $(".updateVariantRow").prev().find(".variant_" + key).val(value);
            });
            TGNT.previewVariantTr(variant);
            TGNT.closeUpdateVariant();
        });
    };

    TGNT.previewVariantTr = (variant) => {
        let option = {
            'quantity': variant.quantity,
            'price': variant.price,
            'sku': variant.sku,
            'discount': variant.discount,
        }
        $.each(option, function (key, value) {
            $(".updateVariantRow").prev().find(".td-" + key).html(value);
        });
        $(".updateVariantRow").prev().find(".td-thumbnail").attr("src", variant.albums[0]);
        $(".updateVariantRow").prev().find(".td-thumbnai-pre").attr("href", variant.albums[0])

    }

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
    TGNT.getSelect2 = (object) => {
        $(object).select2({
            minimumInputLength: 1,
            placeholder:
                "Nhập tối thiểu 1 kí tự để tìm kiếm giá trị thuộc tính",
            ajax: {
                url: "/getAttributeValue",
                type: "GET",
                dataType: "json",
                deley: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        attribute_id: object.attr("data-catid"),
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.data,
                    };
                },
                cache: true,
            },
        });
    };

    TGNT.niceSelect = () => {
        $(".niceSelect").niceSelect();
    };

    TGNT.destroyNiceSelect = () => {
        if ($(".niceSelect").length) {
            $(".niceSelect").niceSelect("destroy");
        }
    };

    TGNT.disabledAttributeCatalogueChoose = () => {
        let id = [];
        $(".choose-attribute").each(function () {
            let _this = $(this);
            let selected = _this.find("option:selected").val();
            if (selected != 0) {
                id.push(selected);
            }
        });

        $(".choose-attribute").find("option").removeAttr("disabled");
        for (let i = 0; i < id.length; i++) {
            $(".choose-attribute")
                .find("option[value=" + id[i] + "]")
                .prop("disabled", true);
        }
        TGNT.destroyNiceSelect();
        TGNT.niceSelect();
        $(".choose-attribute").find("option:selected").removeAttr("disabled");
    };

    TGNT.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $(".variant-item").length;
        if (variantItem >= attributeCatalogue.length) {
            $(".add-variant").remove();
        } else {
            $(".variant-foot").html(
                '<button type="button" class="btn btn-primary add-variant">Thêm phiên bản mới</button>'
            );
        }
    };

    TGNT.removeAttribute = () => {
        $(document).on("click", ".remove-attribute", function () {
            let _this = $(this);
            _this.parents(".variant-item").remove();
            TGNT.checkMaxAttributeGroup(attributeCatalogue);
            TGNT.createVariant();
        });
    };

    TGNT.select2Variant = (attributeCatalogueId) => {
        let html =
            '<select class="selectVariant variant-' +
            attributeCatalogueId +
            ' form-control" name="attribute[' +
            attributeCatalogueId +
            '][]" multiple data-catid="' +
            attributeCatalogueId +
            '"></select>';
        return html;
    };

    TGNT.uploadAlbumVariant = () => {
        $(document).on("click", ".upload-picture-variant", function (e) {
            TGNT.browseServerAlbumVariant($(this).attr("data-name"));
            e.preventDefault();
        });
    };

    TGNT.browseServerAlbumVariant = (data_name) => {
        var type = "Images";
        var finder = new CKFinder();
    
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data, allFiles) {
            let html = "";
            for (var i = 0; i < allFiles.length; i++) {
                var image = allFiles[i].url;
    
                html += `
                    <li class="ui-state-default img_li_tgnt col-xl-2 col-md-3 col-sm-6 mb-3">
                        <div class="thumb img_albums_tgnt">
                            <span class="span image img-scaledown">
                                <a href="${image}" data-fancybox="gallery" data-caption="">
                                    <img src="${image}" alt="${image}" width="100%" class="img-thumbnail">
                                </a>
                                <input type="hidden" name="${data_name}[]" value="${image}">
                            </span>
                            <div class="btn_delete_albums_tgnt">
                                <button class="delete-image btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </li>`;
            }
            $("#sortableVariant").append(html);
        };
        finder.popup();
    };
    

    $(document).ready(function () {
        TGNT.setupProductVariant();
        TGNT.addVariant();
        TGNT.niceSelect();
        TGNT.chooseVariantGroup();
        TGNT.removeAttribute();
        TGNT.createProductVariant();
        TGNT.uploadAlbumVariant();
        TGNT.updateVariant();
        TGNT.cancleVariantUpdate();
        TGNT.saveVariantUpdate();
    });
})(jQuery);
