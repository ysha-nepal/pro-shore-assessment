$(function () {
    const container = $(".authentication-content input[type='password']");
    container.parent().append(`<div class="position-absolute top-50 left-50 translate-middle-y search-icon px-3 right-0 password-show-hide"><i class="bi bi-eye"></i></div>`);
    container.parent().on('click','.password-show-hide',function(){
        const attr = container.attr('type');
        if(attr === "password"){
            container.attr("type","text");
        }else{
            container.attr("type","password");
        }
    });
});
