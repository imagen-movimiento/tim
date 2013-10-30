<?php
/*
Template Name: Talleres
 */

$post_type = 'taller';

$posts = "";
$claseS = "taller";
$clasePl = "talleres";
$titulo = "Talleres";

$ahora = date('m/d/Y');
$args = array( 
              'post_type'=>$post_type,
              'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'fecha_final',
            'value' => $ahora,
            'compare' => '>',
        )) );

$q = new WP_Query($args);
if( $q->have_posts() ) {
    while( $q->have_posts() ) {
        $q->the_post();
        
        echo $post->post_title . '<br/>';
        
    }
}

$q = new WP_Query( array( 'post_type' => 'taller', 'posts_per_page' => -1 ) );

if( $q->have_posts() ) {
    while( $q->have_posts() ) {
        $q->the_post();


        $p = foo_post();
        $echo = "";
        $info = "";
        
        //        $dias = get_post_meta( get_the_ID(), 'dias_semana');
        $horarios = get_post_meta( get_the_ID(), 'horarios');
        $lugar = get_post_meta( get_the_ID(), 'lugar');
        $fecha_inicio = get_post_meta( get_the_ID(), 'fecha_inicio');
        $fecha_final = get_post_meta( get_the_ID(), 'fecha_final');

        /* if(count($dias[0])==2) $sep = " y ";
        else $sep = ", ";
        if(count($dias[0])>0)
        $dias = implode($sep,$dias[0]); */

        /* $fechas = "Del <b>".date_i18n('d \d\e F', strtotime($fecha_inicio[0])).'</b>';
        $fechas .= " al <b>".date_i18n('d \d\e F',strtotime($fecha_final[0])).'</b>'; */

        $fechas = "Del <b>".date_i18n('d \d\e F', strtotime($fecha_inicio[0])).'</b>';
        $fechas .= " al <b>".date_i18n('d \d\e F',strtotime($fecha_final[0])).'</b>';
        $fechas .= " del ".date_i18n('Y',strtotime($fecha_final[0]));


        //      $info .= $dias;
        $info .= foo_div("","fechas",$fechas);
        $info .= foo_div("","horarios",$horarios[0]);
        $info .= foo_div("","lugar",$lugar[0]);

        $info = foo_div("","info", $info );
        
        $echo .= foo_div("","title",foo_h($p['ttl'],4));
        $echo .= foo_curtain(
            foo_div("","imagen", foo_img( foo_thumb( $p['img'], 500, 300 ) ) ),
            foo_vcenter(
                $info
                .
                foo_div("","texto",
                        foo_div("","extracto", $p['ext'] )
                        )
            )
        );
        
        $echo = foo_li("", $claseS . " post large-6 columns", $echo, $p['url'] );
        
        $posts .= $echo;

    }

    $echo = foo_h($titulo,1);
    $echo .= foo_div($clasePl,"posts row",$posts);
    echo $echo;

}

?>