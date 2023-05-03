<?php

/*
Sample data fo plugin demo 
@package SliderNews
@link http://pshentsoff.ru/wp-plugins/slidernews Plugin homepage
@since 0.1.3	
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

/**
  * Sample data
  */
//If included inside function  
global $wpdb, $table_prefix, $slidernews;

$table = get_slidernews_prefix().SLIDERNEWS_TABLE;
$items_table = get_slidernews_prefix().SLIDERNEWS_ITEMS_TABLE;

if($slidernews[$table]['new'] && $slidernews[$items_table]['new']) {
  
  //@todo get all inserts by mask 'insert_*.inc' from directory and include'em
  include('insert_fitness_hall.inc');
  include('insert_fitness_hall_red.inc');
  include('insert_fitness_hall_pink.inc');
  
  }

