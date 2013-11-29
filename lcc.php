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
    $echo .= foo_div("","title",foo_h( $p['ttl'], 4 ) );
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

    $titulo = foo_div("","titulo",foo_h( $p['ttl'], 1 ));

    $echo .= foo_div("","large-8 columns contenido_post", $titulo . $p['cnt']);
    $echo .= foo_div("","topicos sidebar large-4 columns",$topicos);

    $echo = foo_div("","single paginalcc  post row", $echo ) ;



        /* $echo = foo_div("fondo","", foo_img( $p['img'] ) ) .  $echo; */
        // .  $echo;

  }

}


echo foo_div("fondo");

?>
<script type="text/javascript">


jQuery(document).ready(function($){
     var fondo = $('#fondo');
     var cs = $('.collapsable');
     var parent = fondo.parent().parent();
     var img = fondo.find('img');

     var fondoW = parent.width() / cs.length ;
     var fondoH = parent.height();

     fondoW *= 0.97;
     
     console.log( parent.attr('class') + fondoW );
     
     fondo.width(fondoW);
     fondo.height(fondoH);
     img.width(fondoW);
     img.height(fondoH);
});


</script>

<?php 

echo $echo;    

?>