<?php
$tlls="";
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $p = foo_post();

    $echo = "";
    $info = "";
    
    $dias = get_post_meta( get_the_ID(), 'dias_semana');
    $fecha_inicio = get_post_meta( get_the_ID(), 'fecha_inicio');
    $fecha_final = get_post_meta( get_the_ID(), 'fecha_final');

    if(count($dias[0])==2) $sep = " y ";
    else $sep = ", ";
    if(count($dias[0])>0)
    $dias = implode($sep,$dias[0]);
    
    $fechas = " del ".date_i18n('d \d\e F', strtotime($fecha_inicio[0]));
    $fechas .= " al ".date_i18n('d \d\e F',strtotime($fecha_final[0]));
    $fechas .= ' del '.date_i18n('Y',strtotime($fecha_inicio[0]));

    $info .= $dias;
    $info .= $fechas;
    
    $echo .= foo_div("","titulo",foo_h($p['ttl'],4));
    $echo .= foo_curtain(
      foo_div("","imagen", foo_img( foo_thumb( $p['img'], 500, 300 ) ) ),
      foo_vcenter(
        foo_div("","texto",
                foo_div("","info", $info )
                       . foo_div("","extracto", $p['ext'] )
                )
      )
    );
    
    $echo = foo_li("","taller post large-6 columns", $echo, $p['url'] );
    
    $tlls .= $echo;

  }
  echo foo_h("Talleres",1);
  echo foo_div("talleres","posts sidebar large-12 columns",$tlls);
}

//$posts = foo_ul("","large-block-grid-2",$posts);


?>