(function ($) {
    "use strict";
    var TGNT = {};
    TGNT.getLocation = () => {
        $(document).on("change", ".location", function () {
            let _this = $(this);
            let option = {
                data: {
                    location_id: _this.val(),
                },
                target: _this.attr("data-target"),
            };
            $("." + option.target).val(0);
            TGNT.sendDataTogetLocation(option);
        });
    };

    TGNT.sendDataTogetLocation = (option) => {
        $.ajax({
            url: "/ajax/getLocation",
            type: "GET",
            data: option,
            dataType: "json",
            success: function (res) {
                $("." + option.target).html(res.html);

                if (district_id != "" && option.target == "districts") {
                    $(".districts").val(district_id).trigger("change");
                }

                if (ward_id != "" && option.target == "wards") {
                    $(".wards").val(ward_id).trigger("change");
                }
                // const choicesElement = document.querySelector(`.${option.target}`);
                // if (choicesElement.choicesInstance) {
                //     choicesElement.choicesInstance.destroy();
                // }
                // const choices_new = new Choices(choicesElement);
                // choicesElement.choicesInstance = choices_new;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Lỗi: " + textStatus + " " + errorThrown);
            },
        });
    };

    TGNT.loadLocation = () => {
        if (typeof province_id !== 'undefined' && province_id) {
            $(".province").val(province_id).trigger("change");
        }
    };

    $(document).ready(function () {
        TGNT.getLocation();
        TGNT.loadLocation();
    });
})(jQuery);
