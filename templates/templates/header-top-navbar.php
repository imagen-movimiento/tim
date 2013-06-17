<header id="menu" class="banner navbar navbar-static-top" role="banner">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <img src="<?php echo home_url(); ?>/wp-content/themes/tim/img/muybridge.gif"/>
<!--       <a class="brand" href="<?php echo home_url(); ?>/">
        <?php bloginfo('name'); ?>
      </a>
 -->
       <nav class="nav-main nav-collapse collapse" role="navigation">


        <?php
echo themeDir();
        // crear menú:
        $inicio = get_page_by_title('TIM');

        $id = $inicio->ID;

        $pages = get_pages( array('child_of' => $id, 'parent'=>$id ) );
        foreach ($pages as $page ) {

            $titulo = $page->post_title;
            $link = get_permalink($page->ID);

            if( $page->post_title == "Cursos y talleres"){                
                $subID = $page->ID;
                $subpages = get_pages( array('child_of' => $subID, 'parent'=>$subID ) );
                
                $sublis = null;
                
                foreach ($subpages as $subpage ) {
                    $sublis .= makeLi( "", "", $subpage->post_title, get_permalink($subpage->ID) );
                }
                if($sublis)
                    $subUl = makeUl ("", "", $sublis );
            
            }
            else if( $page->post_title == "Laboratorio de Código Creativo" ) {
                
                $query = new WP_Query( array(   'post_type'=>'topico_lcc' ) );
                $sublis = null;
                while ($query->have_posts()) : $query->the_post(); 
                    $linkLi = get_permalink( $post->ID );
                    $tituloLi = apply_filters("the_title",$post->post_title);
                    $sublis .= makeLi("","",makeLink($tituloLi,$linkLi));
                endwhile;
                $subUl = makeUl ("", "", $sublis );                
            }
            else if( $page->post_title == "Miembros" ) {
                $query = new WP_Query('post_type=miembro');
                $sublis = null;
                while ($query->have_posts()) : $query->the_post();
                    $sublis .= makeLi( "", "", $post->post_title, get_permalink($post->ID) );            
                endwhile;                                       
                $subUl = makeUl("","",$sublis );
            }
            else {                    
                $subUl = "";
            }

            $pageLis .= makeLi( "", "", makeLink( $titulo, $link ) . $subUl );
        }

        echo makeUl("","menu nav paginas",$pageLis);

        ?>




      </nav>
    </div>
  </div>
</header>


<?php 
while (have_posts()):the_post(); endwhile;
?>

<?php
// global $template; echo $template;
?>


<?php 

// echo makeLink("ir->",get_post_type_archive_link('topico_lcc'));

 ?>
