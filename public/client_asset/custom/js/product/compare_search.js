(function ($) {
    "use strict";
    var TGNT = {};
    TGNT.search = function () {};
    TGNT.debounce = function (fn, delay = 1000) {
        let timerId;
        return function (...args) {
            clearTimeout(timerId);
            timerId = setTimeout(() => fn(...args), delay);
        };
    };
    TGNT.cancelSearch = () => {
        $("#search-close")
            .off("click")
            .on("click", function () {
                $("#search-on").val("");
                $("#search-out").hide();
                $("#search-result").empty();
                $("#search-header").empty();
            });
    };

    TGNT.formatMoney = (money) => {
        return money.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    };

    $(document).ready(function () {
        TGNT.search();
        TGNT.cancelSearch();
        const $searchOn = $("#search-on");
        const $searchOut = $("#search-out");
        const $searchResult = $("#search-result");
        const $searchHeader = $("#search-header");
        const $searchHeading = $("#search-heading");
        const $searchClose = $("#search-close");
        const makeAPICall = (searchValue) => {
            $searchHeading.hide();
            $searchHeader.html(`
                <div class="p-2">
                    <img src="https://i.gifer.com/ZKZg.gif" width="10%"/>
                    <span id="result_api">Kết quả cho '${searchValue}'</span>
                </div>
                <div class="p-2">
                    <a href="#" id="search-close" class="text-muted">Hủy tìm kiếm</a>
                </div>
            `);
            $searchResult.empty();
            if (!searchValue) return;

            $.ajax({
                url: `/san-pham/ajax/search-product?q=${searchValue}`,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    const { products } = response.data;
                    const productItems = products;
                    // console.log(productItems);
                    // console.log(categoryItems);
                    const resultsFound =
                        productItems.length > 0 ;
                    $searchHeader.html(`
                        <div class="p-2">
                            <span id="result_api">${
                                resultsFound
                                    ? `Kết quả cho '${searchValue}'`
                                    : `Không có kết quả cho '${searchValue}'`
                            }</span>
                        </div>
                        <div class="p-2">
                            <a style="cursor: pointer;" id="search-close" class="text-muted">Hủy tìm kiếm</a>
                        </div>
                    `);
                    if (resultsFound) {
                        $searchHeading.show();
                        if (productItems.length > 0) {
                            $.each(productItems, function (_, item) {
                                $searchResult.append(`
                                    <div class="text-dark row align-items-center p-2" >
                                        <div class="col-3">
                                            <img class="img-fluid w-100 rounded" loading="lazy" src="${
                                                item.thumbnail
                                            }" alt="undefined">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="text-dark title_news">${
                                                item.name
                                            }</h5>
                                            <span class="text-vd price fw-bold">Giá: ${
                                                item.discount > 0
                                                    ? TGNT.formatMoney(
                                                          item.price -
                                                              (item.price *
                                                                  item.discount) /
                                                                  100
                                                      ) +
                                                      '&nbsp; <del class="text-muted">' +
                                                      TGNT.formatMoney(
                                                          item.price
                                                      ) +
                                                      "</del>"
                                                    : TGNT.formatMoney(
                                                          item.price
                                                      )
                                            }</span>
                                        </div>
                                    </div>
                                `);
                            });
                        }
                    }
                    TGNT.cancelSearch();
                },

                error: function () {
                    $searchHeader.html(`
                        <span id="result_api">Có lỗi xảy ra với API. Vui lòng thử lại!</span>
                    `);
                },
            });
        };

        const debounce = function (fn, delay = 1000) {
            let timerId;
            return function (...args) {
                clearTimeout(timerId);
                timerId = setTimeout(() => fn(...args), delay);
            };
        };

        const onInput = debounce(makeAPICall, 500);

        $searchOn.on("input", function () {
            const searchValue = $(this).val();
            onInput(searchValue);
            $searchHeader.html(`
                <div class="p-2">
                    <span id="result_api">Kết quả cho '${searchValue}'</span>
                </div>
                <div class="p-2">
                    <a href="#" id="search-close" class="text-muted">Hủy tìm kiếm</a>
                </div>
            `);
            $searchOut.toggle(!!searchValue);
            $searchClose.toggle(!!searchValue);
            TGNT.cancelSearch();
        });
        function short_content(content) {
            return content.length > 100
                ? content.substring(0, 100) + "..."
                : content;
        }
        $searchClose.on("click", function () {
            $searchOn.val("");
            $searchClose.hide();
            $searchOut.hide();
            $searchHeader.empty();
            $searchResult.empty();
        });
    });
})(jQuery);
