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
        $("#search_close")
            .off("click")
            .on("click", function () {
                $("#search_on").val("");
                $("#search_out").hide();
                $("#search_result").empty();
                $("#search_header").empty();
            });
    };

    TGNT.formatMoney = (money) => {
        return money.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    };
    TGNT.cateChild = function (child) {
        return `
                <a href="/danh-muc/${child.slug}" class="text-danger p-3 col-4 h-25" id="cateChildren-${child.id}">
                    ${child.name}
                </a>
        `;
    };

    $(document).ready(function () {
        TGNT.search();
        TGNT.cancelSearch();
        const $searchOn = $("#search_on");
        const $searchOut = $("#search_out");
        const $searchResult = $("#search_result");
        const $searchHeader = $("#search_header");
        const $searchHeading = $("#search_heading");
        const $searchClose = $("#search_close");

        const makeAPICall = (searchValue) => {
            $searchHeading.hide();
            $searchHeader.html(`
                <div>
                    <img src="https://i.gifer.com/ZKZg.gif"/>
                    <span id="result_api">Kết quả cho '${searchValue}'</span>
                </div>
                <div>
                    <a href="#" id="search_close" class="text-muted">Hủy tìm kiếm</a>
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
                    const { products, categories } = response.data;
                    const productItems = products;
                    const categoryItems = categories;
                    console.log(productItems);
                    console.log(categoryItems);

                    const resultsFound =
                        productItems.length > 0 || categoryItems.length > 0;
                    $searchHeader.html(`
                        <div>
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" class="svg-inline--fa fa-magnifying-glass _icon_15ttk_79" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                            </svg>
                            <span id="result_api">${
                                resultsFound
                                    ? `Kết quả cho '${searchValue}'`
                                    : `Không có kết quả cho '${searchValue}'`
                            }</span>
                        </div>
                        <div>
                            <a href="#" id="search_close" class="text-muted">Hủy tìm kiếm</a>
                        </div>
                    `);
                    if (resultsFound) {
                        $searchHeading.show();
                        if (productItems.length > 0) {
                            $.each(productItems, function (_, item) {
                                $searchResult.append(`
                                    <a class="text-dark row align-items-center pt-3 pb-3" href="/san-pham/${
                                        item.slug
                                    }">
                                        <div class="col-3">
                                            <img class="img-fluid w-100 rounded" loading="lazy" src="${
                                                item.thumbnail
                                            }" alt="undefined">
                                        </div>
                                        <div class="col-9">
                                            <h4 class="text-dark title_news">${
                                                item.name
                                            }</h4>
                                            <p>${short_content(
                                                item.short_content ?? ""
                                            )}</p>
                                            <span class="text-vd price">Giá: ${
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
                                    </a>
                                `);
                            });
                        }
                        if (categoryItems.length > 0) {
                            $.each(categoryItems, function (_, item) {
                                if (item.parent_id === 0) {
                                    $searchResult.append(`
                                        <a class="text-dark row align-items-center pt-3 pb-3" href="/danh-muc/${item.slug}">
                                            <div class="col-3">
                                                <img class="img-fluid w-100 rounded" loading="lazy" src="${item.thumbnail}" alt="undefined">
                                            </div>
                                            <div class="col-9">
                                                <p>Danh mục</p>
                                                <h4 class="text-dark title_news">${item.name}</h4>
                                                <div id="list_child_${item.id}" class="d-flex flex-wrap justify-content-end">
                                                </div>
                                            </div>
                                        </a>
                                    `);
                                }
                            });
                            $.each(categoryItems, function (_, child) {
                                if (child.parent_id != 0) {
                                    console.log(child); // Log khi parent_id != 0
                                    if (
                                        $(`#list_child_${child.parent_id}`)
                                            .length !== 0
                                    ) {
                                        $(
                                            `#list_child_${child.parent_id}`
                                        ).append(TGNT.cateChild(child));
                                    } else {
                                        $(
                                            `#cateChildren-${child.parent_id}`
                                        ).after(TGNT.cateChild(child));
                                    }
                                }
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
                <div>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" class="svg-inline--fa fa-magnifying-glass _icon_15ttk_79" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg>
                    <span id="result_api">Kết quả cho '${searchValue}'</span>
                </div>
                <div>
                    <a href="#" id="search_close" class="text-muted">Hủy tìm kiếm</a>
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
