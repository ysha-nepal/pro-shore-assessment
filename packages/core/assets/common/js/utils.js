$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    const elem = $(`[data-slug]`);
    if (elem.length > 0) {
        elem.on("blur", function (e) {
            const string = $(this)
                .val()
                .toString()
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .toLowerCase()
                .trim()
                .replace(/\s+/g, "-")
                .replace(/[^\w-]+/g, "")
                .replace(/--+/g, "-");
            const slugElement = $(this).data("slug");
            $(slugElement).val(string);
        });
    }
    $('[data-toggle="tooltip"]').tooltip();

});
