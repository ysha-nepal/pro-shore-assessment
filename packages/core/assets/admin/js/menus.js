$(function () {
    let orders = [];
    $( "#sortable" ).sortable({
        create:function(event,ui){
            orders = $(this).sortable('toArray',{attribute: 'value'});
        },
        update:function(event,ui){
            orders = $(this).sortable('toArray',{attribute: 'value'});
            const elem = $(event.toElement);
            if(elem.hasClass('sortable-child-menu')){
                let parent = elem.prevAll('.sortable-parent-menu').first();
                if(parent.length > 0){
                    elem.attr('data-parent',parent.attr('value'));
                }
                else{
                    $(this).sortable('cancel');
                }
            }
        }
    });
    $('#sortable input').on('change',function(){
        const container = $($(this).data('menu'));
        let status = $(this).is(':checked') ? 1 : 0;
        container.data('status',status);
    });
    const menu_form = $('#sortable').parent().parent();
    $(menu_form).on("submit",function(e){
        e.preventDefault();
        let data = [];
        let count = orders.length;
        jQuery.each(orders,function(order,id){
            const status = $("#item-" + id).data('status');
            const parent_id = $("#item-" + id).data('parent');
            let menu = {
                "id": id,
                "order":order+1,
                "status":status,
                "parent_id":parent_id
            };
            data.push(menu);
            if (!--count){
                const url = $("#sortable").data("url");
                data = JSON.stringify(data);
                $.ajax({
                    data: data,
                    url: url,
                    method: "POST",
                    contentType: 'application/json',
                }).done(function (response) {
                    location.reload();
                });
            }
        });

    });
});

