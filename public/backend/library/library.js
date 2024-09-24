(function($){
    "use strict"
    var HT = {}

    HT.Switchery = () => {
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small' })
        })
    }

    HT.changeStatusByField = () => {
        $(document).on('change', '.status', function(e){
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
                success: function(response){
                    console.log(response);
                    
                },
                error: function(error){
                    console.error(error)
                }
            })
            
        })
    }

    HT.setupAjaxHeader = () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
            }
        })
    }

    HT.featherIcon = () => {
        feather.replace();
    }

    HT.checkBoxItem = () => {
        if($('.checkbox-item').length){
            $(document).on('click', '.checkbox-item', function(){
                let _this = $(this)
                HT.changeBackgroud(_this)
                HT.allChecked()
                HT.handleMultipleAction()
            })
        }
    }

    HT.changeBackgroud = (input) =>  input.closest('tr').toggleClass('active-bg', input.prop('checked'))

    HT.allChecked = () => {
        let checkBoxs = $('.checkbox-item')
        $('#checkAll').prop('checked', checkBoxs.length && checkBoxs.filter(':checked').length === checkBoxs.length)
    }

    HT.checkAll = () => {
        let checkAll = $('#checkAll')
        if(checkAll.length){
            $(document).on('click', '#checkAll', function(){
                let isChecked = checkAll.prop('checked')
                $('.checkbox-item').prop('checked', isChecked).each(function(){
                    HT.changeBackgroud($(this))
                })
                HT.handleMultipleAction()
            })
        }
       
    }

    HT.handleMultipleAction = () => {
        $('#actions').parent().toggle($('.checkbox-item:checked').length > 0)
    }

    HT.hideActions = () => {
        $('#actions').parent().hide()
    }

    HT.action = () => {
        if($('#actions').length){
            $(document).on('change', '#actions', function(){
                let _this = $(this)
                let method = (_this.val() === 'delete') ? 'DELETE' : 'PUT'
                let ids = HT.getIds()

                if(ids.length === 0){
                    alert('You must select at least one record to perform this action!');
                    return false
                }


                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this action!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirm!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: '/actions',
                        type: method,
                        data: {
                            option: _this.val(),
                            model: $('#model').val(),
                            ids: ids 
                        },
                        dataType: "JSON",
                        success: function(response){
                            let option = _this.val().split('-')
                            if(option[0] != 'delete'){
                                let styles = {
                                    active: {
                                        main : 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 11px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;',
                                        small : 'left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s, left 0.2s;'
                                    },
                                    inactive: {
                                        main: 'box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;',
                                        small: 'left: 0px; transition: background-color 0.4s, left 0.2s;'
                                    }
                                }
        
                                let isActive = option[1] == 2
                                let cssMain = isActive ? styles.active.main : styles.inactive.main
                                let cssSmall = isActive ? styles.active.small : styles.inactive.small
                                for(let i = 0; i < ids.length; i++){
                                    $('.js-switch-' + ids[i]).find('span.switchery').attr('style', cssMain).find('small').attr('style', cssSmall)
                                    $('.js-switch-' + ids[i]).find('.js-switch').attr('data-value', option[1])
                                }
                            }else{
                                for(let i = 0; i < ids.length; i++){
                                    $('.js-switch-' + ids[i]).parents('tr').remove()
                                }
                            }
                            
                            $('.checkbox-item').prop('checked', false)
                            $('#checkAll').prop('checked', false)
                            HT.hideActions()
                            $('.table').find('tr').removeClass('active-bg')

                            swal("Successfully!", "Successfully performed the action.", "success");
                        },
                        error: function(error){
                            console.error(error)
                        }
                    })

                    
                });  
            })
        }
    }

    HT.getIds = () => {
        return $('.checkbox-item:checked').map(function(){
            return $(this).val()
        }).get()
    }

    $(document).ready(function(){
        HT.featherIcon()
        HT.setupAjaxHeader()
        HT.Switchery()
        HT.changeStatusByField()
        HT.checkBoxItem()
        HT.checkAll()
        HT.hideActions()
        HT.action()
    })





})(jQuery)
