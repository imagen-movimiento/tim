<?php

function custom_meta_box() {

  remove_meta_box( 'proyectodiv', 'entrada_proyecto', 'side' );

  add_meta_box( 'proyectodiv', 'Proyecto', 'proyecto_meta_box', 'entrada_proyecto', 'side' );

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
    wp_dropdown_categories('taxonomy=proyecto&hide_empty=0&orderby=name&name=proyecto&show_option_none=Select type&selected='.$type_IDs[0]); ?>
    <p class="howto">Select your type</p>
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


  // Check permissions
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

  // OK, we're authenticated: we need to find and save the data

  $type_ID = $_POST['proyecto'];

  $type = ( $type_ID > 0 ) ? get_term( $type_ID, 'proyecto' )->slug : NULL;

  wp_set_object_terms(  $post_id , $type, 'proyecto' );

}
/* Do something with the data entered */
add_action( 'save_post', 'proyecto_save_postdata' );
