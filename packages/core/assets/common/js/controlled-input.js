$(function () {
    const elems = $(".controlled-input");
    if (elems.length > 0) {
        elems.each(function(i,elem){
            const el = $(elem);
            const controller = $(el.data('controller'));
            const values = el.data("options").toString().split(',');
            controller.on('change',function(){
                const val = $(this).val();
                if(values.includes(val)){
                    el.parent().parent().removeClass('d-none');
                }else{
                    el.parent().parent().addClass("d-none");
                }
            });
            controller.trigger('change');
        });
    }
});
