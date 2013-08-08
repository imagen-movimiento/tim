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

<?php
wp_head();
?>


</head>

<script type="text/javascript">

jQuery(document).ready(function($){

     var anim = 0.0;
     var animate = function() {
         /* console.log("anim"); */
         anim+=0.01;
         anim %= 360;
         R.clear();
         var lis = $('#menu li');
         var h = 0;
         /*for( var h = 0; h < 20; h++ ) { */
             R.circle(50*h+50,50*h+50,30);
             var noLis = lis.length;
         
             for( var i = 0; i < noLis; i++ ) {
                 var x1 = Math.cos( anim + i * (360/noLis) * ( Math.PI / 180 ) );
                 var y1 = Math.sin( anim + i * (360/noLis) * ( Math.PI / 180 ) );
                 R.circle( x1*30 + 50*h+50, y1*30 + 50*h+50, 3);

             lis.eq(i).offset({ left: x1*30 + 50*h+250 , top: y1*30 + 50*h+250 });
             }
         /*}*/

     }
     

     var R = Raphael("canvas", 1050, 550);

     var lis = $('#menu li');
     

     lis.click(function(e){
         e.preventDefault();
         console.log("clickLI");
         /* $("#canvas").fadeOut(); */
     });     

     setInterval( animate, 20 );

});



</script>


<body <?php body_class(); ?>>

	<nav class="top-bar">
		<ul class="title-area">
			<li class="name"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1></li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'left', 'container' => '', 'fallback_cb' => 'foundation_page_menu', 'walker' => new foundation_navigation() ) ); ?>
		</section>
	</nav>

	<?php $header =  get_header_textcolor();
	if ( $header !== "blank" ) : ?>
	<header class="site-header" <?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) : ?> style="background:url('<?php echo esc_url( $header_image ); ?>');" <?php endif; ?>>
		<div class="row">
			<div class="large-12 columns">
				<h2><a style="color:#<?php header_textcolor(); ?>;" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'description' ); ?></a></h2>
			</div>
		</div>
	</header>
	<?php endif; ?>

<!-- Begin Page -->
<div class="row">


<?php

echo foo_div("canvas","","hola mundo");

?>