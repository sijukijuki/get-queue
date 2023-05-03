=== SliderNews ===
Contributors: pshentsoff
Donate link: http://blog.pshentsoff.ru/donate/
Tags: slider, multi-slider, JQuery
Version: 0.4.3
Stable tag: 0.4.3
Requires at least: 3.0.1
Tested up to: 3.4.2
License: GPLv2 or later
License URI: http://opensource.org/licenses/gpl-2.0.php

Plugin for manage JQuery-based slider JSliderNews, from LoF (http://landofcoder.com)

== Description ==

With this plugin you can easy manage any count of sliders on your pages. It allow you make easy changes with showed images, thumbs, titles and descriptions of slider items.
ATTENTION: Due to using same not unique id attributes - more than one slider on one page does not work properly. In other words - one page can contain not more than one slider. 

== Installation ==

1. Upload plugin folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create new slider, add images, thumbs texts and links. Give it machine-readable
  name (e.g. 'slider_name')
4. Place `<?php get_slidernews('slider_name'); ?>` in your template file

== Screenshots ==

1. Create and manage any count of sliders.
2. Edit slider settings: name, sizes, assign css.
3. Manage items of slider: change count of items, assign images, thumbnails, 
  description, links & etc.
4. Add slidernews shortcode to widget area - place it wherever you need.
5. Sample slider view in result.
6. Other slider with another items and css on the same site.

== Changelog ==

= 0.4.3 =

- temporary fix bug with no styles included to output. At least default css will be enqueue (see value of constant SLIDERNEWS_CSSFILE_DEFAULT at slidernews-settings.php)

= 0.4.2 =

- bugfix: correct checking in multibyte encoding
- bugfix: correct print 'readmore_text' when set.

= 0.4.1 =

- function get_slidernews() now can retrun html out instead of direct out like print_r()
   - just set second parameter to true (default is false).
   Example: 
    <code>
      $slider_html = get_slidernews('my-slider-name', true); 
    </code>
- added shortcodes support. Now you can place text widget at any area or theme template
  with shortcode [slidernews name="my-slider-name"] to show slider. 
  Please NOTE: only one slider per page works good at this versions!

= 0.4-dev =

- new fields at sliders table: 
- varchar 'css_file' for select slidwer css file, and 
- 'css' text field - for dynamic correct style sheets (future purpose)
- assign css file from list on slider settings page 
- used css now depends from used slider and loaded dynamicaly
- make copy sliders on slider(s) page
- slider preview temporary moved to edit settings page
- multisite setting supports separate tables for multisite in future versions (default is false) 
- fixed option using to multisite option funcs

= 0.3.3 =

- Wordpress Media Uploader used for upload and manage images and thumbs of slider items
- you can change order of items in slideshow by changing order tag values of items - interface for this function now added

= 0.3.1-dev =

- readmore_text field added to items table. Now custom or default text for "Read more" link is available.

= 0.2.x-dev =

- date fileds changed to store UNIX timestamps (int)
- settings page for manage slider items

= 0.1.3-dev =

- insert sample slider data on plugin activation. The name is 'sample'.
- drop plugin tables on plugin deletion and on plugin deactivation in development versions 
- image and thumb alternative text fields added 

= 0.0.x-dev =

- common sliders settings options and default values
- settings page for common settings
- clean settings on deactivation
- table to store sliders settings
- table to store slider items data - such as images, thumbs, texts, links
