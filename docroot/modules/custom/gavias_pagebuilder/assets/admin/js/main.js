(function ($) {
$(document).ready(function(){

   //Select IMCE file, display image demo and set val for upload input.
   var gvaImceInput = window.gvaImceInput = window.gvaImceInput || {
     urlSendto: function(File, win) {
         var url = File.getUrl();
         var el = $('#' + win.imce.getQuery('inputId'))[0];
         win.close();
         if (el) {
           var base_path = drupalSettings.gavias_pagebuilder.base_path;
           //console.log(base_path);
           var url_new = '/' + url.replace(base_path, '');
           $(el).val(url_new);
           $(el).parents('.gva-upload-input').find('.gavias-image-demo').attr('src', url);
         }
      }
   }

})
})(jQuery);
