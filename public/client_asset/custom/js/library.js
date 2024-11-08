(function ($) {
    "use strict";
    var TGNT = {};
    TGNT.formatMoney = () => {
        $(".price").each(function () {
            var value = $(this).text();
            $(this).text(value.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
        });
    };
    $(document).ready(function () {
        TGNT.formatMoney();
    });
})(jQuery);
