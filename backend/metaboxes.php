<?php

function custom_meta_box() {

  remove_meta_box( 'proyectodiv', 'entrada_proyecto', 'side' );

  add_meta_box( 'proyectodiv', 'Proyecto', 'proyecto_meta_box', 'entrada_proyecto', 'side' );
  add_meta_box( 'diasdiv', 'Días de la semana', 'fechas_taller_meta_box', 'taller', 'side' );

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

/* When the post is saved, saves our custom taxonomy */
function proyecto_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) ) 
  return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

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














/* Prints the taxonomy box content */
function fechas_taller_meta_box($post) {

  $nombres_dias = array ( 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sabado', 'domingo' );

  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

  $fecha_inicio = get_post_meta( $post->ID, 'fecha_inicio', true  );
  $fecha_final = get_post_meta( $post->ID, 'fecha_final', true  );
  $dias_checked = get_post_meta( $post->ID, 'dias_semana', true  );

  wp_nonce_field( plugin_basename( __FILE__ ), 'fechas_taller_noncename' );

?>

    <form id="fechas_form">
  <div id="fechas">

Del
<input class="fecha" name="fecha_inicio" type="textbox" value="<?php echo $fecha_inicio; ?>"/>
</br>
al
<input class="fecha" name="fecha_final"  type="textbox" value="<?php echo $fecha_final; ?>"/>  
</div>

<div id="dias_semana_div">
    <?php 
    foreach( $nombres_dias as $dia ) {
      $echo .= '<label><input type="checkbox" name="dias_semana[]" value="'.$dia.'" '. (in_array($dia,$dias_checked ) ? 'checked':'' ).'>'.$dia.'</label>';
    }

    echo $echo;
    ?>
</div>
</form>


<script>
jQuery(document).ready(function(){
   jQuery('.fecha').datepicker({
     dateFormat : 'dd/mm/yy'
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
  
  $dias = $_POST['dias_semana'];
  /* $dias = array( $_POST['lunes'], $_POST['martes'], $_POST['miércoles'], $_POST['jueves'], $_POST['viernes'] ); */

  
  
  add_post_meta($post_id, 'dias_semana', $dias, true );
  add_post_meta($post_id, 'fecha_final', $fecha_final, true );
  add_post_meta($post_id, 'fecha_final', $fecha_final, true );

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
    remove_menu_page( 'plugins.php' ); // Plugins
    remove_menu_page( 'themes.php' ); // Appearance
    remove_menu_page( 'users.php' ); // Users
    remove_menu_page( 'tools.php' ); // Tools
    remove_menu_page(‘options-general.php’); // Settings


}