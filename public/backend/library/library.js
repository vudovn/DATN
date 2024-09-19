(function($){
    "use strict"
    var HT = {}

    HT.Switchery = () => {
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small' })
        })
    }

    $(document).ready(function(){
        HT.Switchery()
    })





})(jQuery)
