$(function () {
    const elems = $('.nepali-date');
    if(elems.length > 0) {
        function format(date){
            let month = date.getMonth() + 1;
            if(month < 10){
                month = '0' + month
            }
            return date.getFullYear() + '-' + month + '-' + date.getDate();
        }
        elems.nepaliDatePicker({
            dateFormat: "%y-%m-%d",
        });

        elems.each(function(idex,elem){
            const date = $(elem).data('date');
            if(date){
                let format = date.split('-').map(Number);
                const nep_date = calendarFunctions.getBsDateByAdDate(format[0], format[1], format[2]);
                let nepali_date = calendarFunctions.bsDateFormat("%y-%m-%d",nep_date.bsYear,nep_date.bsMonth,nep_date.bsDate)
                if($(elem).data('nepali') === 0){
                    nepali_date = nep_date.bsYear + '-' + nep_date.bsMonth + '-' +  nep_date.bsDate;
                }
                $(elem).val(nepali_date);
                const eng_date_input = $(elem).attr('data-ad-elem');
                if(eng_date_input) {
                    $(eng_date_input).val(date);
                }
            }
        });
        elems.on('dateSelect',function (e) {
            const nepali = e.datePickerData.bsYear + '-' + e.datePickerData.bsMonth + '-' + e.datePickerData.bsDate;
            console.log(nepali);
            const nepali_date_input = $(this).data('elem');
            const eng_date_input = $(this).attr('data-ad-elem');
            const en_date = $(this).attr('data-en-elem');
            $(nepali_date_input).val(nepali);
            if(eng_date_input) {
                const english = format(e.datePickerData.adDate);
                $(eng_date_input).val(english);
            }
            if(en_date){
                $(en_date).val(nepali);
            }
        });
    }
});
