<?php
/*
Template Name: Talleres

Al cargar la primera vez: revisa si hay eventos futuros. Si los hay, los muestra. Si no, sólo muestra pasados y no muestra el menú.

 */

$post_type = 'taller';

$posts = "";
$claseS = "taller";
$clasePl = "talleres";
$titulo = "Talleres";



$links = foo_li("","",foo_link("Futuros","#"));
$links .= foo_li("","",foo_link("Pasados","#"));

$menu = foo_div("menu_talleres","",$links);

$postsDiv = foo_div("posts_loader", "posts row");

$echo = foo_h($titulo,1);
$echo .= $menu;
$echo .= $postsDiv;
echo $echo;

?>

<script type="text/javascript">

jQuery(document).ready(function($) {

    var ajaxloader = $("#ajax-loader");
    var url = $("#url").html();

    var cargar_talleres = function( text, callback ) {
        var targetDiv = $('#posts_loader');
        targetDiv.html('');
        targetDiv.html(ajaxloader.clone().fadeIn());
        
        $.ajax({  
            type: 'POST',  
            url: url+'/wp-admin/admin-ajax.php',  
            data: {                                  
                action: 'cargar_talleres',
                tiempo: text
            },  
            success: function(data, textStatus, XMLHttpRequest){  
                if(text == "Futuros" && data == "" ){
                    cargar_talleres("Pasados");
                     $('#menu_talleres').hide();
                } 
                targetDiv.html(data);
                setupLis();
            },  
            error: function(MLHttpRequest, textStatus, errorThrown){  
                alert(errorThrown);  
            }  
        });  
        
    }

    $('#menu_talleres a').click(
        function(e) {
            var link = $(this);
            var text = link.text();
            
            cargar_talleres(text);
            

            e.stopPropagation();
            e.preventDefault();
            return false;
        }
        
    );

    cargar_talleres( "Futuros", cargar_talleres );
});

</script>
