<?php

$posts = "";
$claseS = "miembro";
$clasePl = "miembros";
$titulo = "Miembros";

$args = array( 'post_type'=>$claseS );

$q = new WP_Query($args);

if( $q->have_posts() ) {
    while( $q->have_posts() ) {
        $q->the_post();
        $p = foo_post();

        $slug = $post->post_name;

        $post = "";
        $info = "";


        $post .= foo_div("","imagen", foo_img( foo_thumb( $p['img'], 500, 300 ) ) );

        $post .= foo_div("","title",foo_h($p['ttl'],4));
        
        $post = foo_div("", $claseS . " post large-4 columns", $post, $p['url'] );
        
        $posts .= $post;

    }
  

}



    $echo = foo_h($titulo,1);
  
    $echo .= foo_div ( "", "row posts_holder", $posts );

$echo = foo_div($clasePl,"posts sidebar large-12 columns",$echo );


echo $echo;


?>