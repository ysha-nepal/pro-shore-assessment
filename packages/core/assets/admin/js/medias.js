$(function () {
    $("#mediaModal").on("shown.bs.modal", function (e) {
        function getImages(url) {
            const route = new URL(url);
            route.searchParams.append('type',type);
            $.get(route).then((res) => {
                $("#nav-selector .gallery-container").empty().append(res.view);
                const selected = $("input[name^=medias]").map(function(idx,elem){
                    const val = $(elem).val()
                    if( val != ""){
                        return val;
                    }
                }).get();

                $("#nav-selector .gallery-container .gallery-item").each(function(idx,elem){
                    console.log(selected);
                    const id = $(this).data('id').toString();
                    if(selected.includes(id)){
                        $(this).addClass("gallery-image-active");
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();

            });
        }
        const trigger = $(e.relatedTarget);
        const isMultiple = trigger.data("multiple") ?? false;
        const type = trigger.data("type") ?? 'image';
        const field = trigger.data('field');

        $('#mediaModal #nav-selector-tab').text(type.toUpperCase());
        getImages($('#nav-selector-tab').data('url'));
        $("#mediaModal").on("click", ".gallery-item", function (e) {
            if (isMultiple) {
                $(this).toggleClass("gallery-image-active");
            } else {
                $(".gallery-item").removeClass("gallery-image-active");
                $(this).addClass("gallery-image-active");
            }
        });
        $("#media-uploader").on("submit", function (e) {
            e.preventDefault();
            const url = $(this).attr("action");
            const method = $(this).attr("method");
            const data = new FormData(this);
            $.ajax({
                url: url,
                method: method,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
            }).then((res) => {
                const $input = $("#media-uploader").find(
                    "input[name='medias[]']"
                );
                $("#media-uploader").find('#title').val("");
                $("#media-uploader").find("#description").val("");
                $input.replaceWith($input.val("").clone(true));
                $("#nav-images-tab").trigger("click");
                $("#mediaModal").find('.media-modal-message').text(res);
                $("#mediaModal").find('.media-modal-message-container').removeClass('d-none');
                setTimeout(function (){
                    $("#mediaModal").find('.media-modal-message').text('');
                    $("#mediaModal").find('.media-modal-message-container').addClass('d-none');
                },1000);
            });
        });



        $("#nav-selector-tab").on("click", function (e) {
            const url = $(this).data("url");
            getImages(url);
        });

        $(".gallery-container").on(
            "click",
            ".media-pagination a",
            function (e) {
                e.preventDefault();
                const url = e.target.href;
                getImages(url);
            }
        );

        $("#media-apply").on("click", function (e) {
            const editor = $('#mediaModal').data('editor');
            if(editor){
                const instance = CKEDITOR.instances[editor];
                $(".gallery-image-active").each(function (e) {
                    const val = $(this).find('img').attr("src");
                    instance.insertHtml(
                        `<img src=${val}>`
                    );
                });
            }else{
                const container = trigger.parent().find(".preview-container");
                const input_container = trigger
                    .siblings(".input-container")
                    .empty();
                container.empty();
                $(".gallery-image-active").each(function (e) {
                    const clone = $(this)
                        .find("img")
                        .clone()
                        .removeClass("gallery-image")
                        .addClass("preview-item");
                    container.append(clone);
                    const val = $(this).data("id");
                    input_container.append(
                        `<input type="hidden" name="${field}" value=${val}>`
                    );
                });
            }

            $("#nav-uploads").trigger("click");
            $("#mediaModal").modal("hide");
        });
    });
    $("#mediaModal").on("hidden.bs.modal", function (e) {
        $("#media-apply").off("click");
        $("#nav-selector-tab").off("click");
        $("#media-uploader").off("submit");
        $('#mediaModal').removeData('editor');
        $("#mediaModal").off('click');
    });
});
