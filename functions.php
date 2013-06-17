<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/rewrites.php');        // URL rewriting for assets
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions


add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');



// function get_images( $postID, $size = 'thumbnail') {
  
// $postContent = get_post($postID)->post_content;
// $searchPattern = '~<img [^\>]*\ />~';

// preg_match_all( $searchPattern, $postContent, $photos );
  
//   $results = array();

//   if ($photos) {
//     foreach ($photos as $photo) {

//       // preg_match( '@src="([^"]+)"@' ,  , $src );

//       // get the correct image html for the selected size
//       $results[] = wp_get_attachment_image_src($photo->ID, $size);
//     }
//   }
//   return $results;
// }
function featImg( $size = 'full', $id = "" ){
  if($id != "")
    $img = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size);
  else
    $img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size);
  return $img[0];
}

function filter($title="",$filter="filter"){
  return apply_filters("the_".$filter,$title);
}

function themeDir() {
  return get_stylesheet_directory_uri();
}

function timThumb( $src, $w=200, $h=200, $zc=1, $q=100 ) {
  return get_stylesheet_directory_uri().'/assets/img/timthumb.php?src='.$src.'&w='.$w.'&h='.$h.'&zc='.$zc.'&q='.$q;
}
function get_images( $eventoID, $size = 'thumbnail') {
  

  $photos = get_children( array('post_parent' => $eventoID, 'post_status' => 'null', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC') );
  
  $results = array();

  if ($photos) {
    foreach ($photos as $photo) {
      // get the correct image html for the selected size
      $results[] = wp_get_attachment_image_src($photo->ID, $size);
    }
  }

  return $results;
}





function makeDiv($id="",$class="", $content="", $link=""){
  $str = '<div';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  
  $str .= '</div>';
  
  return $str;
}



function makeUl($id="",$class="", $content="", $link=""){
  $str = '<ul';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  $str .= '</ul>';
  
  return $str;
}
      


function makeLi($id="",$class="", $content="", $link=""){
  $str = '<li';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  $str .= '</li>';
  
  return $str;
}
      


function makeImg($src=""){
  if($src!="") {
      $str = '<img src="'.$src.'">';
  }

  return $str;
}

function startDiv($id="",$class=""){
  $str = '<div';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';
  
  return $str;
}



function closeDiv(){
  $str .= '</div>';
  
  return $str;
}


function makeTextDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= '<div class="text_table"><div class="text_container"><div class="vcenter_text '.$align.'">';
        $str .= $content;
      $str .= '</div></div></div>';
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}


function makeTitleDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_titulo",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}


function makeBannerDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_banner",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}

function makeScrollDiv($content){
  $str .= '<div class="scroll_hide"><div class="scroller">';
    $str .= $content;
  $str .= '</div></div>';
  
  return $str;
}


function makeLink($content="",$url="",$onclick=""){
  if($url=="") $url = "#";
  $str = "";
  $str = '<a href="'.$url.'"';


  if($onclick!="") {    
    $str .= ' onclick="'.$onclick.'"';
  }

  $str .= '>';

  $str .= $content;

  $str .= '</a>';

  return $str;

}













function debug( $str ) {

  return makeDiv("debug","shadow",$str);

}





function tst_post_type_archive_link( $post_type ) {
  global $wp_rewrite;
  if ( ! $post_type_obj = get_post_type_object( $post_type ) )
    return false;

  if ( ! $post_type_obj->has_archive )
    return false;

  if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) ) {
    $struct = ( true === $post_type_obj->has_archive ) ? $post_type_obj->rewrite['slug'] : $post_type_obj->has_archive;
    if ( $post_type_obj->rewrite['with_front'] )
      $struct = $wp_rewrite->front . $struct;
    else
      $struct = $wp_rewrite->root . $struct;
    $link = home_url( user_trailingslashit( $struct, 'post_type_archive' ) );
  } else {
    $link = home_url( '?post_type=' . $post_type );
  }

  return apply_filters( 'post_type_archive_link', $link, $post_type );
}




function load_posts(){

  if(isset($_POST['post_type'])) {
    $post_type = $_POST['post_type'];
  }
  if(isset($_POST['topico'])) {
    $topico = $_POST['topico'];
  }
  if(isset($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
  }

  $query = new WP_Query(
    array(  'post_type'=>$post_type,
            'tax_query' => array(
              //'relation' => 'AND',
              array(
                'taxonomy' => 'topico_lcc',
                'field' => 'slug',
                'terms' => array($topico),
                'operator' => 'IN'
              ),
              array(
                'taxonomy' => 'categoria_lcc',
                'field' => 'slug',
                'terms' => array( $categoria )
              )
            )

    )
  );

                          
while ($query->have_posts()) : $query->the_post();

  $postStr = '';

  $nombre = get_the_title();
  $extracto = apply_filters("the_excerpt",get_the_excerpt() );
  $slug = $post->post_name;
  $link = get_permalink($post->ID);

  $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );


  $postStr .= makeDiv("","titulo",makeLink( $nombre, $link ));
  $postStr .= makeDiv("","imagen",makeImg( timthumb($img[0],215,215) ) );
  $postStr .= makeDiv("","extracto",$extracto);
  
  $postStr = makeDiv("", "entrada referencia_lcc", $postStr);

  $posts .= $postStr;

endwhile;

  die( $posts ); 

}
add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');  