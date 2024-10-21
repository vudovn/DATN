// đoạn ni hỏi chatGPT là nó giải thích rõ hơn

(function ($) {
    "use strict";
    var TGNT = {};

    // Hàm để bắt của 3 cái select vì 3 cái select này có chung 1 class là location
    // và có data-target để xác định cái select nào sẽ được thay đổi
    TGNT.getLocation = () => {
        $(document).on("change", ".location", function () {
            let _this = $(this);
            let option = {
                data: {
                    location_id: _this.val(),
                },
                target: _this.attr("data-target"),
                //_this.attr('data-target') là lấy giá trị của data-target trong cái thẻ select
                // qua view xem cái thẻ select thì sẽ thấy data-target
            };
            TGNT.sendDataTogetLocation(option); // gọi hàm này để gửi dữ liệu lên server
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
                const choicesElement = document.querySelector(`.${option.target}`);
                if (choicesElement.choicesInstance) {
                    choicesElement.choicesInstance.destroy();
                }
                const choices_new = new Choices(choicesElement);
                choicesElement.choicesInstance = choices_new;
    
                // Tự động change nếu điều kiện thỏa mãn
                if (district_id != "" && option.target == "districts") {
                    $(".districts").val(district_id).trigger("change");
                }
    
                // Tự động chọn giá trị đã chọn trước đó
                if (ward_id != "" && option.target == "wards") {
                    $(".wards").val(ward_id).trigger("change");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Lỗi: " + textStatus + " " + errorThrown);
            },
        });
    };
    

    // Hàm để tự động load tỉnh thành khi bị lỗi validate hay vào edit user ....
    TGNT.loadLocation = () => {
        // check xem biến province_id có dữ liệu không
        // biến province_id là biến toàn cục được khai báo trong view (file location.blade.php) đó
        if (province_id != "") {
            // nếu có thì set giá trị cho select tỉnh thành và trigger sự kiện change
            // (Là nó tự động chạy sự kiện change khi bị lỗi validate hay vào edit user ....)
            // là nó tự động chọn cái tỉnh thành mà mình đã chọn trước đó, rồi nó sẽ tự động chọn huyện và xã
            $(".province").val(province_id).trigger("change");
        }
    };

    $(document).ready(function () {
        TGNT.getLocation();
        TGNT.loadLocation();
    });
})(jQuery);
