(function ($) {
    "use strict"
    var TGNT = {}

    TGNT.requestUrl = () => {
        $(document).on('change', '.select_action', function () {
          let _this = $(this);
          console.log(_this.attr('name')); 
          let url = new URL(window.location.href);
          let search_params = url.searchParams;
          search_params.set(_this.attr('name'), _this.val());
          url.search = search_params.toString();
          console.log(url);
          
          window.location.href = url.href; 
        });
      }

    TGNT.changeStatusByField = () => {
        $(document).on('change', '.status', function (e) {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            let _this = $(this)
            let attributes = {
                field: _this.attr('data-field'),
                value: _this.attr('data-value'),
                model: _this.attr('data-model'),
                id: _this.attr('data-id')
            }

            $.ajax({
                url: '/change/status',
                type: 'PUT',
                data: attributes,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);

                    Toast.fire({
                        icon: 'success',
                        title: "Cập nhật trạng thái thành công"
                    })
                },
                error: function (error) {
                    Toast.fire({
                        icon: 'error',
                        title: "Cập nhật trạng thái thất bại"
                    })
                }
            })

        })
    }

    TGNT.setupAjaxHeader = () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            }
        })
    }

    TGNT.checkBoxItem = () => {
        if ($('.checkbox-item').length) {
            $(document).on('click', '.checkbox-item', function () {
                let _this = $(this)
                TGNT.changeBackgroud(_this)
                TGNT.allChecked()
                TGNT.handleMultipleAction()
            })
        }
    }

    TGNT.changeBackgroud = (input) => input.closest('tr').toggleClass('active-bg', input.prop('checked'))

    TGNT.allChecked = () => {
        let checkBoxs = $('.checkbox-item')
        $('#checkAll').prop('checked', checkBoxs.length && checkBoxs.filter(':checked').length === checkBoxs.length)
    }

    TGNT.checkAll = () => {
        let checkAll = $('#checkAll')
        if (checkAll.length) {
            $(document).on('click', '#checkAll', function () {
                let isChecked = checkAll.prop('checked')
                $('.checkbox-item').prop('checked', isChecked).each(function () {
                    TGNT.changeBackgroud($(this))
                })
                TGNT.handleMultipleAction()
            })
        }
    }

    TGNT.handleMultipleAction = () => {
        $('#actions').parent().toggle($('.checkbox-item:checked').length > 0)
    }

    TGNT.hideActions = () => {
        $('#actions').parent().hide()
    }

    TGNT.action = () => {
        if ($('#actions').length) {
            $(document).on('change', '#actions', function () {
                let _this = $(this)
                let method = (_this.val() === 'delete') ? 'DELETE' : 'PUT'
                let ids = TGNT.getIds()

                if (ids.length === 0) {
                    alert('Adu hacker!');
                    return false
                }


                Swal.fire({
                    title: "Bạn có chắc không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm!",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/actions',
                            type: method,
                            data: {
                                option: _this.val(),
                                model: $('#model').val(),
                                ids: ids
                            },
                            dataType: "JSON",
                            success: function (response) {
                                let option = _this.val().split('-');
                                if (option[0] != 'delete') {
                                    let isActive = option[1] == 1 ? true : false;
                                    for (let i = 0; i < ids.length; i++) {
                                        $('.js-switch-' + ids[i]).find('.js-switch').attr('checked', isActive );
                                    }
                                } else {
                                    for (let i = 0; i < ids.length; i++) {
                                        $('#customCheckbox' + ids[i]).parents('tr').remove();
                                    }
                                }

                                $('.checkbox-item').prop('checked', false);
                                $('#checkAll').prop('checked', false);
                                TGNT.hideActions();
                                $('.table').find('tr').removeClass('active-bg');

                                var Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: "Thực hiện thành công hành động"
                                })
                            },
                            error: function (error) {
                                console.error(error);
                            }
                        });
                    }
                });

            })
        }
    }

    TGNT.getIds = () => {
        return $('.checkbox-item:checked').map(function () {
            return $(this).val()
        }).get()
    }

    TGNT.delete_item = () => {
        $(document).on('click', '#delete_tgnt', function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            
            let _this = $(this); 
            // console.log(_this.attr('data-id'));
            Swal.fire({
                title: "Bạn có chắc không?",
                text: "Khi xóa sẽ không thể hoàn tác được!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa!",
                cancelButtonText: "Hủy",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/deleteItem',
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            model: _this.attr('data-model'),
                            id: _this.attr('data-id')
                        },
                        dataType: "JSON",
                        success: function (response) {
                        _this.closest('tr').remove();
                            Toast.fire({
                                icon: 'success',
                                title: "Xóa thành công"
                            })
                        },
                        error: function (error) {
                            Toast.fire({
                                icon: 'success',
                                title: "Xóa không thành thành công"
                            })
                        }
                    });
                }
            });
        });
    };
    
    TGNT.tagify = () => {
		var tagify_tgnt = document.querySelector('.tagify_tgnt');
		new Tagify(tagify_tgnt);
    }
    
    TGNT.select2 = () => {
        if($('.select2').length){
            $('.select2').select2({
                theme: 'bootstrap4'
              })
        }  
    }

    TGNT.sortui = () => {
        $( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
    }

    $(document).ready(function () {
        TGNT.setupAjaxHeader()
        TGNT.changeStatusByField()
        TGNT.checkBoxItem()
        TGNT.checkAll()
        TGNT.hideActions()
        TGNT.action()
        TGNT.delete_item()
        TGNT.select2()
        TGNT.tagify()
        TGNT.sortui()
        TGNT.requestUrl()
    })





})(jQuery)
