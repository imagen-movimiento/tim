<?php
$tiene_hijos = true;

while( have_posts() ) {
    if( have_posts() ) {
        the_post();
        
        $args = array(
            'post_type'=>'lcc',
            'post_parent'=>$post->ID
        );

        $posts = "";

        $query = new WP_Query($args);
        if( ! $query->have_posts() ){
            $tiene_hijos = false;
        }
        if($query->have_posts()){
            while($query->have_posts()){

                $query->the_post();
                $p = foo_post();
                $echo = "";
                $echo .= foo_div("","title",foo_h( $p['ttl'], 4 ) );
                $echo .= foo_curtain(
                    foo_div("","imagen", foo_img( foo_thumb( $p['img'], 300, 300 ) ) ),
                    foo_vcenter( foo_div("","extracto",$p['ext'] ) )
                );
                $echo = foo_li("","lcc",$echo,$p['url']);
                
                $posts .= $echo;
                
            }

        }

        if($tiene_hijos) {
            $posts = foo_ul("","", $posts );
            /* $posts = foo_ul("","large-block-grid-3", $posts ); */
        }

        wp_reset_query();
        $p = foo_post();
        $echo = "";
        $echo .= foo_div("","title",foo_h( $p['ttl'], 2 ) );
        $echo .= foo_div("","imagen", foo_img( foo_thumb( $p['img'], 450, 200 )  ) );
        $echo .= foo_div("","contenido", $p['cnt'] );


        $terms = get_terms( array( 'seccion' ) );

        foreach($terms as $t){
            $menu .= foo_li( "","",$t->name );
        }
        
        if( $tiene_hijos ) { $num_cols = 8; }
        else { $num_cols = 12; }

        $echo = foo_div("","lcc post large-".$num_cols." columns", $echo );
        $echo .= foo_div("","menu_posts sidebar-3 large-4 columns row", $menu . $posts );
        //    $echo .= foo_div("","posts sidebar-3 large-6 columns", $posts );

        $echo = foo_div("","single row", $echo );

        echo $echo; 
    }

}

