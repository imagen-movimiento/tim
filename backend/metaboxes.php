<?php

function custom_meta_box() {

  remove_meta_box( 'proyectodiv', 'entrada_proyecto', 'side' );

  add_meta_box( 'proyectodiv', 'Proyecto', 'proyecto_meta_box', 'entrada_proyecto', 'side' );
  add_meta_box( 'proyectodiv', 'Proyecto', 'proyectos_miembro_meta_box', 'miembro', 'side' );
  add_meta_box( 'diasdiv', 'Fechas', 'fechas_taller_meta_box', 'taller', 'side' );

}
add_action('add_meta_boxes', 'custom_meta_box');

/* Prints the taxonomy box content */
function proyecto_meta_box($post) {

  $tax_name = 'proyecto';
  $taxonomy = get_taxonomy($tax_name);
?>
<div class="tagsdiv" id="<?php echo $tax_name; ?>">
  <div class="jaxtag">
    <?php 
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'proyecto_noncename' );
    $type_IDs = wp_get_object_terms( $post->ID, 'proyecto', array('fields' => 'ids') );
    wp_dropdown_categories('taxonomy=proyecto&hide_empty=0&orderby=name&name=proyecto&show_option_none=Seleccionar proyecto&selected='.$type_IDs[0]); ?>
    <p class="howto">Selecciona el proyecto</p>
  </div>
</div>
<?php
}



