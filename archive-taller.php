<?php

while( have_posts() ) {

  if( have_posts() ) {
    the_post();
    $foo = foo_post();
    $echo = "";
    $meta = $foo['meta'];
    $dias = get_post_meta( get_the_ID(), 'dias_semana');
    $fecha_inicio = get_post_meta( get_the_ID(), 'fecha_inicio');
    $fecha_final = get_post_meta( get_the_ID(), 'fecha_final');

    if(count($dias[0])==2) $sep = " y ";
    else $sep = ", ";
    $dias = implode($sep,$dias[0]);
    
    $fechas = " del ".date_i18n('d \d\e F', strtotime($fecha_inicio[0]));
    $fechas .= " al ".date_i18n('d \d\e F',strtotime($fecha_final[0]));
    $fechas .= ' del '.date('Y',strtotime($fecha_inicio[0]));

    $info .= $dias;
    $info .= $fechas;
    
    $echo .= foo_div("","titulo",$foo['ttl']);
    $echo .= foo_div("","imagen", foo_img( $foo['img'] ) );
    $echo .= foo_div("","info", $info );
    $echo .= foo_div("","extracto", $foo['ext'] );
    $echo = foo_div("","taller", $echo, $foo['url'] );

    echo $echo; 
  }

}


?>