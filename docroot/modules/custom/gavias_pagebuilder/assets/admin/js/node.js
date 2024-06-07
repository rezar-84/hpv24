(function ($) {
$(document).ready(function(){

   var check = $('.node-form .field_enable_disable_pagebuider').val();
   if(check == 'disable'){
      $('.node-form .pagebuilder-enable-disable').html('Enable Page Builder');
      $('.node-form #gavias-pagebuilder-admin-content-main').addClass('hidden');
   }

   $('.node-form .pagebuilder-enable-disable').on('click', function(){
      var check = $('.node-form .field_enable_disable_pagebuider').val();
      if(check == 'disable'){
         $('.node-form .pagebuilder-enable-disable').html('Disable Page Builder');
         $('.node-form #gavias-pagebuilder-admin-content-main').removeClass('hidden');
         $('.node-form .field_enable_disable_pagebuider').val('enable');
      }else{
         $('.node-form .pagebuilder-enable-disable').html('Enable Page Builder');
         $('.node-form #gavias-pagebuilder-admin-content-main').addClass('hidden');
         $('.node-form .field_enable_disable_pagebuider').val('disable');
      }
   });

   $('.pagebuilder-fullscreen').on('click', function(e){
      if($(this).hasClass('fullscreen')){
         $(this).removeClass('fullscreen');
         $(this).parents('.node-form').removeClass('node-main-full');
         $(this).html('<i class="fa fa-arrows-alt"></i>&nbsp;&nbsp;Full Width');
      }else{
         $(this).addClass('fullscreen');
         $(this).parents('.node-form').addClass('node-main-full');
         $(this).html('<i class="fa fa-arrows-alt"></i>&nbsp;&nbsp;Normal Width');
      }
   })

})
})(jQuery);
