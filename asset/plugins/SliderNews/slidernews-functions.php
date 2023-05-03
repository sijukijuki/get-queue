<?php
/*
@package SliderNews
Plugin functions
@link http://blog.pshentsoff.ru/wp-plugins/slidernews Plugin's homepage
@author: Vadim Pshentsov <pshentsoff@yandex.ru> 
@link http://blog.pshentsoff.ru/ Author's homepage
Wordpress version supported: 3.4 and above
*/  


/*  Copyright 2012  Vadim Pshentsov  (email : pshentsoff@yandex.ru)

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

function get_slidernews_prefix() {
  global $wpdb, $slidernews;
  return ($slidernews['multisite'] ? $wpdb->table_prefix : $wpdb->base_prefix);
}

function get_slidernews_sliders() {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  
  //DEBUG:
  #global $psdebug;
  #$psdebug->log2file($wpdb->base_prefix);
  
  $sliders = $wpdb->get_results(
    "SELECT * 
    FROM $table 
    ORDER BY id
    ", ARRAY_A);

  return $sliders;
}
  
function get_slidernews_settings($slidernews_id) {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  $slider_settings = $wpdb->get_results($wpdb->prepare(
    "SELECT * 
    FROM $table 
    WHERE id = %d
    ", array(
      $slidernews_id,
      )), ARRAY_A);

  return array_shift($slider_settings);
}

function get_slidernews_carousel_items($slider_id) {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE; 
  $items = $wpdb->get_results($wpdb->prepare(
    "SELECT * 
    FROM $table 
    WHERE slidernews_id = %d 
    ORDER BY order_tag
    ", array(
      $slider_id,
      )), ARRAY_A);
  
  return $items;
}

/**
 * Function process esc_html and esc_js on input variable. Also it truncate to given
 * length if need
 * @param $var - escaped variable (string)
 * @param $maxlength - optional. Truncate from left to this length if > 0, omit if 0, FALSE or NULL
 * @return - escaped variable
 **/     
function slidernews_esc($var, $maxlength = 0) {

  $result = esc_html(esc_js($var));
  
  if($maxlength) $result = mb_substr($result, 0, $maxlength);
  
  return $result;
}

/**
 * Function check url for accepted protocol
 * @param $url - url to check
 * @return escaped url
 **/  
function slidernews_esc_url($url) {
  return esc_url($url, array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'feed'));
} 

function slidernews_issetor(&$var, $default = NULL) {
  return isset($var) ? $var : $default;
}

function slidernews_carousel_item_save($item_id, $item, $checked = FALSE) {

  //Copy only keys for table fields
  $item_val = array(
    'title' => slidernews_issetor($item['title'], ''),
    'description' => slidernews_issetor($item['description'], ''), 
    'readmore_text' => slidernews_issetor($item['readmore_text'], ''), 
    'link_url' => slidernews_issetor($item['link_url'], ''),
    'thumb_file' => slidernews_issetor($item['thumb_file'], ''),
    'thumb_alt' => slidernews_issetor($item['thumb_alt'], ''),
    'image_file' => slidernews_issetor($item['image_file'], ''),
    'image_alt' => slidernews_issetor($item['image_alt'], ''),
    'order_tag' => slidernews_issetor($item['order_tag'], 0),
    );
    
  //Escapes if not already checked
  if(!$checked) {
  
    $item_val['title'] = slidernews_esc($item_val['title'], SLIDERNEWS_ITEM_TITLE_LENGTH);
    $item_val['description'] = slidernews_esc($item_val['description'], SLIDERNEWS_ITEM_DESCRIPTION_LENGTH); 
    $item_val['readmore_text'] = slidernews_esc($item_val['readmore_text'], SLIDERNEWS_ITEM_READMORE_LENGTH); 
    $item_val['link_url'] = slidernews_esc_url($item_val['link_url'], SLIDERNEWS_ITEM_LINKURL_LENGTH);
    $item_val['thumb_file'] = esc_url(slidernews_esc($item_val['thumb_file'], SLIDERNEWS_ITEM_THUMBFILE_LENGTH), array('http'));
    $item_val['thumb_alt'] = slidernews_esc($item_val['thumb_alt'], SLIDERNEWS_ITEM_THUMBALT_LENGTH);
    $item_val['image_file'] = esc_url(slidernews_esc($item_val['image_file'], SLIDERNEWS_ITEM_IMAGEFILE_LENGTH), array('http'));
    $item_val['image_alt'] = slidernews_esc($item_val['image_alt'], SLIDERNEWS_ITEM_IMAGEALT_LENGTH);
    
    if(!is_numeric($item_val['order_tag'])) $item_val['order_tag'] = 0;
    if($item_val['order_tag'] < SLIDERNEWS_ITEM_ORDERTAG_MIN) $item_val['order_tag'] = SLIDERNEWS_ITEM_ORDERTAG_MIN;
    if($item_val['order_tag'] > SLIDERNEWS_ITEM_ORDERTAG_MAX) $item_val['order_tag'] = SLIDERNEWS_ITEM_ORDERTAG_MAX;
    }

  //if no key in then not update field
  foreach($item_val as $key => $val) {
    if(!isset($item[$key])) unset($item_val[$key]);
    }
    
  //Save
  global $wpdb, $table_prefix;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  $succ = ($wpdb->update($items_table, $item_val, array('id' => $item_id)) == 1);  
  
  //Slider data changed
  if($succ) {
    $slider_id = $wpdb->get_var($wpdb->prepare(
      "SELECT slidernews_id 
      FROM $items_table 
      WHERE id = %d
      LIMIT 1 
      ", array($item_id)));
    $wpdb->update(get_slidernews_prefix().SLIDERNEWS_TABLE, array('changed' => time()), array('id' => $slider_id));
    }
  
  return $succ;
}

function slidernews_carousel_item_add($slider_id) {

  global $wpdb, $table_prefix, $slidernews;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  $new_title = 'New item';
  
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $slider_id,
      'title' =>  $new_title,
      'readmore_text' => $slidernews['default_readmore'],
      ));
  $new_id = $wpdb->insert_id;
  $new_title .= ' '.$new_id;
  
  $wpdb->update($items_table, 
    array('title' => $new_title), 
    array('id' => $new_id),
    array('%s'),
    array('%d')
    );   
  
  return $new_id;    
}

