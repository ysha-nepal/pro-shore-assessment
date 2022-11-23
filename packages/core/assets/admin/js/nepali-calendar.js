$(function () {
    YM.NepaliCalendar = {
        url: $('#nepali-calendar-container').data('url'),
        container: $('#nepali-calendar-container'),
        month:null,
        year:null,
        events:{},
        init: function () {
            this.renderCalendar();
            YM.NepaliCalendar.monthChange();
            YM.NepaliCalendar.yearChange();
            YM.NepaliCalendar.prevMonth();
            YM.NepaliCalendar.nextMonth();
            YM.NepaliCalendar.currentDate();
            YM.NepaliCalendar.renderModal();
            YM.NepaliCalendar.hideModal();
        },
        monthChange: function(){
            this.container.on('change','.month-selector',function(){
                YM.NepaliCalendar.month = parseInt($(this).val()) + 1;
                YM.NepaliCalendar.renderCalendar();
            });
        },
        yearChange: function(){
            this.container.on('change','.year-selector',function(){
                YM.NepaliCalendar.year = parseInt($(this).val()) + 1;
                YM.NepaliCalendar.renderCalendar();
            });
        },
        prevMonth:function(){
            this.container.on('click','.prev-month',function(){
                YM.NepaliCalendar.year = YM.NepaliCalendar.month === 1 ? YM.NepaliCalendar.year - 1 : YM.NepaliCalendar.year;
                YM.NepaliCalendar.month = YM.NepaliCalendar.month === 1 ?  12 : YM.NepaliCalendar.month - 1;
                YM.NepaliCalendar.renderCalendar();
            });
        },
        nextMonth:function(){
            this.container.on('click','.next-month',function(){
                YM.NepaliCalendar.year = YM.NepaliCalendar.month === 12 ? YM.NepaliCalendar.year + 1 : YM.NepaliCalendar.year;
                YM.NepaliCalendar.month = YM.NepaliCalendar.month === 12 ?  1 : YM.NepaliCalendar.month + 1;
                YM.NepaliCalendar.renderCalendar();
            });
        },
        currentDate:function(){
            this.container.on('click','.current-date',function(){
                YM.NepaliCalendar.year = null;
                YM.NepaliCalendar.month = null;
                YM.NepaliCalendar.renderCalendar();
            });
        },
        renderCalendar:function(){
            const url = new URL(this.url);
            if(this.month){
                url.searchParams.append('month',this.month);
            }
            if(this.year){
                url.searchParams.append('year',this.year);
            }
            $.get(url).then((res) => {
                YM.NepaliCalendar.container.empty().append(res.view);
                YM.NepaliCalendar.month = res.month;
                YM.NepaliCalendar.year = res.year;
                YM.NepaliCalendar.events = res.events;

            });
        },
        renderModal:function(){
           YM.NepaliCalendar.container.on('click','.calendar-days',function(){
               $('.calendar-event-container').addClass('event-trans');
               $(this).find('.calendar-event-container').removeClass('event-trans');
           })
        },
        hideModal:function(){
            YM.NepaliCalendar.container.on('click','.calendar-days .calendar-event-close',function(e){
                e.stopPropagation();
                $(this).parent().parent().addClass('event-trans');
            });
        }
    };
    if( $('#nepali-calendar-container').length > 0){
        YM.NepaliCalendar.init();
    }
});
