$(function () {
    YM.Notifications = {
        container : $('.notifications-dropdowns'),
        currentPage: 1,
        lastPage:1,
        init: function(){
            if(this.container.length > 0){
                YM.Notifications.get();
                YM.Notifications.scroll();
                YM.Notifications.read();
            }
        },
        get:function(){
            const url = new URL(this.container.data('url'));
            url.searchParams.append('page',this.currentPage);
            $.get(url).then((res) => {
                YM.Notifications.currentPage = res.currentPage;
                YM.Notifications.lastPage = res.lastPage;
                YM.Notifications.container.find('.header-notifications-list').append(res.view);
            });
        },
        scroll : function(){
            this.container.find('.header-notifications-list').on('scroll',function(){
                let div = $(this).get(0);
                if(div.scrollTop + div.clientHeight >= div.scrollHeight) {
                    if(YM.Notifications.currentPage < YM.Notifications.lastPage){
                        YM.Notifications.currentPage+=1;
                        YM.Notifications.get();
                    }
                }
            });
        },
        read:function(){
            this.container.find('.notifications-read').on('click',function(e){
               e.preventDefault();
                const url = new URL( $(this).attr('href'));
                url.searchParams.append('page',YM.Notifications.currentPage);
                $.get(url).then((res) => {
                    YM.Notifications.container.find('.notify-badge').text(res.total);
                    YM.Notifications.currentPage = 1;
                    YM.Notifications.container.find('.header-notifications-list').empty();
                    YM.Notifications.get();
                });
            });
        }
    }

    YM.Notifications.init();
});
