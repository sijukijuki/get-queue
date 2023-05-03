<?php

/*
@package SliderNews
Plugin admin console pages
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

// Hook for adding admin menus
if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'slidernews_settings');
  //add_action( 'admin_init', 'register_mysettings' );
  
  //upload 
  if (isset($_GET['page']) && $_GET['page'] == 'slidernews-admin') {
    add_action('admin_init', 'slidernews_admin_scripts');
    add_action('admin_init', 'slidernews_admin_styles');
    }
  } 

// function for adding settings page to wp-admin
function slidernews_settings() {
	add_menu_page( 
    'SliderNews', 
    'SliderNews', 
    'manage_options',
    'slidernews-admin', 
    'slidernews_edit_sliders_page' 
    );
	add_submenu_page(
    'slidernews-admin', 
    'SlidersNews', 
    'Sliders', 
    'manage_options', 
    'slidernews-admin', 
    'slidernews_edit_sliders_page'
    );
  /**
	add_submenu_page(
    'slidernews-admin', 
    'SliderNews Settings', 
    'Settings', 
    'manage_options', 
    'slidernews-settings', 
    'slidernews_settings_page'
    );
    **/
}

//Include Media Uploader
function slidernews_admin_scripts() {
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_register_script('slidernews-upload', slidernews_plugin_url('js/upload.js'), array('jquery','media-upload','thickbox'));
  wp_enqueue_script('slidernews-upload');
}
 
function slidernews_admin_styles() {
  wp_enqueue_style('thickbox');
}


function slidernews_settings_page() {
  global $slidernews;
?>  
<div class="wrap">
<h2 style="float:left;"><?php _e('Slidernews Settings',SLIDERNEWS_TEXTDOMAIN); ?></h2>
</div>
<?php  
}

