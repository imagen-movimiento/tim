<?php

require("footilities/funcionesHTML.php");
require("backend/cpt.php");
require("backend/metaboxes.php");
require("backend/radio-taxonomies/Radio-Buttons-for-Taxonomies.php");

/*
function cargar_link()
{  
 global $post;
 $link = $_POST['link'];
 die( $lis );

}

add_action( 'wp_ajax_nopriv_cargar_link_menu', 'cargar_link_menu' );  
add_action( 'wp_ajax_cargar_link_menu', 'cargar_link_menu' );  

*/

remove_filter('get_the_excerpt','foundation_excerpt');
function foo_excerpt( $text ) {
  return apply_filters( 'the_excerpt', wp_trim_words( $text, 35 ) );
  
}
add_filter( 'get_the_excerpt', 'foo_excerpt', 999 );






add_filter('init', 'add_query_vars');
function add_query_vars() {
  global $wp;
  $wp->add_query_var('parent');
  $wp->add_query_var('parent_term');
}


?>