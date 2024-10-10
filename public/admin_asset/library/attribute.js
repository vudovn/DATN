(function ($) {
    "use strict"
    var TGNT = {}
    // Trang attribute
    TGNT.add_attribute_value = () => {
        $(document).on('click', '.add_attribute_value', function () {
            let html = '';
            html += '<div class="input-group animate__animated animate__fadeInDown animate__faster mb-3">';
                html += '<input type="text" name="attribute_value[][]" class="form-control attribute_input" placeholder="Nhập giá trị thuộc tính" required>';
                html += '<div class="input-group-append">';
                    html += '<button class="btn btn-danger remove_attribute_value" type="button"><i class="fa fa-trash"></i></button>';
                html += '</div>';
            html += '</div>';
            
            $('.attribute_value_container').append(html);
        });
    
        $(document).on('click', '.remove_attribute_value', function () {
            $(this).closest('.input-group').remove();
        });
    
        $(document).on('input', '.attribute_input', function () {
            let currentValue = $(this).val().trim();
            let isDuplicate = false;
    
            $('.attribute_input').not(this).each(function () {
                if ($(this).val().trim() === currentValue) {
                    isDuplicate = true;
                    return false; 
                }
            });
    
            if (isDuplicate) {
                $(this).addClass('is-invalid');
                $(this).next('.error-message').remove();
                $('[type="submit"]').attr('disabled', true);
            } else {
                $(this).removeClass('is-invalid');
                $('[type="submit"]').attr('disabled', false);
            }
        });
    }
    // end trang attribute

    // Trang product
    TGNT.load_attribute_value = () => {
        $(document).on('change', '.attribute_id', function () {
            let attribute_id = $(this).val();
            let attribute_value = $(this).closest('.form-group').find('.attribute_value');
            let attribute_value_id = attribute_value.data('attribute_value_id');
            let selected_value = attribute_value.data('selected_value');
            let html = '';
            attribute_value.html('');
            // $.ajax({
            //     url: '/admin/attribute/get_attribute_value',
            //     method: 'GET',
            //     data: {
            //         attribute_id: attribute_id
            //     },
            //     success: function (response) {
            //         if (response.status == 'success') {
            //             response.data.forEach(value => {
            //                 html += '<option value="' + value.id + '"';
            //                 if (value.id == attribute_value_id) {
            //                     html += ' selected';
            //                 }
            //                 if (value.id == selected_value) {
            //                     html += ' disabled';
            //                 }
            //                 html += '>' + value.value + '</option>';
            //             });
            //             attribute_value.html(html);
            //         }
            //     }
            // });
        });
    }
    // end trang product
    

    $(document).ready(function () {
        TGNT.add_attribute_value();
        TGNT.load_attribute_value();
    });

})(jQuery);