function proyecto_save_postdata( $post_id ) {

  if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) ) 
  return;

  if ( !wp_verify_nonce( $_POST['proyecto_noncename'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'entrada_proyecto' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $type_ID = $_POST['proyecto'];

  $type = ( $type_ID > 0 ) ? get_term( $type_ID, 'proyecto' )->slug : NULL;

  wp_set_object_terms(  $post_id , $type, 'proyecto' );

}
/* Do something with the data entered */
add_action( 'save_post', 'proyecto_save_postdata' );
























function proyectos_miembro_meta_box() {
  global $post;

  
  $proyectos = get_post_meta($post->ID, 'proyectos', true);
  
  $arr = array();
  $invitados = new WP_Query(array( 'post_type'=>'proyecto_tim','posts_per_page'=>-1 ) );
  if( $invitados->have_posts() ) {
    while ( $invitados->have_posts() ) {
      $invitados->the_post();

      array_push( $arr, foo_filter( $post->post_title, 'title' ) );

    }
  }

  wp_nonce_field( 'proyectos_miembro_nonce', 'proyectos_miembro_nonce' );
?>
<script type="text/javascript">
jQuery(document).ready(function( $ ){
$( '#add-row' ).on('click', function() {
var row = $( '.empty-row.screen-reader-text' ).clone(true);
row.removeClass( 'empty-row screen-reader-text' );
row.insertBefore( '#proyectos-one tbody>tr:last' );
return false;
});
$( '.remove-row' ).on('click', function() {
$(this).parents('tr').remove();
return false;
});
});
</script>

<table id="proyectos-one" width="100%">
<thead>
<tr>
<th width="82%">Proyecto_tim</th>
<!--
<th width="12%">Select</th>
-->
<th width="8%"></th>
</tr>
</thead>
<tbody>
<?php
    
    if ( $proyectos ) {
      
      foreach ( $proyectos as $field ) {
        
        $options = '<option value="" ></option>';
        
        foreach( $arr as $t ) {
          $options .= '<option value="'.$t.'" '.selected($field,$t,0).'> '.$t.'</option>';
        }
        
        $select = '<select name="proyectos[]">'.$options.'</select>';

    ?>
<tr>
<td>
<?php
        echo $select;
        ?>
</td>
<td><a class="button remove-row" href="#">Quitar</a></td>
</tr>
<?php
    }

    }
    else {
      // show a blank one
    ?>
<tr>
<td>
<?php
        $options = '<option value="" ></option>';
        foreach( $arr as $t ) {
          $options .= '<option value="'.$t.'">'.$t.'</option>';
        }
        $select = '<select name="proyectos[]">'.$options.'</select>';
        echo $select;
        ?>
</td>
<td><a class="button remove-row" href="#">Quitar</a></td>
</tr>

<?php } ?>

<!-- empty hidden one for jQuery -->
<tr class="empty-row screen-reader-text">
<td>

<?php
        
        $options = '<option value=""></option>';
        foreach( $arr as $t ) {
          $options .= '<option value="'.$t.'">'.$t.'</option>';
        }
        $select = '<select name="proyectos[]">'.$options.'</select>';

        echo $select;
        ?>
</td>
<td><a class="button remove-row" href="#">Quitar</a></td>

</tr>
</tbody>
</table>

<p><a id="add-row" class="button" href="#">Añadir</a></p>
<?php
}

add_action('save_post', 'proyectos_miembro_save');
function proyectos_miembro_save($post_id) {
  if ( ! isset( $_POST['proyectos_miembro_nonce'] ) ||
      ! wp_verify_nonce( $_POST['proyectos_miembro_nonce'], 'proyectos_miembro_nonce' ) )
  return;
  
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  return;
  
  if (!current_user_can('edit_post', $post_id))
  return;
 
 
  
  $old = get_post_meta($post_id, 'proyectos', true);
  $new = array();
  //~ $options = foo_get_sample_options();
  
  $proyectos = $_POST['proyectos'];
  
  $count = count( $proyectos );
  
  for ( $i = 0; $i < $count; $i++ ) {
    if ( $proyectos[$i] != '' ) {
      $new[$i] = stripslashes( strip_tags( $proyectos[$i] ) );
    }
  }

  if ( !empty( $new ) && $new != $old )
  update_post_meta( $post_id, 'proyectos', $new );
  elseif ( empty($new) && $old )
  delete_post_meta( $post_id, 'proyectos', $old );
}



















function fechas_taller_meta_box($post) {

//  $nombres_dias = array ( 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sabado', 'domingo' );

  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

  $fecha_inicio = get_post_meta( $post->ID, 'fecha_inicio', true  );
  $fecha_final = get_post_meta( $post->ID, 'fecha_final', true  );
  $horarios = get_post_meta( $post->ID, 'horarios', true  );
  $lugar = get_post_meta( $post->ID, 'lugar', true  );

//  $dias_checked = get_post_meta( $post->ID, 'dias_semana', true  );
  
  wp_nonce_field( plugin_basename( __FILE__ ), 'fechas_taller_noncename' );
  
?>

<form id="fechas_form">
  <div id="fechas">

Fecha de inicio: 
    <input class="fecha" name="fecha_inicio" type="textbox" value="<?php echo $fecha_inicio; ?>"/>
</br>
Fecha de final: 
<input class="fecha" name="fecha_final"  type="textbox" value="<?php echo $fecha_final; ?>"/>  
  </div>

  <div id="info">

</br>
Horarios:
</br>
<textarea class="horarios" name="horarios" cols="32"><?php echo $horarios; ?></textarea>  
</br>

Lugar: 
</br>
<textarea class="lugar" name="lugar"  cols="32"><?php echo $lugar; ?></textarea>
</br>
</div>

  <!-- <div id="dias_semana_div">
  <?php 
  foreach( $nombres_dias as $dia ) {
  if(count($dias_checked[0])>0) {
  $echo .= '<li style="list-style:none;"><label><input type="checkbox" name="dias_semana[]" value="';
  $echo .= $dia.'" '. ( is_array($dias_checked) && in_array($dia,$dias_checked ) ? 'checked':'' ).'>'.$dia.'</label></li>';
  }
  else {
  $echo .= '<li style="list-style:none;"><label><input type="checkbox" name="dias_semana[]" value="';
  $echo .= $dia.'">'.$dia.'</label></li>';
  }
  }
  
  echo $echo;
  ?>
  </div> -->
</form>


<script>
 jQuery(document).ready(function(){
   jQuery('.fecha').datepicker({
     dateFormat : 'mm/dd/yy'
   });
 });
</script>

<?php
}


function fechas_taller_save_postdata( $post_id ) {

  if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) ) 
  return;

  if ( !wp_verify_nonce( $_POST['fechas_taller_noncename'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'taller' == $_POST['fechas_taller_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_final = $_POST['fecha_final'];
  $horarios = $_POST['horarios']; 
  $lugar = $_POST['lugar']; 
  //$dias = $_POST['dias_semana'];
  /* $dias = array( $_POST['lunes'], $_POST['martes'], $_POST['miércoles'], $_POST['jueves'], $_POST['viernes'] ); */

  
  
//  update_post_meta($post_id, 'dias_semana', $dias );
  update_post_meta($post_id, 'fecha_inicio', $fecha_inicio );
  update_post_meta($post_id, 'fecha_final', $fecha_final );
  update_post_meta($post_id, 'horarios', $horarios );
  update_post_meta($post_id, 'lugar', $lugar );

}

add_action( 'save_post', 'fechas_taller_save_postdata' );




















// ocultar elementos del menú no deseados en la administración de WP
add_action('admin_menu', 'remove_menus', 102);
function remove_menus()
{
    global $submenu;

    remove_menu_page( 'edit.php' ); // Posts
    remove_menu_page( 'upload.php' ); // Media
    remove_menu_page( 'link-manager.php' ); // Links
    remove_menu_page( 'edit-comments.php' ); // Comments
   // remove_menu_page( 'plugins.php' ); // Plugins
 //   remove_menu_page( 'themes.php' ); // Appearance
//    remove_menu_page( 'users.php' ); // Users
 //   remove_menu_page( 'tools.php' ); // Tools
 //   remove_menu_page('options-general.php'); // Settings


}