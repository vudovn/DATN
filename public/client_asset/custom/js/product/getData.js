(function ($) {
    "use strict";
    var TGNT = {};
    const VDmessage = new VdMessage();
    let searchTimeout = "";

    let array = {
        perpage: 12,
        sort: "id,asc",
        publish: 1,
        keyword: null,
        filter: null,
        category_id: null,
        page: 1,
    };

    TGNT.searchForm = () => {
        $("#keyword").on("input", function () {
            clearTimeout(searchTimeout);
            array.keyword = $(this).val();
            array.page = 1;
            searchTimeout = setTimeout(
                () => TGNT.getData(array),
                500
            );
        });
    };

    TGNT.selectForm = () => {
        $(".filter-option").on("change", function () {
            array[$(this).attr("name")] = $(this).val();
            array.page = 1;
            TGNT.getData(array);
        });
    };

    TGNT.getData = function (params = {}) {
        params.category_id = $("input[name='category_id']").val();
        const url_getProduct = $("input[name='url_getProduct']").val();
        $.ajax({
            url: url_getProduct,
            type: "GET",
            data: params,
            beforeSend: function () {
                $(".loading_tgnt").fadeIn("slow");
            },
            success: function (res) {
                console.log(res);
                $(".product_container").html(res.data);
                $(".loading_tgnt").fadeOut("slow");
            },
        });
    };

    TGNT.paginationForm = () => {
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            array.page = page;
            TGNT.getData(array); 
        });
    };

    $(document).ready(function () {
        TGNT.searchForm();
        TGNT.selectForm();
        TGNT.paginationForm();
    });
})(jQuery);
