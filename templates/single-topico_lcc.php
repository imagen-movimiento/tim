<?php


$pagMadre = "Laboratorio de Código Creativo";

$subpáginas = array( "Investigación", "Referencias", "Ejemplos", "Proyectos" );
$paginasExcluidas = array( "Blog", "Miembros","Tópicos" );






if ( have_posts() ) while ( have_posts() ) : the_post();

    $titulo = get_the_title();
    $titulo = '<h2>'.$titulo.'</h2>';

    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
    $img =  timthumb($img[0],235,235);
    $img = makeImg($img);

    $contenido = apply_filters('the_content',get_the_content() );

    // $madre = get_page_by_title( $pagMadre );
    // $pages = get_pages( array( 'child_of' => $madre->ID, 'parent' => $madre->ID ) );

    // foreach ($pages as $page ) {
    //     if ( !in_array( $page->post_title, $paginasExcluidas ) )
    //         $subpaginas .= makeLi("","opcion",$page -> post_title, get_permalink( $page -> ID ) );
    // }

    $archivesLcc = array('proyectos'=>'proyecto_lcc','referencias'=>'referencia_lcc','ejercicios'=>'ejercicio_lcc','investigación'=>'investigacion_lcc');
    

    foreach ($archivesLcc as $pt => $slug ) {
        $subpaginas .= makeLi("","", makeLink($pt,get_post_type_archive_link($slug) ) );
    }

    $postStr = "";

    $postStr .= makeDiv("","titulo",$titulo);

    $menu .= makeDiv("","menu sidebar span4", makeUl ( "", "", $subpaginas ) );
    
    $divInfo =  makeDiv("","info",
                    makeDiv("","contenido",$contenido)
                );

    $postStr .= makeDiv("","imagen_info",
        makeDiv("","imagen",$img)
        .

        $divInfo
    );

    


endwhile;

    $postPrincipal = makeDiv("","entrada proyecto",$postStr);


    
    $blog = "";
    $slug = $post->post_name;

    $query = new WP_Query( array(   'post_type'=>'entrada_proyecto',
                                    'taxonomy'=>'proyecto',
                                    'term'=>$slug ));

    while ($query->have_posts()) : $query->the_post(); 

        $titulo = get_the_title();
        $titulo = '<h2>'.$titulo.'</h2>';
        $link = get_permalink($post->ID);
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $img =  timthumb($img[0],235,235);
        $img = makeImg($img);
        $contenido = apply_filters('the_content',get_the_content() );

        $postStr = "";
        $postStr .= makeDiv("","titulo",$titulo);       
        $postStr .= makeDiv("","imagen_info",
            makeDiv("","imagen",$img)
            .
            makeDiv("","info",makeDiv("","contenido",$contenido) )
        );


        $blog .= makeDiv("","entrada proyecto",$postStr,$link);
        
    endwhile;
                                  
    $contenido = makeDiv("proyecto_blog", "main span8", $postPrincipal . $blog );

    echo makeDiv( "","row", $contenido . $menu );

?>