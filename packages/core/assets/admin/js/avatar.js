$(function(){
    const elems = $('.avatar-thumbnail');
    if(elems.length){
        elems.on('mouseover',function(){
            $('body').append(`
                <div class='avatar-wrapper'>
                    <img src="${$(this).attr('src')}" alt="${$(this).attr('alt')}" class="avatar-full-image ">
                </div>
            `);
        });
        elems.on('mouseout',function(){
            $('.avatar-wrapper').remove();
        });
    }
});
