<?php
/**
 * Header
 *
 * Setup the header for our theme
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />

<title><?php wp_title(); ?></title>

<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/raphael/raphael-min.js"></script>
<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/columnizer/src/jquery.columnizer.js" type="text/javascript"></script>

<script language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/collapsable.js/collapsable.js" type="text/javascript"></script>

<?php
wp_head();
?>


</head>



<?php



$lis = "";


// talleres: 

$link = get_post_type_archive_link('taller');
$sublis = "";
$sublis .= foo_li("","", foo_link( 'Oferta', $link  ) );
$sublis .= foo_li("","", foo_link( 'Pasados', $link  ) );
$sublis .= foo_li("","", foo_link( 'Futuros', $link  ) );

$sublis = foo_ul("","",$sublis);

$lis .= foo_li("","", foo_link( 'Talleres', $link  ) . $sublis );

$sublis = "";



// miembros:

$link = get_post_type_archive_link('miembro');
$sublis = "";
$query = new WP_Query(array('post_type'=>'miembro'));
while($query->have_posts()) {
  $query -> the_post(); $p = foo_post();
  $sublis .= foo_li("","",$p['ttl'], $p['url']);
}

$sublis = foo_ul("","",$sublis);

$lis .= foo_li("","", foo_link( 'Miembros', $link  ) . $sublis );




// LCC

$link = get_permalink(get_page_by_title('Laboratorio de Código Creativo')->ID);
$sublis = "";

$query = new WP_Query(array('post_type'=>'lcc','post_parent'=>0));
while($query->have_posts()) {
  $query -> the_post(); $p = foo_post();
  $sublis .= foo_li("","",$p['ttl'], $p['url']);
}

$sublis = foo_ul("","",$sublis);

$lis .= foo_li("","", foo_link( 'Laboratorio de Código Creativo' . $sublis, $link ) );



// proyectos

$link = get_post_type_archive_link('proyecto_tim');
$sublis = "";

$query = new WP_Query(array('post_type'=>'proyecto_tim'));
while($query->have_posts()) {
  $query -> the_post(); $p = foo_post();
  $sublis .= foo_li("","",foo_post()['ttl']);
}

$sublis = foo_ul("","",$sublis);

$lis .= foo_li("","", foo_link( 'Proyectos' . $sublis, $link ) );



?>

<body <?php body_class(); ?>>
  <?php
  echo foo_div("canvas","","");
  ?>
  
        <nav class="top-bar">
                <ul class="title-area">
                        <li class="name"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1></li>
                        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
		  <?php

                  echo foo_ul("menu_arriba","",$lis);

                  ?>
		</section>
	</nav>

	<?php
        echo foo_ul( "menu", "", $lis );
        echo foo_div("menu_titulo","",foo_link( "TIM", site_url()));

        
        ?>

        <header class="site-header">
		<div class="row">
			<div class="large-12 columns">
                          <?php
//                          echo foo_div("menu_arriba","",$lis);
                          ?>
			</div>
		</div>
	</header>


        <?php
        echo foo_div("","hidden",site_url());
        ?>
        

<div class="row">