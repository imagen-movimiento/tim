<?php

//HACER QUE LA H DE CLPSBL SEA IGUAL A SU H - 45 (TOP-NAV)


/*
 *
 * Footer
 *
 * Displays content shown in the footer section
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 *
 */

?>

</div>
<!-- End Page -->

<!-- Footer -->
<footer class="row">


    <div class="large-12 columns">

    </div>


</footer>
<!-- End Footer -->

<?php wp_footer(); ?>




<div id="sliders_mask">
    <div id="sliders"></div>
</div>

</body>



</body>






<script type="text/javascript">

 jQuery(document).ready(function($){

     var mouseX = 0;
     var mouseY = 0;
     var anim = 0.0;


var s = $('#sliders');

     var cs = new Cortinas( s );

     cs.expandCallback = function()
     { 
      if( cs.active > 0 )
      {
         $('.top-bar').animate({marginTop:0},1000);
             
         }
      else {
         $('.top-bar').animate({marginTop:-45},1000);
             
         }

      }

     var txt = '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. <a href="http://localhost/web/tim/pagina-ejemplo/">liga</a></p>';




     var inicio = $('<div>').append( $('#canvas').detach() );

     inicio.append( $('#menu').detach() );


     cs.añadir( "Menú", inicio );
     /* cs.añadir("hola",txt); */

    
     //     cs.quitar();


     cs.collapse();


     var cortinas = cs.cortinas;
/*
     for(i in cortinas)
     {
         var links = cortinas[i].contenido.find('a');
         links.each(
             function()
             {
                 var texto = $(this).text();

                 var contenido = "...";
                 var cortinasParent = cortinas[i].parent;
                 $(this).click(
                     function(e)
                     {
                         e.preventDefault();
                         e.stopPropagation();
                         cortinasParent.añadir( texto, contenido);
                         cortinasParent.cortinas[cortinas.length-1].expand();
                         
                     });
             });
         
     }
*/

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

     var showCurrent = function(){
         li = currentLi;
         
         var cX = 140;
         var cY = 140;
         var r = 100;
         var offset = Math.abs(canvas.offset().left);
         
         
         li.css({opacity:1});
         li.find('li').css({opacity:1});
         
         var sublis = li.find('li');
         var noSublis = sublis.length;
         
         spin = anim * 3;
         
         var c = R.circle(cX+offset,cY,r);
         c.attr('stroke','#ddd');
         if( noSublis > 0 ) {
             sublis.each( function(i) {
                 var newX = cX + r * Math.cos( spin + i * (360/noSublis) * ( Math.PI / 180 ) );
                 var newY = cY + r * Math.sin( spin + i * (360/noSublis) * ( Math.PI / 180 ) );
                 var subli = $(this);
                 subli.offset({left:newX,top:newY});
                 R.circle( newX + offset, newY, 2 ); 
             });
             
         }
         
     }

     
     var toggleMenu = function(){

         if( menuOn ) {
             var w = canvas.width() * 0.85;
             canvas.animate({ left: -width/1.5 }, 1000, function(){ menuOn =! menuOn; });
             /* canvas.animate({ left: -width/2, width: w }, 1000); */
             tim.animate({ left: -width/12 }, 1000);
             dos.animate({ left: -width*0.75 }, 1000);
         }
         else if( !menuOn) {
             var w = $('body').width();
             canvas.animate({ left: 0 }, 1000, function(){ menuOn =! menuOn; });
             /* canvas.animate({ left: 0, width: w }, 1000); */
             tim.animate({ left: width/1.5 - width/7 }, 1000);
             dos.animate({ left: width * 0.5 }, 1000);

         }

         
     }

     var setupPost = function(){
         $('.single .sidebar a').click(function(e){
             e.preventDefault();
             e.stopPropagation();
             
             var url = $(this).attr('href');

             $.get(url, function(data) {
                 $('#load').html(data);                                                     
                 /* tres.html(data); */
                 dos.animate({'left':-width * 1.675},1000);
                 tres.animate({'left':-width * 0.925 },1000); });

             return false;
             
         });
     }


     var menuOn = true;
     var canvas = $('#canvas');
     var tim = $('#menu_titulo > a');
     var dos = $('#dos');
     var tres = $('#tres');
     var cuatro = $('#cuatro');
     var x = canvas.offset().left;
     var y = canvas.offset().top;
     var currentLi;
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
         c.attr ("stroke", "#EEE");
         c = R.circle( cX, cY, 250 );
         c.attr ("stroke", "#D9D9D9");

         lis.each(function() {
             var li = $(this);
             
             if(menuOn) {
                 showLis( li, 250, x, y, cX, cY, true, 1 );
             }
             else {
                 showCurrent();
             }

         });
         
         
         
         
         sketch.clear();     
         for( i in particulas ){
             particulas[i].x += particulas[i].velX;
             particulas[i].y += particulas[i].velY;
             
             var px = particulas[i].x;
             var py = particulas[i].y;
             
             if ( px > sw || px < 0 ) particulas[i].velX *= -1; 
             if ( py > sh || py < 0 ) particulas[i].velY *= -1; 
             var c = sketch.circle( px, py, 2);     
             c.attr('stroke','#fff');
             
             var l = particulas.length;
             
             var nxt = particulas[ (parseInt(i)+17 )% l ];
             
             if( nxt.x > mouseX ) nxt.velX -= 0.5;
             if( nxt.x < mouseX ) nxt.velX += 0.5;
             if( nxt.y > mouseY ) nxt.velY -= 0.5;
             if( nxt.y < mouseY ) nxt.velY += 0.5;
             
             var p = sketch.path("M"+px+" "+py+" L"+ nxt.x + " " +  nxt.y );
             
             
         }

     }
     
     var width = $(window).width();
     var height = $(window).height();
     
     var R = Raphael("canvas", width, height );
     var sketch = Raphael("sketch", width * 0.8, height );
     
     var sw = sketch.canvas.offsetWidth;
     var sh = sketch.canvas.offsetHeight;
     
     var particulas = [];
     
     for(var i = 0; i < 10; i++){
         particulas.push({
             x : Math.random() * sw,
             y: Math.random() * sh,
             velX: Math.random() * 30 - 15,
             velY: Math.random() * 30 - 15 
         });
     }
     
     
     var lis = $('#menu > li');
     var sublis = $('#menu li ul li');
     var alllis = $('#menu li a');
     tim.offset({ left : cX + x - 50, top : cY + y - 30 });

     alllis.attr('onclick',function(){ return false; });
     
     alllis.click(function(e){
         
         currentLi = $(this);

         currentLi.unbind( 'click' );

         var url = currentLi.find('a').attr('href');

         e.preventDefault();
         e.stopPropagation();
     
         $.get(url, function(data) {

             return false;

         });
     
         return false;

       
     });


     /* setInterval( animate, 20 ); */
     animate();

     $('body').mousemove( function(e) {
         mouseX = e.pageX; 
         mouseY = e.pageY;
     });
     
     $('a').click(function(e){

         e.preventDefault();
         e.stopPropagation();
         
         return false;

     });




     /*

     $('#sidebar .links li').click(function(e){
         dos.animate({'left':-width * 1.675},1000);
         tres.animate({'left':-width * 0.925 },1000);
         e.preventDefault();
         e.stopPropagation();
         
     });
     
     $('#codigo').click(function(e){
         cuatro.animate({'left':-width * 0.25 },1000);     
         e.preventDefault();
         e.stopPropagation();
         
     });
     

     $('.single .contenido').columnize({width:'200px'});

      */






/*
     si una sección tiene #subblog
     
     animar su entrada:
                  - Conocer el ancho de la columna de #subblog.
                  
     -
     b)




archivos
- lista de posts con la clase "loadInPlace"



jquery_

si tiene la clase loadInPlace -> cargar en la misma pag

*/


     
 });

</script>




</html>


