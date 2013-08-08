<?php
/*
Template Name: Inicio
*/

get_header();


for($h = 0; $h < 3; $h++) {
  $sublis = "";
  for($i = 0; $i < 3; $i++) {
    $sublis .= foo_li("","","subli".$h.$i );
  }
  $li = foo_li("","","li".$h.foo_ul("","",$sublis), "...");
  $lis .= $li;
}

/* echo foo_ul("menu","", foo_li("","","TIM". foo_ul("","",$lis) ) ); */
echo foo_ul( "menu", "", $lis );
echo foo_div("menu_titulo","",foo_link( "TIM", site_url() ) );

get_footer();
?>