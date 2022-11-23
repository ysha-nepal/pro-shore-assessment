$(function () {
    $('.selector-importer').on('change',function(){
        const val = $(this).val();
        if(val){
            const url = $(this).data('import-url');
            const container = $($(this).data('import-container'));
            const selected = container.data('selected') || '';
            let select = "";
            $.get(`${url}?value=${val}`).then((res) => {
                container.empty();
                const reversedKeys = Object.keys(res).reverse();
                reversedKeys.forEach(key => {
                    if (selected.toString() === key.toString()) {
                        select = "selected";
                    } else {
                        select = "";
                    }
                    container.append(
                        `<option ${select} value=${key} >${res[key]}</option>`
                    );
                });
            });
        }
    });
    $('.selector-importer').trigger('change');
});
