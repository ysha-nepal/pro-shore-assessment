$(function () {
    $('#test_email_sender').on('click',function(e){
        e.preventDefault();
        console.log('a');
        const value = $('#test_email').val();
        $('.test_email_result').html(`<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>`);
        const url = $(this).data('url') + `?email=${value}`;
        $.get(url).then(response => {
            console.log(response);
            $('.test_email_result').html(response)
        })
    });
});
