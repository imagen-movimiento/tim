
<?php
/*
Template Name: Inicio
*/

get_header();

$lorem = "
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
<p>Vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
<p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>
";

$img = foo_img( foo_thumb( themeDir() . "/img/cmm.jpg", 900, 400 ) );

$links = "";
for($h = 0; $h < 5; $h++) {
  $links .= foo_li("","",foo_link("subsección ".$h));
}




$img = foo_div("","img",$img );
$lorem = foo_div("","texto",$lorem );
$links = foo_div("","links",$links );




echo foo_div(
     "dos",
     "cortina",
     ""
);



echo foo_div(
     "tres",
     "cortina",
     foo_div("contenido", "", foo_div("sketch","","") )
     . foo_div("sidebar", "", foo_div("codigo","","código", "...") . foo_div("","texto","texto", "...."))
);

echo foo_div(
     "cuatro",
     "cortina",
     foo_div("contenido", "", foo_div("","fondo","") . foo_div("","codigo",$codigo) )
     . foo_div("sidebar", "", "" )
);


$codigo = "<xmp>setInterval( animate, 40 );

   $('body').mousemove( function(e) {
     mouseX = e.pageX; 
     mouseY = e.pageY;
   });
   
   
   $('#sidebar .links li').click(function(e){
     dos.animate({'left':-width * 1.675},1000);
     tres.animate({'left':-width * 0.925 },1000);
     e.preventDefault();
     e.stopPropagation();
     
   });
   
   $('#codigo').click(function(e){
     cuatro.animate({'left':-width * 0.925 },1000);     
     e.preventDefault();
     e.stopPropagation();
                     
   });</xmp>";



?>

<?php
get_footer();
?>