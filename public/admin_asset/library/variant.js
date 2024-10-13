(function($) {
	"use strict";
	var TGNT = {}; 

    TGNT.setupProductVariant = () => {
        if($('.turnOnVariant').length){
            $(document).on('click', '.turnOnVariant', function(){
                $(".variant-wrapper").toggleClass(
                    "hidden",
                    !$(this).is(":checked")
                );
            })
        }
    }

    TGNT.addVariant = () => {
        if($('.add-variant').length){
            $(document).on('click', '.add-variant', function(){
                let html = TGNT.renderVariantItem(attributeCatalogue)
                $(".variant-body").append(html);
                TGNT.checkMaxAttributeGroup(attributeCatalogue);
                TGNT.disabledAttributeCatalogueChoose();
            })
        }
    }

    TGNT.renderVariantItem = (attributeCatalogue) => {
        let html = '';
        html += '<div class="row mb-3 variant-item ">';
            html += '<div class="col-lg-3">';
                html += '<div class="attribute-catalogue">';
                    html += '<select name="" id="" class="choose-attribute niceSelect">';
                        html += '<option value="">Chọn Nhóm thuộc tính</option>';
                        for(let i = 0; i < attributeCatalogue.length; i++){
                        html += '<option value="'+attributeCatalogue[i].id+'">'+attributeCatalogue[i].name+'</option>';
                        }
                    html += '</select>';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-8">';
                html += '<input type="text" name=""disabled class="fake-variant h-100 form-control">';
            html += '</div>';
            html += '<div class="col-lg-1">';
                html += '<button type="button" class="h-100 w-100 remove-attribute btn btn-danger">';
                    html += '<i class="fas fa-trash-alt"></i>';
                html += '</button>';
            html += '</div>';
        html += '</div>';

        return html;
    }

    TGNT.chooseVariantGroup = () => {
        $(document).on('change', '.choose-attribute', function(){
            let _this = $(this)
            let attributeCatalogueId = _this.val()
            if(attributeCatalogueId != 0){
                _this.parents('.col-lg-3').siblings('.col-lg-8').html(TGNT.select2Variant(attributeCatalogueId))
                $('.selectVariant').each(function(key, index){
                    TGNT.getSelect2($(this))
                })
            }else{
                _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" name="" disabled="" class="fake-variant form-control">')
            }

            TGNT.disabledAttributeCatalogueChoose();
        })
    }

    TGNT.createProductVariant = () => {
        $(document).on('change', '.selectVariant', function(){
            let _this = $(this)
            TGNT.createVariant()
        })
    }

    TGNT.createVariant = () => {

        let attributes = []
        let variants = []
        let attributeTitle = []

        $('.variant-item').each(function(){
            let _this = $(this)
            let attr = []
            const attributeCatalogueId = _this.find('.choose-attribute').val()
            const optionText = _this.find('.choose-attribute option:selected').text()
            const attribute = $('.variant-'+attributeCatalogueId).select2('data')     
            
            for(let i = 0; i < attribute.length; i++){
               let item = {}
               let itemVariant = {}
               item[optionText] = attribute[i].text
               attr.push(item)
            }
            attributeTitle.push(optionText)
            attributes.push(attr)
            let attributesNEw = TGNT.generateVariants(attributes)
            let html = TGNT.renderTableHtml(attributeTitle, attributesNEw);
            console.log(html);
            
            $('.table.variantTable').html(html)
        })
    }

    TGNT.generateVariants = (attributes)  =>{
        let results = [];
        function helper(current, depth) {
            if (depth === attributes.length) {
                results.push(current);
                return;
            }
            attributes[depth].forEach(item => {
                helper({ ...current, ...item }, depth + 1);
            });
        }
        helper({}, 0);
        return results;
    }

    TGNT.renderTableHtml = (attributeTitle, attributes) => {
        let html = '';
        html += `<thead>`
            html += `<tr class="table-pri">`
                html += `<th scope="col">Hình ảnh</th>`
                attributeTitle.forEach(element => {
                    html += `<th scope="col">${element}</th>`
                });
                html += `<th scope="col">Số lượng</th>`
                html += `<th scope="col">Giá tiền</th>`
                html += `<th scope="col">SKU</th>`
            html += `</tr>`
        html += `</thead>`
        html += `<tbody>`
            attributes.forEach(attribute => {
                html += `<tr class="variant-row">`
                    html += `<td>`
                        html += `<span class="img img-cover">`
                            html += `<img width="50" class="rounded" src="https://placehold.co/600x600?text=The%20Gioi\nNoi%20That" alt="">`
                        html += `</span>`
                    html += `</td>`
                    $.each(attribute, function(key, value){
                        html += `<td>${value}</td>`
                    })
                    html += `<td>-</td>`
                    html += `<td>-</td>`
                    html += `<td>-</td>`
                 html += `</tr>`
            });
        html += `</tbody>`
        return html;
    }


    TGNT.getSelect2 = (object) => {
        $(object).select2({
            minimumInputLength: 1,
            placeholder: 'Nhập tối thiểu 1 kí tự để tìm kiếm giá trị thuộc tính',
            ajax: {
                url: '/getAttributeValue',
                type: 'GET',
                dataType: 'json',
                deley: 250,
                data: function (params){
                    return {
                        search: params.term,
                        attribute_id: object.attr('data-catid')
                    }
                },
                processResults: function(data){
                    return {
                        results: data.data
                    }
                },
                cache: true
              }
        });
    }

    TGNT.niceSelect = () => {
        $('.niceSelect').niceSelect();
    }

    TGNT.destroyNiceSelect = () => {
        if($('.niceSelect').length){
            $('.niceSelect').niceSelect('destroy')
        }
    }
    
    TGNT.disabledAttributeCatalogueChoose = () => {
        let id = [];
        $('.choose-attribute').each(function(){
            let _this = $(this)
            let selected = _this.find('option:selected').val()
            if(selected != 0){
                id.push(selected)
            }
        })


        $('.choose-attribute').find('option').removeAttr('disabled')
        for(let i = 0; i < id.length; i++){
            $('.choose-attribute').find('option[value='+id[i]+']').prop('disabled', true)
        }
        TGNT.destroyNiceSelect()
        TGNT.niceSelect()
        $('.choose-attribute').find('option:selected').removeAttr('disabled')
    }

    TGNT.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $('.variant-item').length
        if(variantItem >= attributeCatalogue.length){
            $('.add-variant').remove()
        }else{
            $('.variant-foot').html('<button type="button" class="btn btn-primary add-variant">Thêm phiên bản mới</button>')
        }
    }

    TGNT.removeAttribute = () => {
        $(document).on('click', '.remove-attribute', function(){
            let _this = $(this)
            _this.parents('.variant-item').remove()
            TGNT.checkMaxAttributeGroup(attributeCatalogue)
            TGNT.createVariant()
        })
    }

    TGNT.select2Variant = (attributeCatalogueId) => {
        let html = '<select class="selectVariant variant-'+attributeCatalogueId+' form-control" name="attribute['+attributeCatalogueId+'][]" multiple data-catid="'+attributeCatalogueId+'"></select>'
        return html
    }

    TGNT.uploadAlbumVariant = () => {
        $(document).on('click', '.upload-picture-variant', function(e){
            TGNT.browseServerAlbumVariant($(this).attr('data-name'));
            e.preventDefault();
        })
    }

    TGNT.browseServerAlbumVariant = (data_name) => {
        var type = 'Images';
        var finder = new CKFinder();
        
        finder.resourceType = type;
        finder.selectActionFunction = function( fileUrl, data, allFiles ) {
            let html = '';
            for(var i = 0; i < allFiles.length; i++){
                var image = allFiles[i].url
                html += '<li class="ui-state-default img_li_tgnt col-xl-2 col-md-3 col-sm-6 mb-3">'
                   html += ' <div class="thumb img_albums_tgnt">'
                       html += ' <span class="span image img-scaledown">'
                            html += '<a href="'+image+'" data-fancybox="gallery" data-caption="">'
                                html += '<img src="'+image+'" alt="'+image+'" width="100%" class="img-thumbnail">'
                            html += '</a>'
                            html += '<input type="hidden" name="'+data_name+'[]" value="'+image+'">'
                        html += '</span>'
                        html += '<div class="btn_delete_albums_tgnt">'
                            html += '<button class="delete-image btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>'
                        html += '</div>'
                    html += '</div>'
                html += '</li>'
            }
            $('#sortableVariant').append(html)
        }
        finder.popup();
    }

	$(document).ready(function(){
        TGNT.setupProductVariant()
        TGNT.addVariant()
        TGNT.niceSelect()
        TGNT.chooseVariantGroup()
        TGNT.removeAttribute()
        TGNT.createProductVariant()
        TGNT.uploadAlbumVariant()
	});

})(jQuery);

