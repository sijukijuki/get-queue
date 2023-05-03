<?php

/*
Sample data fo plugin demo - Fitness-Hall(pink) slider 'fitness_hall_pink' 
@package SliderNews
@link http://pshentsoff.ru/wp-plugins/slidernews Plugin homepage
@since 0.4	
@author Vadim Pshentsov <pshentsoff@yandex.ru> 
@link http://pshentsoff.ru/ Author homepage
Wordpress version supported: 3.0 and above
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

  $time = time();
  
  $res = $wpdb->insert($table, array(
      'created' => $time, 
      'changed' => $time, 
      'name' => 'fitness-hall-pink', 
      'width' => $slidernews['default_width'], 
      'height' => $slidernews['default_height'],
      'css_file' => 'fitness-hall-pink.css',
      ), array('%d','%d','%s','%d','%d','%s'));
    
  $sample_id = $wpdb->insert_id;
  $order_tag = 0;
  $img_path = slidernews_plugin_url('sample/anim-pink/');

  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'00.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'00m.jpg',
      'thumb_alt' => '',

      'title' =>  'Nunc cursus, est ut',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Suspendisse molestie, leo vitae aliquam gravida, mauris dolor elit',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'01.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'01m.jpg',
      'thumb_alt' => '',

      'title' =>  'Praesent aliquam',
      'link_url' => '',
      'readmore_text' =>$slidernews['default_readmore'],
      'description' => 'Praesent aliquam elementum lacus, nec auctor nulla consectetur quis',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'02.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'02m.jpg',
      'thumb_alt' => '',

      'title' =>  'Nunc cursus, est ut',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Suspendisse molestie, leo vitae aliquam gravida, mauris dolor elit',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'03.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'03m.jpg',
      'thumb_alt' => '',

      'title' =>  'Nullam pulvinar',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Nullam pulvinar, orci ut interdum dictum, ante tortor faucibus leo',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'04.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'04m.jpg',
      'thumb_alt' => '',

      'title' =>  'Lorem ipsum dolor',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Lorem ipsum dolor sit amet consectetuer malesuada venenatis elit',
      ));
 $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'05.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'05m.jpg',
      'thumb_alt' => '',

      'title' =>  'Praesent aliquam',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Praesent aliquam elementum lacus, nec auctor nulla consectetur quis',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'06.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'06m.jpg',
      'thumb_alt' => '',

      'title' =>  'Nunc cursus, est ut',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Suspendisse molestie, leo vitae aliquam gravida, mauris dolor elit',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'07.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'07m.jpg',
      'thumb_alt' => '',

      'title' =>  'Nullam pulvinar',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Nullam pulvinar, orci ut interdum dictum, ante tortor faucibus leo',
      ));
  $res = $wpdb->insert($items_table, array(
			'slidernews_id' => $sample_id,
      'order_tag' =>  $order_tag++,

			'image_file' => $img_path.'08.jpg',
      'image_alt' => '',
      'thumb_file' => $img_path.'08m.jpg',
      'thumb_alt' => '',

      'title' =>  'Lorem ipsum dolor',
      'link_url' => '',
      'readmore_text' => $slidernews['default_readmore'],
      'description' => 'Lorem ipsum dolor sit amet consectetuer malesuada venenatis elit',
      ));
