<?php
/*
Plugin Name: SliderNews
Plugin URI: http://blog.pshentsoff.ru/wp-plugins/slidernews
Description: Plugin for JSliderNews, JQuery-based slider from LoF (http://landofcoder.com) 
Version: 0.4.3
Author: Vadim Pshentsov 
Author URI: http://blog.pshentsoff.ru/
Wordpress version supported: 3.4 and above
*/  

/*  Copyright 2012, 2014  Vadim Pshentsov  (email : pshentsoff@yandex.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('SLIDERNEWS_VERSION', '0.4.2');
define('SLIDERNEWS_VERSION_DEV', FALSE); # is it develop version
define('SLIDERNEWS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define('SLIDERNEWS_PLUGIN_DIR', str_replace(basename( __FILE__),'',SLIDERNEWS_PLUGIN_BASENAME).'/');
define('SLIDERNEWS_PLUGIN_URL', str_replace(get_home_url(), '', plugin_dir_url(__FILE__)));

require_once('slidernews-settings.php'); 
require_once('slidernews-functions.php'); 
require_once('slidernews-admin.php');

register_activation_hook( __FILE__, 'install_slidernews' );
register_uninstall_hook( __FILE__, 'uninstall_slidernews' );
if(defined('SLIDERNEWS_VERSION_DEV') && SLIDERNEWS_VERSION_DEV) {
  register_deactivation_hook( __FILE__, 'uninstall_slidernews' );
  }

//[slidernews]
function slidernews_shortcode($atts) {
  
  $slider_html = get_slidernews($atts['name'], TRUE); 
  
  return $slider_html;
}
//add_shortcode('slidernews-slider', 'slidernews_shortcode');

function slidernews_register_shortcodes() {
  add_shortcode('slidernews', 'slidernews_shortcode');
}
add_action('init', 'slidernews_register_shortcodes');

global $slidernews;
$slidernews = get_site_option(SLIDERNEWS_OPTIONS);

/**
 * Function installs slidernews plugin
 **/ 
function install_slidernews() {
	global $slidernews;
  global $wpdb;
  
  //Fill default option settings
  if(empty($slidernews)) {
    $slidernews = array(
      'default_width' => 640,
      'default_height' => 300,
      'default_readmore' => __('Read more', SLIDERNEWS_TEXTDOMAIN).' &gt;&gt;&gt;',
      'enqueue_style' => '',
      'multisite' => false,
      );
    }

  // SliderNews table
	$table_name = get_slidernews_prefix().SLIDERNEWS_TABLE;
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      $sql = "CREATE TABLE $table_name (
			id int(5) NOT NULL AUTO_INCREMENT,
			created int NOT NULL,
      changed int NOT NULL,
       
      name varchar(".SLIDERNEWS_NAME_MAXLENGTH.") NOT NULL,
      width int(5) NOT NULL DEFAULT '640',
      height int(5) NOT NULL DEFAULT '300',
      css_file varchar(".SLIDERNEWS_CSSFILE_LENGTH."),
      css text,
      
			PRIMARY KEY (id),
      INDEX name (name, id)
		  );";
	 $rs = $wpdb->query($sql);
   $slidernews[$table_name]['new'] = TRUE;
   } else {
   $slidernews[$table_name]['new'] = FALSE;
   }
   
  // Carousel Items table
	$items_table_name = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
	if($wpdb->get_var("show tables like '$items_table_name'") != $items_table_name) {
      $sql = "CREATE TABLE $items_table_name (
			id int(5) NOT NULL AUTO_INCREMENT,
			slidernews_id int(5) NOT NULL DEFAULT '1',
      order_tag int(5) NOT NULL DEFAULT '0',

			image_file varchar(".SLIDERNEWS_ITEM_IMAGEFILE_LENGTH."),
      image_alt varchar(".SLIDERNEWS_ITEM_IMAGEALT_LENGTH."),
      thumb_file varchar(".SLIDERNEWS_ITEM_THUMBFILE_LENGTH."),
      thumb_alt varchar(".SLIDERNEWS_ITEM_THUMBALT_LENGTH."),

      title varchar(".SLIDERNEWS_ITEM_TITLE_LENGTH."),
      link_url varchar(".SLIDERNEWS_ITEM_LINKURL_LENGTH."),
      readmore_text varchar(".SLIDERNEWS_ITEM_READMORE_LENGTH."),
      description varchar(".SLIDERNEWS_ITEM_DESCRIPTION_LENGTH."),
      
			PRIMARY KEY (id),
      INDEX order_tag (order_tag, id)
		  );";
	 $rs = $wpdb->query($sql);
   $slidernews[$items_table_name]['new'] = TRUE;
   } else {
   $slidernews[$items_table_name]['new'] = FALSE;
   }
  
  //Fill with sample data
  include('sample/insert_data.php');
    
  // clear new tables triggers
  unset($slidernews[$table]['new']);
  if(empty($slidernews[$table])) 
    unset($slidernews[$table]);
  unset($slidernews[$items_table]['new']);
  if(empty($slidernews[$items_table])) 
    unset($slidernews[$items_table]);
  
  
  delete_site_option(SLIDERNEWS_OPTIONS);
  update_site_option(SLIDERNEWS_OPTIONS, $slidernews);
}

