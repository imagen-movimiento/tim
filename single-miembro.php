<?php
$post_type='miembro';

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        $p = foo_post();

        $titulo = $p['ttl'];
        $slug = $post->post_name;

        $echo = "";
        $postStr = "";
        $postSidebar = "";

        $img = foo_featImg('medium');
        $postStr .= foo_link( foo_img( $img ), $img );
        $postStr .= foo_div( "", "texto", $p['cnt']);
        $postStr = foo_div("","large-7 columns principal",$postStr);

        $echo .= $postStr;

	$meta_proyectos = get_post_meta( get_the_ID(), 'proyectos' );
	$meta_proyectos = $meta_proyectos[0];
   }

}
$args = array( 'post_type' => 'proyecto_tim',
      'post__in' => $meta_proyectos
);


$proyectos = "";

$q = new WP_Query($args);

if( $q->have_posts() ) {
    while( $q->have_posts() ) {
        $q->the_post();
        $p = foo_post();

        $postStr = "";
        $postStr .= foo_div("", "title", foo_h( $p['ttl'], 4 ) );
        $postStr .= foo_div("", "imagen", foo_img( foo_thumb( $p['img'], 300, 200 ) ) );
        $postStr .= foo_div("", "extracto", $p['ext'] );

        $proyectos .= foo_div( "", "sub_post proyecto_miembro", foo_link($postStr , $p['url'] ) );



   
    }
  

}


     $postSidebar .= foo_h("Proyectos",3) . foo_ul("","proyectos",$proyectos);

}

/*
        $lis = "";
        for($i=0;$i<3;$i++){
            $lis .= foo_link( foo_li("","taller_miembro","Taller ".$i), "#" );
        }

        $postSidebar .= foo_h("Talleres",3) . foo_ul("","talleres",$lis);
*/
        $postSidebar = foo_div("", "sidebar_single large-5 columns", $postSidebar );
        
        $echo .= $postSidebar;





?>

<div class="row">

<article id="post-<?php the_ID(); ?>" class="single <?php echo $post_type; ?>">

    <header>
	<hgroup>
	    <h2><?php echo $titulo; ?></h2>
	</hgroup>
    </header>

    <?php
    echo $echo ; 
    ?>
    </div>



    <footer>

    </footer>

</article>


</div> <!-- row -->

