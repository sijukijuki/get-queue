/*!
Upload javascript functions for use Wordpress Media Uploader 
SliderNews plugin for wordpress - the wrapper for JSliderNews, JQuery-based slider from LoF (@link http://landofcoder.com LoF) 
Wordpress version supported: 3.4 and above

@package SliderNews
@since 0.3.3	
@link http://blog.pshentsoff.ru/wp-plugins/slidernews Plugin URI

@author Vadim Pshentsov <pshentsoff@yandex.ru>
@link http://blog.pshentsoff.ru/ Author URI

@copyright Copyright 2012  Vadim Pshentsov  (email : pshentsoff@yandex.ru)
@license http://opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2 (GPL-2.0)
*/  

jQuery(document).ready(function() {
  
  var inputID = ''; //input for image file url 
  var altID = '';   //input for image alternative text
  var imgID = '';   //image 
  
  jQuery('.image-file-upload').click(function() {

    inputID = jQuery(this).prev('input');
    altID = jQuery('#'+jQuery(this).attr('name')+'-alt');
    imgID = jQuery('#'+jQuery(this).attr('name'));

    tb_show('', 'media-upload.php?type=image&amp;amp;amp;TB_iframe=true');
    
    return false;
  });
  
  window.send_to_editor = function(html) {
  
     img_url = jQuery('img',html).attr('src');
     img_alt = jQuery('img',html).attr('alt'); 

     inputID.val(img_url);
     altID.val(img_alt);
     
     imgID.attr('src', img_url); 
     imgID.attr('alt', img_alt);
      
     tb_remove();
     };
     
});
