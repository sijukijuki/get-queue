<?php

/*
@package SliderNews
Plugin constant settings
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

define('SLIDERNEWS_CSS_DIR', WP_PLUGIN_DIR.'/'.SLIDERNEWS_PLUGIN_DIR.'css/' );
define('SLIDERNEWS_JS_DIR', WP_PLUGIN_DIR.'/'.SLIDERNEWS_PLUGIN_DIR.'js/' );

// Create Text Domain For Translations
define('SLIDERNEWS_OPTIONS', 'slidernews_options');
define('SLIDERNEWS_TEXTDOMAIN', 'slidernews'); 
load_plugin_textdomain(SLIDERNEWS_TEXTDOMAIN,false,SLIDERNEWS_PLUGIN_DIR.'languages/');

define('SLIDERNEWS_TABLE', 'slidernews');
define('SLIDERNEWS_ITEMS_TABLE', 'slidernews_items');
define('SLIDERNEWS_NAME_MAXLENGTH', 128);
define('SLIDERNEWS_CSSFILE_LENGTH', 256);
define('SLIDERNEWS_CSSFILE_DEFAULT', 'fitness-hall-red.css');

define('SLIDERNEWS_ITEM_TITLE_LENGTH', 25);
define('SLIDERNEWS_ITEM_DESCRIPTION_LENGTH', 66);
define('SLIDERNEWS_ITEM_LINKURL_LENGTH', 256);
define('SLIDERNEWS_ITEM_THUMBFILE_LENGTH', 256);
define('SLIDERNEWS_ITEM_THUMBALT_LENGTH', 256);
define('SLIDERNEWS_ITEM_IMAGEFILE_LENGTH', 256);
define('SLIDERNEWS_ITEM_IMAGEALT_LENGTH', 256);
define('SLIDERNEWS_ITEM_READMORE_LENGTH', 30);
define('SLIDERNEWS_ITEM_ORDERTAG_MIN', -99);
define('SLIDERNEWS_ITEM_ORDERTAG_MAX', 99);