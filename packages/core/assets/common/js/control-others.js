$(function () {
    const elems = $(".controls-other");
    if(elems.length > 0){
        elems.on('change',function(){
            let val = $(this).val();
            if($(this).is(':checkbox')){
                if($(this).is(':checked')){
                    val = '1';
                }else{
                    val = '0';
                }
            }
            if($(this).is(':radio')){
                if($(this).is(':checked')){
                    val = '1';
                }else{
                    val = '0';
                }
            }
            const container = $(this).data("div");
            const hide = $(this).data("hide");
            if (val == $(this).data("value")) {
                $(container).removeClass("d-none");
                if (hide) {
                    $(hide).addClass("d-none");
                }
            } else {
                $(container).addClass("d-none");
                if (hide) {
                    $(hide).removeClass("d-none");
                }
            }
        });
        elems.trigger('change');
    }
});
