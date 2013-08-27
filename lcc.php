<?php
/* Template Name: LCC */

$args = array(
  'post_type'=>'lcc',
  'post_parent'=>0
);

$query = new WP_Query($args);

while($query->have_posts()){
  if($query->have_posts()){
    $query->the_post();
    $foo = foo_post();
    $echo = "";
    $echo .= foo_div("","titulo",$foo['ttl']);
    $echo .= foo_div("","imagen", foo_img( $foo['img'] ) );
    $echo .= foo_div("","extracto",$foo['ext']);
    $echo = foo_div("","topico",$echo,$foo['url']);
    echo $echo;    
  }

}



?>