$(function () {
   const trigger = $('.permission-trigger');
   if(trigger.length > 0){
       trigger.on('change',function(){
         const selector = $(this).data('selector');
         const checked = $(this).is(':checked');
         console.log(checked);
         $(selector).each(function(){
            $(this).prop('checked',checked);
         });
       });
   }
});
