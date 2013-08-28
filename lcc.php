<?php
/* Template Name: LCC */

$args = array(
  'post_type'=>'lcc',
  'post_parent'=>0
);

$query = new WP_Query($args);
$topicos = foo_h("Tópicos",3);
while($query->have_posts()){
  if($query->have_posts()){
    $query->the_post();
    $p = foo_post();
    $echo = "";
    $echo .= foo_div("","titulo",foo_h( $p['ttl'], 4 ) );
    $echo .= foo_curtain(
      foo_div("","imagen", foo_img( foo_thumb( $p['img'], 300, 200 ) ) ),
      foo_vcenter( foo_div("","extracto",$p['ext'] ) )
    );
    $echo = foo_div("","topico",$echo,$p['url']);
    
    $topicos .= $echo;
    
  }

}

/* wp_reset_query(); */


while(have_posts()){
  if(have_posts()){
    the_post();

    $p = foo_post();
    $echo = "";
    $contenido = foo_div("","titulo large-12 columns row",foo_h( $p['ttl'], 1 ));
    $contenido .= foo_div("","contenido large-8 columns",$p['cnt']);
    $contenido .= foo_div("","topicos sidebar large-4 columns",$topicos);
    $contenido = foo_div("","post", $contenido );
    $echo .= foo_div("fondo_post","",foo_curtain( foo_img( $p['img'] ), $contenido ) );
    $echo = foo_div("","single row",$echo);

    echo $echo;    

  }

}



?>