function uninstall_slidernews() {

  if(!defined('SLIDERNEWS_VERSION_DEV') || !SLIDERNEWS_VERSION_DEV) {
    if (!defined('WP_UNINSTALL_PLUGIN') || __FILE__ != WP_UNINSTALL_PLUGIN )
      return;
    }
  
  global $wpdb;
  $sql = 'DROP TABLE IF EXISTS '
    .get_slidernews_prefix().SLIDERNEWS_TABLE
    .', '.get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE
    .';';
  $res = $wpdb->query($sql);
                  	
  delete_site_option(SLIDERNEWS_OPTIONS);
}

function slidernews_enqueue_scripts() {
	wp_enqueue_script( 'jquery.easing', slidernews_plugin_url( 'js/jquery.easing.js' ),
		array('jquery'), SLIDERNEWS_VERSION, false);
	wp_enqueue_script( 'slidernews_script_js', slidernews_plugin_url( 'js/script.js' ),
		array('jquery'), SLIDERNEWS_VERSION, false);
	wp_enqueue_script( 'slidernews_animtune_js', slidernews_plugin_url( 'js/animtune.js' ),
		array('jquery'), SLIDERNEWS_VERSION, false);
}
add_action( 'wp_enqueue_scripts', 'slidernews_enqueue_scripts' );


function slidernews_enqueue_styles($enqueue_style = null) {

  global $slidernews;

  $enqueue_style = isset($enqueue_style) ? $enqueue_style : $slidernews['enqueue_style'];

  if(!isset($enqueue_style) || empty($enqueue_style)) {
    $slider_settings = get_slidernews_settings($slidernews['id']);
    if(isset($slider_settings['css_file']) && !empty($slider_settings['css_file'])) {
      $enqueue_style = $slider_settings['css_file'];
    } else {
      $enqueue_style = SLIDERNEWS_CSSFILE_DEFAULT;
    }
  }

  $style_name = substr($enqueue_style, 0, strpos($enqueue_style, '.css'));
  $style_fileurl = slidernews_plugin_url( 'css/'.$enqueue_style );

//  wp_enqueue_style( 'slidernews-'.$style_name, $style_fileurl,
//		false, SLIDERNEWS_VERSION, 'screen');
  wp_enqueue_style( 'slidernews-'.$style_name, $style_fileurl);
}
add_action('wp_enqueue_scripts', 'slidernews_enqueue_styles');

/**
 * Print slider HTML code
 * @param $slider_name - name of slider in database
 * @param $in_return - TRUE to return slider html, FALSE - to print out (default) 
 * @return - no return  
 **/ 
function get_slidernews($slider_name = 'sample', $in_return = FALSE) {

  global $slidernews;
  
  $slider_id = get_slidernews_id($slider_name);
  
  if($in_return) ob_start();
?>
<div id="container">
<div id="jslidernews2" class="lof-slidecontent">

<?php  
  if(!$slider_id) {
    slidernews_message('Slider name');
    echo ' - "'.$slider_name.'"<br />';
    slidernews_message('Error - slider data not found.');
    ?></div></div><?php
    return;
    }
  
  $slider_settings = get_slidernews_settings($slider_id); 
  $slider_items = get_slidernews_carousel_items($slider_id);

  if(!empty($slider_settings['css_file']) && ($slidernews['enqueue_style'] != $slider_settings['css_file'])) {
    $slidernews['enqueue_style'] = $slider_settings['css_file'];
    slidernews_enqueue_styles($slider_settings['css_file']);
    }
  ?>
	<div class="preload"><div></div></div>
  <?php
  if(is_array($slider_items) && !empty($slider_items)) {
    ?>
  <div  class="button-previous"><?php _e('Previous', 'slidernews'); ?></div>
  <div class="main-slider-content" style="width:<?php echo $slider_settings['width']; ?>px; height:<?php echo $slider_settings['height']; ?>px;">
     <ul class="sliders-wrap-inner">
 	   <?php
      reset($slider_items); 
      foreach($slider_items as $slider_item) {
        echo '<li><img title="'.$slider_item['title'].'"';
        echo ' alt="'.$slider_item['image_alt'].'"';
        echo ' src="'.$slider_item['image_file'].'"></li>';
        }
      ?>
     </ul>  	
  </div>
  <div class="navigator-content">
  	<div class="navigator-wrapper">
  		<ul class="navigator-wrap-inner">
      <?php
      reset($slider_items); 
      foreach($slider_items as $slider_item) {
        ?><li>
           <div>
            <a title="<?php echo $slider_item['title']; ?>" href="<?php echo $slider_item['link_url']; ?>"><img  alt="<?php echo $slider_item['thumb_alt']; ?>" src="<?php echo $slider_item['thumb_file']; ?>" /></a>
            <h3><?php echo $slider_item['title']; ?></h3><a title="<?php echo $slider_item['title']; ?>" href="<?php echo $slider_item['link_url']; ?>">
            <?php echo $slider_item['description']; ?></a><br />
            <p style="text-align: right"><a title="<?php echo $slider_item['title']; ?>" href="<?php echo $slider_item['link_url']; ?>"><?php echo (!empty($slider_item['readmore_text']) ? $slider_item['readmore_text'] : __($slidernews['default_readmore'], SLIDERNEWS_TEXTDOMAIN)); ?></a></p>
            </div>    
          </li>
      <?php } ?>
  		</ul>
  	</div>
  </div> 
  <div class="button-next"><?php _e('Next', SLIDERNEWS_TEXTDOMAIN); ?></div>
  <div class="button-control"><span></span></div>
  <?php 
  } // check for slider items
  ?>
  </div> 
</div><!-- End of #container -->
<?php  

  if($in_return) {
    $slider_html = ob_get_clean();
    //ob_end_clean();
    return $slider_html;
    }
}

