<?php

$posts = "";
$claseS = "proyecto_tim";
$clasePl = "proyectos";
$titulo = "Proyectos";

$args = array( 'post_type'=>$claseS );

$q = new WP_Query($args);

if( $q->have_posts() ) {
    while( $q->have_posts() ) {
        $q->the_post();
        $p = foo_post();

        $echo = "";
        $info = "";

        $echo .= foo_div("","titulo",foo_h($p['ttl'],4));
        $echo .= foo_div("","imagen", foo_img( foo_thumb( $p['img'], 500, 300 ) ) );
        
        $echo = foo_li("", $claseS . " post large-6 columns", $echo, $p['url'] );
        
        $posts .= $echo;

    }
    echo $posts;
    $echo = foo_h($titulo,1);
//    $echo .= foo_div($clasePl,"posts sidebar large-12 columns",$posts);

}


echo $echo;


?>