<?php
include('../../../wp-config.php');
$site_url = get_option('siteurl');
?>
jQuery(document).ready(function() {

   //when the link with the id of save_settings is clicked, get the value of the text field and start doing the ajax stuff
   jQuery('#save_settings').click(function() {
   
      var SL_values = jQuery("#SL_values").val();
      var SL_values2 = jQuery("#SL_values2").val();
      var SL_post_ID = jQuery("#the_post_ID").val();
      
      //action is the name of the php function in your main plugin file 
      jQuery.post("<?php echo $site_url; ?>/wp-admin/admin-ajax.php", {action:"SL_save_settings", 'cookie': encodeURIComponent(document.cookie), SL_values:SL_values, SL_values2:SL_values2, SL_post_ID:SL_post_ID},
      function(res)
      {
         var message_result = eval('(' + res + ')');
         if (!message_result.success) {
            jQuery("#SL_values").css("border","2px solid #cc0000");
            jQuery("#SL_values2").css("border","2px solid #cc0000");
         } else {
            jQuery("#SL_values").css("border","1px solid #dfdfdf");
            jQuery("#SL_values2").css("border","1px solid #dfdfdf");         
         }
         alert(message_result.message);
      });

      return false;
   });

});