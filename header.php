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

   var mouseX = 0;
   var mouseY = 0;
   var anim = 0.0;


   var showLis = function( li, r, x, y, cX, cY, clockwise, speed ){

     var sublis = li.find('li');
     var noLis = li.siblings().length +1;

     var noSublis = sublis.length;
     var spacing = 50;
     var i = li.index();

     var canvasX = canvas.offset().left;
     var canvasY = canvas.offset().top;

     if( clockwise ) {
       spin = anim * speed;
     }
     else {
       spin = 360 - anim * speed;
     }

     var newX = cX + r * Math.cos( spin + i * (360/noLis) * ( Math.PI / 180 ) );
     var newY = cY + r * Math.sin( spin + i * (360/noLis) * ( Math.PI / 180 ) );

     R.circle( newX, newY, 2 );

     li.offset({ left: newX + x + canvasX, top: newY + y + canvasY });
     
     var d = Math.sqrt( Math.pow( mouseX - newX - x, 2 ) + Math.pow( mouseY - newY - y, 2 ) );

     if( d < r ) {
       li.css({ opacity: 1 });
     }
     else  {
       li.css({ opacity: 0.4 });       
     }

     if( noSublis > 0 ) {
       R.circle( newX, newY, r/2 ); 
     }

     
     sublis.each( function(i) {
       var subli = $(this);
       showLis(subli, r/2, x, y, newX, newY, !clockwise, speed * 3 );
     });

   }
   
   var toggleMenu = function(){
     if( menuOn ) {
       var w = canvas.width() * 0.85;
       canvas.animate({ left: -width/2, width: w }, 1000);
       tim.animate({ left: -width/12 }, 1000);
     } else {
       var w = canvas.width();
       canvas.animate({ left: 0, width: w }, 1000);
       tim.animate({ left: 0 }, 1000);
     }

/*

   var lis = $('#menu li');
   var sublis = $('#menu li ul li');

   tim.offset({ left : cX + x - 50, top : cY + y - 30 });

   lis.click(function(e){
     e.preventDefault();
     toggleMenu();
   });     



*/

     menuOn != menuOn; 
console.log(menuOn);
   }


   var menuOn = true;
   var canvas = $('#canvas');
   var x = canvas.offset().left;
   var y = canvas.offset().top;
   
   var w = canvas.width();
   var h = canvas.height();

   var cX = w/2;
   var cY = h/2;

   var animate = function() {

     anim+=0.001;
     anim %= 360;

     R.clear();
     var lis = $('#menu > li');
     var h = 0;


     var c = R.circle( cX, cY, 375 );
     c.attr ("stroke", "#FFF");
     c = R.circle( cX, cY, 250 );
     c.attr ("stroke", "#EEE");

     lis.each(function() {
       var li = $(this);
       showLis( li, 250, x, y, cX, cY, true, 1 );
     });

   }
   
   var width = $(window).width();
   var height = $(window).height();

   var R = Raphael("canvas", width, height );

   var tim = $('#menu_titulo > a');
   var lis = $('#menu li');
   var sublis = $('#menu li ul li');

   tim.offset({ left : cX + x - 50, top : cY + y - 30 });

   lis.click(function(e){
     e.preventDefault();
     toggleMenu();
   });     

   setInterval( animate, 40 );

   $('body').mousemove( function(e) {
     mouseX = e.pageX; 
     mouseY = e.pageY;
   });


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

echo foo_div("canvas","","");

?>