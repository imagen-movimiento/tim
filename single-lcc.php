<?php

while( have_posts() ) {
  if( have_posts() ) {
    the_post();
    $foo = foo_post();
    $echo = "";
    $echo .= foo_div("","titulo",$foo['ttl']);
    $echo .= foo_div("","imagen", foo_img( $foo['img'] ) );
    $echo .= foo_div("","contenido", $foo['cnt'] );
    $echo = foo_div("","lcc", $echo );
    echo $echo; 
  }

}


?>