function slidernews_edit_sliders_page() {

  global $slidernews;
  
  $items_action = (isset($_POST['submit_items_action']) && isset($_POST['items_action'])) ? $_POST['items_action'] : FALSE;
  if($items_action) {
    slidernews_edit_slider_items($_POST['slidernews_id'], $items_action);
    return;
    }
  
  if(isset($_POST['save_items'])) {
    $saved_counter = 0;
    
    foreach($_POST['items'] as $item_id => $item) {
    
      $saved_counter += (slidernews_carousel_item_save($item_id, $item) ? 1 : 0);
      
      }
    ?><div class="updated"><p><strong>
      <?php printf(__('Success. %d items saved.', SLIDERNEWS_TEXTDOMAIN), $saved_counter); ?> 
      </strong></p></div><?php
    }
    
  $action = (isset($_POST['submit_action']) && isset($_POST['action'])) ? $_POST['action'] : FALSE;
  
  if($action) {

    //Add new slider
    if($action == 'new') {
      $new_name = slidernews_new_slider();
      ?><div class="updated"><p><strong>
        <?php printf(__('Created new empty slider. All settings are set to default. New slider name - "%s". You can change it later by editing slider settings.', SLIDERNEWS_TEXTDOMAIN), $new_name); ?> 
        </strong></p></div><?php

      // Edit selected slider (or first from selection)
      } elseif($action == 'edit_settings') {
      if(isset($_POST['selected_sliders'])  
        && is_array($_POST['selected_sliders'])
        && !empty($_POST['selected_sliders'])) {
        $slider_id = array_shift($_POST['selected_sliders']);
        slidernews_edit_slider_settings($slider_id);
        return;
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('No slider selected. Please select slider to edit.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }
        
      // Copy selected slider(s)
      } elseif($action == 'copy_settings') {
      if(isset($_POST['selected_sliders'])  
        && is_array($_POST['selected_sliders'])
        && !empty($_POST['selected_sliders'])) {
        $copy_counter = 0;
        foreach($_POST['selected_sliders'] as $slider_id) {
          if(slidernews_copy_slider($slider_id)) 
            $copy_counter++;
          }
        if($copy_counter > 0) {
          ?><div class="updated"><p><strong>
            <?php printf(__('%d slider(s) copied.', SLIDERNEWS_TEXTDOMAIN), $copy_counter); ?>
            </strong></p></div><?php
          }
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('No slider(s) selected. Please select slider(s) to copy.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }

      //Save slider settings
      } elseif($action == 'save_settings') {
      if(slidernews_save_slider_settings($_POST['id'], $_POST['slider_settings'])) {
        ?><div class="updated"><p><strong>
          <?php _e('Slider settings saved.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('Slider settings NOT saved.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }

      //Edit slider items
      } elseif($action == 'edit_items') {
      if(isset($_POST['selected_sliders']) 
        && is_array($_POST['selected_sliders'])
        && !empty($_POST['selected_sliders'])) {
        $slider_id = array_shift($_POST['selected_sliders']);
        slidernews_edit_slider_items($slider_id);
        return;
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('No slider selected. Please select slider to edit items.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }
        
      //Delete selected sliders
      } elseif($action == 'delete') {
      if(isset($_POST['selected_sliders']) 
        && is_array($_POST['selected_sliders'])
        && !empty($_POST['selected_sliders'])) {
        //TODO: confirm before delete
        foreach($_POST['selected_sliders'] as $slider_id) {
          slidernews_delete_slider($slider_id);
          }
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('No slider selected. Please select slider to delete.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }
      }
    }
    
// Main sliders form:
?>
<div class="wrap">
<h2><?php _e('Sliders',SLIDERNEWS_TEXTDOMAIN); ?></h2>
<form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
<?php function _slidernews_edit_sliders_page_actions() { ?>
<div class="tablenav top">
  <div class="alignleft actions">
    <select name="action" style="min-width:200px;">
      <option value="refresh"><?php _e('Refresh page', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="new"><?php _e('Create new slider', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="copy_settings"><?php _e('Copy selected slider(s)', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="edit_settings"><?php _e('Edit slider settings', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="edit_items"><?php _e('Edit slider items', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="delete"><?php _e('Delete selected slider(s)', SLIDERNEWS_TEXTDOMAIN); ?></option>
      </select>
    <input type="submit" name="submit_action" value="Go" class="button-secondary action" />
    </div>
  </div>
<?php
  }
#_slidernews_edit_sliders_page_actions();

$sliders = get_slidernews_sliders();
if($sliders) {
  ?>
  <table class="widefat">
    <tr valign="middle" align="center">
    <th align="center" width="15px">&nbsp;</th>
    <th align="right" width="150px"><?php _e('Name', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <th align="right" width="200px"><?php _e('Dates', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <th align="right" width="150px"><?php _e('CSS file', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <th align="right" width="30px"><?php _e('Size', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <th align="right" width="30px"><?php _e('Items', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <th>&nbsp;</th>
    </tr>
  <?php
  foreach($sliders as $slider) {
    $items_count = get_slidernews_carousel_items_count($slider['id']);
  ?>

    <tr valign="top">
    <td align="center"><input type="checkbox" name="selected_sliders[]" value="<?php echo $slider['id']; ?>"/></td>
    <td align="right"><strong><?php echo $slider['name']; ?></strong></td> 
    <td align="right"><?php _e('Created', SLIDERNEWS_TEXTDOMAIN); ?>: <?php echo date('d/m/y H:i:s', $slider['created']); ?><br /> 
      <?php _e('Changed', SLIDERNEWS_TEXTDOMAIN); ?>: <?php echo date('d/m/y H:i:s', $slider['changed']); ?></td>
    <td align="right"><?php echo $slider['css_file']; ?></td> 
    <td align="right"><?php echo $slider['width']; ?>&nbsp;x&nbsp;<?php echo $slider['height']; ?></td> 
    <td align="right"><?php echo $items_count; ?></td>
    <td>&nbsp;</td> 
    </tr>
  <?php
    }
  ?>
  </table>
  <?php
  _slidernews_edit_sliders_page_actions();
  } else {
  ?>
  <h2><?php _e('No sliders',SLIDERNEWS_TEXTDOMAIN); ?></h2>
  <?php
  }
?>

</form>
</div>
<?php
  
}

function slidernews_edit_slider_settings($slider_id) {

  $slider_settings = get_slidernews_settings($slider_id);
  
?>
<div class="wrap">
<h2><?php _e('Edit slider settings',SLIDERNEWS_TEXTDOMAIN); ?></h2>
<form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
<input type="hidden" name="id" value="<?php echo $slider_id; ?>" />
<table class="form-table">
  <tr>
    <th scope="row"><?php _e('Slider name', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <td><input type="text" name="slider_settings[name]" value="<?php echo esc_attr($slider_settings['name']); ?>" 
      maxlength="<?php echo SLIDERNEWS_NAME_MAXLENGTH; ?>">
      <p class="description">
      	<?php printf(__('Machine-readable name for slider. Use this name to call slider from template. %d symbols length maximum.',SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_NAME_MAXLENGTH);?>
        </p>
      </td>
    </tr>
  <tr>
    <th scope="row"><?php _e('Slider created', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <td><?php echo date('d/m/Y H:i:s', $slider_settings['created']); ?></td>
    </tr>
  <tr>
    <th scope="row"><?php _e('Last changed', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <td><?php echo date('d/m/Y H:i:s', $slider_settings['changed']); ?></td>
    </tr>
  <tr>
    <th scope="row"><?php _e('Slider CSS file', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <td><select name="slider_settings[css_file]" style="min-width:150px;">
      <?php
        $css_files = slidernews_dirfiles(plugin_dir_path(__FILE__).'/css/.', '*.css', TRUE);
        foreach($css_files as $css_file) {
          $selected = ($slider_settings['css_file'] === $css_file) ? 'selected' : '';
          echo "<option value=\"$css_file\" $selected>$css_file</option>";
          }
      ?>
      </select>
      </td>
    </tr>
  <tr>
    <th scope="row"><?php _e('Slider sizes', SLIDERNEWS_TEXTDOMAIN); ?></th>
    <td>
      <input type="text" name="slider_settings[width]" value="<?php echo esc_attr($slider_settings['width']); ?>" size="5">
      &nbsp;x&nbsp;
      <input type="text" name="slider_settings[height]" value="<?php echo esc_attr($slider_settings['height']); ?>" size="5">
      <p class="description">width x height</p>
      </td>
    </tr>
    <tr>
    <th colspan="2" align="left">
    <?php _e('Preview',SLIDERNEWS_TEXTDOMAIN); ?>
    </th>
    </tr>
    <tr>
    <td colspan="2" style="text-align: left;"> 
      <div style="text-align: left;"><?php get_slidernews($slider_settings['name']); ?> </div>
    </td>
    </tr>
  </table>
<input type="hidden" name="action" value="save_settings" />
<input type="submit" name="submit_action" value="<?php _e('Save settings', SLIDERNEWS_TEXTDOMAIN); ?>" class="button-primary" />
<input type="submit" name="cancel_action" value="<?php _e('Cancel', SLIDERNEWS_TEXTDOMAIN); ?>" class="button-secondary" />
</form>
</div>
<?php
}

function slidernews_edit_slider_items($slider_id, $items_action = FALSE) {

  global $slidernews;

  if($items_action) {
    //Add item
    if($items_action == 'add') {
      $item_id = slidernews_carousel_item_add($slider_id);
      $item = get_slidernews_carousel_item($item_id);
      ?><div class="updated"><p><strong>
        <?php printf(__('Created new empty slider item. Some settings are set to default. New item title - "%s".', SLIDERNEWS_TEXTDOMAIN), $item['title']); ?></em> 
        </strong></p></div><?php
      
      //Delete item
      } elseif($items_action == 'delete') {
      if(isset($_POST['selected_items'])  
        && is_array($_POST['selected_items'])
        && !empty($_POST['selected_items'])) {
        //@todo Confirm before delete
        foreach($_POST['selected_items'] as $item_id) {
          slidernews_carousel_item_delete($item_id);
          }
        } else {
        ?><div class="updated"><p><strong>
          <?php _e('No item(s) selected. Please select item(s) to delete.', SLIDERNEWS_TEXTDOMAIN); ?>
          </strong></p></div><?php
        }
      }
    }
    
  $slider_items = get_slidernews_carousel_items($slider_id);
  
?>
<div class="wrap">
<h2><?php _e('Edit slider items',SLIDERNEWS_TEXTDOMAIN); ?></h2>
<form method="post" action="<? echo $_SERVER['REQUEST_URI'];?>">
<input type="hidden" name="slidernews_id" value="<?php echo $slider_id; ?>" />

<?php function _slidernews_carousel_actions() { ?>
<div class="tablenav top">
  <div class="alignleft actions">
    <select name="items_action">
      <option value="refresh"><?php _e('Refresh', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="add"><?php _e('Add item', SLIDERNEWS_TEXTDOMAIN); ?></option>
      <option value="delete"><?php _e('Delete item(s)', SLIDERNEWS_TEXTDOMAIN); ?></option>
      </select>
    <input type="submit" name="submit_items_action" value="Go" class="button-secondary action" />
    </div>
  </div>
  <?php } ?>
<?php #_slidernews_carousel_actions(); ?>

<table class="widefat">
<?php
if(!empty($slider_items)) {
  foreach($slider_items as $item) {
    ?>
    <tr>
      <th scope="row">
        <input name="selected_items[]" value="<?php echo $item['id']; ?>" type="checkbox" /><br />
        </th>
      <td>
      <table class="widefat">
        <tr>
        <th scope="row">
          <?php _e('Order tag', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input name="items[<?php echo $item['id']; ?>][order_tag]" value="<?php echo esc_attr($item['order_tag']); ?>" maxlength="3" size="5" style="text-align: right;"/>
          <p class="description"><small>
            <?php printf(__('Order tag determine position of item in slider. Numeric value from %d to %d.', SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_ORDERTAG_MIN, SLIDERNEWS_ITEM_ORDERTAG_MAX); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">
          <?php _e('Title', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input name="items[<?php echo $item['id']; ?>][title]" value="<?php echo esc_attr($item['title']); ?>" maxlength="<?php echo SLIDERNEWS_ITEM_TITLE_LENGTH; ?>" size="70"/>
          <p class="description"><small>
            <?php printf(__('%d maximum symbols length.', SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_TITLE_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">
          <?php _e('Description', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input type="text" name="items[<?php echo $item['id']; ?>][description]" value="<?php echo esc_attr($item['description']); ?>" maxlength="<?php echo SLIDERNEWS_ITEM_DESCRIPTION_LENGTH; ?>" size="70"/>
          <p class="description"><small>
            <?php printf(__('%d maximum symbols length.', SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_DESCRIPTION_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">  
          <?php _e('Link URL', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input type="text" name="items[<?php echo $item['id']; ?>][link_url]" value="<?php echo esc_attr($item['link_url']); ?>"  size="70"/>
          <p class="description"><small>
            <?php printf(__('Item URL %d maximum symbols length.', SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_LINKURL_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">  
          <?php _e('Read more text', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input type="text" name="items[<?php echo $item['id']; ?>][readmore_text]" value="<?php echo esc_attr($item['readmore_text']); ?>"  size="70" maxlength="<?php echo SLIDERNEWS_ITEM_READMORE_LENGTH; ?>"/>
          <p class="description"><small>
            <?php printf(__("Text of link instead of default '%s'. %d maximum symbols length.", SLIDERNEWS_TEXTDOMAIN), $slidernews['default_readmore'], SLIDERNEWS_ITEM_READMORE_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">
          <?php _e('Thumb', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>  
          <td>
          <?php if($item['thumb_file']) { ?>
            <img id="item-thumb-<?php echo $item['id']; ?>" src="<?php echo esc_attr($item['thumb_file']); ?>" alt="<?php echo esc_attr($item['thumb_alt']); ?>" style="border:1px solid;">
            <?php } else { ?>
            <img id="item-thumb-<?php echo $item['id']; ?>" src="" alt="No thumb" style="border:1px solid;">
            <?php } ?>
          <br />
          <input type="text" name="items[<?php echo $item['id']; ?>][thumb_file]" value="<?php echo esc_attr($item['thumb_file']); ?>" size="50">
          &nbsp;<input type="button" value="<?php _e('Upload', SLIDERNEWS_TEXTDOMAIN); ?>" class="image-file-upload" name="item-thumb-<?php echo $item['id']; ?>">
          <p class="description"><small>
            <?php printf(__("Item thumb image URL. %d symbols length maximum.<br />You can use Media Uploader thickbox by clicking the upload button.", SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_THUMBFILE_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">
          <?php _e('Thumb alt', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input id="item-thumb-<?php echo $item['id']; ?>-alt" type="text" name="items[<?php echo $item['id']; ?>][thumb_alt]" value="<?php echo esc_attr($item['thumb_alt']); ?>"  size="70"/>
          <p class="description"><small>
            <?php printf(__("Alternative thumbnail text %d maximum symbols length.", SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_THUMBALT_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        </table>
      </td>
      <td>
        <table class="widefat">
        <tr>
          <th scope="row" rowspan="2">
          <?php _e('Image', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <?php if($item['image_file']) { ?>
            <img id="item-image-<?php echo $item['id']; ?>" src="<?php echo esc_attr($item['image_file']); ?>" alt="<?php echo esc_attr($item['image_alt']); ?>" style="border:1px solid;"><br />
            <?php } else { ?>
            <img id="item-image-<?php echo $item['id']; ?>" src="" alt="No image" style="border:1px solid;"><br />
            <?php } ?>
            </td>
          </tr>
        <tr>
        <td>
          <input class="image-file" name="items[<?php echo $item['id']; ?>][image_file]" value="<?php echo esc_attr($item['image_file']); ?>"  size="50"/>
          &nbsp;<input type="button" value="<?php _e('Upload', SLIDERNEWS_TEXTDOMAIN); ?>" class="image-file-upload" name="item-image-<?php echo $item['id']; ?>">
          <p class="description"><small>
            <?php printf(__("Item image URL. %d symbols length maximum.<br />You can use Media Uploader thickbox by clicking the upload button.", SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_IMAGEFILE_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        <tr>
        <th scope="row">
          <?php _e('Image alt', SLIDERNEWS_TEXTDOMAIN); ?>
          </th>
          <td>
          <input id="item-image-<?php echo $item['id']; ?>-alt" name="items[<?php echo $item['id']; ?>][image_alt]" value="<?php echo esc_attr($item['image_alt']); ?>"  size="70"/>
          <p class="description"><small>
            <?php printf(__("Alternative image text %d maximum symbols length.", SLIDERNEWS_TEXTDOMAIN), SLIDERNEWS_ITEM_IMAGEALT_LENGTH); ?>
            </small></p> 
          </td>
          </tr>
        </table>
      </td>
    </tr>
    <?php
    }
  } else {
  ?>
  <tr><td>
  <strong><em><?php _e('No items', SLIDERNEWS_TEXTDOMAIN); ?></em></strong>
  </td></tr>
  <?php
  }
?>
</table>
<?php _slidernews_carousel_actions(); ?>
<div class="tablenav top">
  <div class="alignleft actions">
    <input type="submit" name="save_items" value="<?php _e('Save settings', SLIDERNEWS_TEXTDOMAIN); ?>" class="button-primary action" />
    <input type="submit" name="cancel" value="<?php _e('Cancel', SLIDERNEWS_TEXTDOMAIN); ?>" class="button-secondary action" />
    </div>
  </div>
</form>
</div>
<?php
}