(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let arrayCompare = [];
    TGNT.selectProduct = () => {
        $(document).on("click", ".compare", function () {
            let _this = $(this);
            let sku = _this.data("sku");
            $(".tab-compare").removeClass("hidden");
            let url = `/san-pham/ajax/add-compare/${sku}`;
            console.log(arrayCompare);
            
            if (TGNT.existProduct(sku)) {
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {},
                    success: function (data) {
                        arrayCompare.push(data);
                        TGNT.arrayCompare(arrayCompare);
                    },
                    error: function (data) {},
                });
            }
        });
    };

    TGNT.closeCompare = () => {
        $(document).on("click", ".tab-compare-close", function () {
            $(".tab-compare").addClass("hidden");
        });
    };
    TGNT.arrayCompare = (arrayCompare) => {
        if (arrayCompare.length > 0) {
            arrayCompare.forEach((element, index) => {
                $(`.item-${index + 1}`).html(`
                    <div class="" id="product-${element.thumbnail}">
                        <img src="${element.thumbnail}"
                            class="w-25 text-center" alt="">
                    </div>
                    <span style="white-space: nowrap; 
                                text-overflow: ellipsis; 
                                overflow: hidden">${element.name}
                    </span>
                    <span class="remove-item position-absolute top-0 end-0" id="product-${element.thumbnail}">X</span>
                `);
            });
        } else {
            $(".tab-compare").addClass("hidden");
        }
    };
    TGNT.existProduct = (sku) => {
        let exists = arrayCompare.some((item) => item.sku === sku);
        if (!exists && arrayCompare.length < 2) {
            return true;
        } else if (arrayCompare.length >= 2) {
            return false;
        } else {
            return false;
        }
    };
    
    $(document).ready(function () {
        TGNT.selectProduct();
        TGNT.closeCompare();
    });
})(jQuery);