function slidernews_carousel_item_delete($item_id) {
  global $wpdb, $table_prefix;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  $res = $wpdb->query($wpdb->prepare(
    "DELETE FROM $items_table WHERE id = %d", array($item_id), array('%d')));
  return $res;
}

function get_slidernews_carousel_items_count($slider_id) {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE; 
  $items_count = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) 
    FROM $table 
    WHERE slidernews_id = %d 
    ", array(
      $slider_id,
      )));
  
  return $items_count;
}

function get_slidernews_carousel_item($item_id) {
  global $wpdb, $table_prefix;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  $item = $wpdb->get_results($wpdb->prepare(
    "SELECT * 
    FROM $items_table 
    WHERE id = %d
    ", array(
      $item_id,
      )), ARRAY_A);

  return array_shift($item);
}

function get_slidernews_id($slider_name) {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE; 
  $slider_id = $wpdb->get_var($wpdb->prepare(
    "SELECT id 
    FROM $table 
    WHERE name = %s
    LIMIT 1 
    ", array(
      $slider_name
      )));
  return $slider_id;
}

function slidernews_message($message) {
    echo 'SliderNews: ';
    _e($message, SLIDERNEWS_TEXTDOMAIN);
}

function slidernews_plugin_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}

function slidernews_new_slider() {
  global $wpdb, $table_prefix, $slidernews;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  
  $time = time();
  $new_name = 'new slider';
  
  $res = $wpdb->insert($table, array(
      'created' => $time, 
      'changed' => $time, 
      'name' => $new_name, 
      'width' => $slidernews['default_width'], 
      'height' => $slidernews['default_height'],
      ), array('%d','%d','%s','%d','%d'));
      
  $new_id = $wpdb->insert_id;
  $new_name .= ' '.$new_id;
  
  $wpdb->update($table, 
    array('name' => $new_name), 
    array('id' => $new_id),
    array('%s'),
    array('%d')
    );   
  
  return $new_name;  
    
}

function slidernews_delete_slider($slider_id) {
  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  
  //Delete slider
  $res = $wpdb->query($wpdb->prepare(
    "DELETE FROM $table WHERE id = %d", array($slider_id), array('%d')));
  //Delete slider items
  $res = $wpdb->query($wpdb->prepare(
    "DELETE FROM $items_table WHERE slidernews_id = %d", array($slider_id), array('%d')));
}

function slidernews_save_slider_settings($slider_id, $settings, $format = NULL) {

  global $wpdb, $table_prefix;
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  $settings['changed'] = time();
  $res = $wpdb->update($table, $settings, array('id' => $slider_id), $format, array('%d'));
  return ($res > 0);
}

function slidernews_dirfiles( $path = '.', $mask = '*', $nocache = FALSE ){
 
  static $dir = array(); // cache result in memory
  
  if ( !isset($dir[$path]) || $nocache) { 
    $dir[$path] = scandir($path); 
    }
  
  foreach ($dir[$path] as $i=>$entry) { 
    if ($entry!='.' && $entry!='..' && fnmatch($mask, $entry) ) { 
      $sdir[] = $entry; 
      } 
    }
   
  return ($sdir); 
}

function slidernews_copy_slider($slider_id) {

  //Get copied slider settings
  $slider_settings = get_slidernews_settings($slider_id);
  if(empty($slider_settings)) return FALSE;
  
  global $wpdb, $table_prefix;
  
  $table = get_slidernews_prefix().SLIDERNEWS_TABLE;
  $items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;
  
  //Prepare copied data
  $slider_settings['id'] = NULL;
  $i = 1;
  do {
    $copy_name = $slider_settings['name'].' copy '.$i++;
    } while(get_slidernews_id($copy_name));
  $slider_settings['name'] = $copy_name; 
  //Copy slider settings into new slider  
  if(!$wpdb->insert($table, $slider_settings)) return FALSE;
  $new_id = $wpdb->insert_id;
  
  //Get copied slider items  
  $slider_items = get_slidernews_carousel_items($slider_id);
  //Prepare and save
  foreach($slider_items as $item) {
  
    $item['id'] = NULL;
    $item['slidernews_id'] = $new_id;
    
    $wpdb->insert($items_table, $item);
    
    }
    
  return TRUE;
}