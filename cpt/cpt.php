<?php

function cpt() {
// creating (registering) the custom type
register_post_type( 'proyecto_tim', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// let's now add all the options for this Proyecto
array('labels' => array(
'name' => __('Proyectos', 'Proyecto general name'), /* This is the Title of the Group */
'singular_name' => __('Proyecto', 'Proyecto singular name'), /* This is the individual type */
'add_new' => __('Add New', 'proyecto type item'), /* The add new menu item */
'add_new_item' => __('Añadir Proyecto'), /* Add New Display Title */
'edit' => __( 'Edit' ), /* Edit Dialog */
'edit_item' => __('Editar Proyectos'), /* Edit Display Title */
'new_item' => __('Proyecto Nuevo'), /* New Display Title */
'view_item' => __('Ver Proyecto'), /* View Display Title */
'search_items' => __('Buscar Proyecto'), /* Search Custom Type Title */
'not_found' => __('Nothing found in the Database.'), /* This displays if there are no entries yet */
'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
'parent_item_colon' => ''
), /* end of arrays */
'description' => __( '' ), /* Custom Type Description */
'public' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'show_ui' => true,
'query_var' => true,
'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Proyecto type menu */
'rewrite' => true,
'capability_type' => 'post',
'hierarchical' => false,
/* the next one is important, it tells what's enabled in the post editor */
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
'has_archive' => true	) /* end of options */
); /* end of register Proyecto */


// creating (registering) the custom type
register_post_type( 'entrada_proyecto', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// let's now add all the options for this Entrada De Proyecto
array('labels' => array(
'name' => __('Entradas De Proyecto', 'Entrada De Proyecto general name'), /* This is the Title of the Group */
'singular_name' => __('Entrada De Proyecto', 'Entrada De Proyecto singular name'), /* This is the individual type */
'add_new' => __('Add New', 'entrada de proyecto type item'), /* The add new menu item */
'add_new_item' => __('Añadir Entrada De Proyecto'), /* Add New Display Title */
'edit' => __( 'Edit' ), /* Edit Dialog */
'edit_item' => __('Editar Entradas De Proyectos'), /* Edit Display Title */
'new_item' => __('Entrada De Proyecto Nueva'), /* New Display Title */
'view_item' => __('Ver Entrada De Proyecto'), /* View Display Title */
'search_items' => __('Buscar Entradas De Proyecto'), /* Search Custom Type Title */
'not_found' => __('Nothing found in the Database.'), /* This displays if there are no entries yet */
'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
'parent_item_colon' => ''
), /* end of arrays */
'description' => __( '' ), /* Custom Type Description */
'public' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'show_ui' => true,
'query_var' => true,
'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Entrada De Proyecto type menu */
'rewrite' => true,
'capability_type' => 'post',
'hierarchical' => false,
/* the next one is important, it tells what's enabled in the post editor */
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
'has_archive' => true	) /* end of options */
); /* end of register Proyecto */



/* this ads your post categories to your Proyecto type */
register_taxonomy_for_object_type('proyecto', 'entrada_proyecto');
/* this ads your post tags to your Proyecto type */
//~ register_taxonomy_for_object_type('post_tag', 'proyecto');

}

// adding the function to the Wordpress init
add_action( 'init', 'cpt');


//~ function add_links_metabox() {
//~ add_meta_box('proyecto_link', 'Link Externo', 'proyecto_link', 'proyecto');
//~ }
//~

/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

// now let's add Proyecto (these act like categories)
    register_taxonomy( 'proyecto',
     array('proyecto'), /* if you change the name of register_post_type( 'proyecto', then you have to change this */
     array('hierarchical' => true, /* if this is true it acts like categories */
     'labels' => array(
     'name' => __( 'Proyecto' ), /* name of the custom taxonomy */
     'singular_name' => __( 'Proyecto' ), /* single taxonomy name */
     'search_items' => __( 'Buscar Proyecto' ), /* search title for taxomony */
     'all_items' => __( 'Todas las Proyectos' ), /* all title for taxonomies */
     'parent_item' => __( 'Proyecto Superior' ), /* parent title for taxonomy */
     'parent_item_colon' => __( 'Proyecto Superior:' ), /* parent taxonomy title */
     'edit_item' => __( 'Editar Proyecto' ), /* edit custom taxonomy title */
     'update_item' => __( 'Actualizar Proyecto' ), /* update title for taxonomy */
     'add_new_item' => __( 'Añadir Proyectos' ), /* add new title for taxonomy */
     'new_item_name' => __( 'Nombre de proyecto nuevo' ) /* name title for taxonomy */
     ),
     'show_ui' => true,
     'query_var' => true,
     )
    );













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





















// filtrado:



function restrict_entradas_proyecto_by_proyecto() {
		global $typenow;
		$post_type = 'entrada_proyecto'; // change HERE
		$taxonomy = 'proyecto'; // change HERE
		if ($typenow == $post_type) {
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy' => $taxonomy,
				'name' => $taxonomy,
				'orderby' => 'name',
				'selected' => $selected,
				'show_count' => true,
				'hide_empty' => true,
			));
		};
	}

	add_action('restrict_manage_posts', 'restrict_entradas_proyecto_by_proyecto');

	function convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'entrada_proyecto'; // change HERE
		$taxonomy = 'proyecto'; // change HERE
		$q_vars = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

	add_filter('parse_query', 'convert_id_to_term_in_query');






?>