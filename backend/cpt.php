<?php

function cpt() {

  register_post_type( 'proyecto_tim',
                     
                     array('labels' => array(
      'name' => __('Proyectos', 'Proyecto general name'),
      'singular_name' => __('Proyecto', 'Proyecto singular name'),
      'add_new' => __('Add New', 'proyecto type item'),
      'add_new_item' => __('Añadir Proyecto'),
      'edit' => __( 'Edit' ),
      'edit_item' => __('Editar Proyectos'),
      'new_item' => __('Proyecto Nuevo'),
      'view_item' => __('Ver Proyecto'),
      'search_items' => __('Buscar Proyecto'),
      'not_found' => __('Nothing found in the Database.'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
    ),
                           'description' => __( '' ),
                           'public' => true,
                           'publicly_queryable' => true,
                           'exclude_from_search' => false,
                           'show_ui' => true,
                           'query_var' => true,
                           'menu_position' => 8,
                           'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
                           'rewrite' => true,
                           'capability_type' => 'post',
                           'hierarchical' => false,
                           
                           'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
                           'has_archive' => true        )
                     );


  
  register_post_type( 'entrada_proyecto',
                     array('labels' => array(
      'name' => __('Entradas De Proyecto', 'Entrada De Proyecto general name'),
      'singular_name' => __('Entrada De Proyecto', 'Entrada De Proyecto singular name'),
      'add_new' => __('Add New', 'entrada de proyecto type item'),
      'add_new_item' => __('Añadir Entrada De Proyecto'),
      'edit' => __( 'Edit' ),
      'edit_item' => __('Editar Entradas De Proyectos'),
      'new_item' => __('Entrada De Proyecto Nueva'),
      'view_item' => __('Ver Entrada De Proyecto'),
      'search_items' => __('Buscar Entradas De Proyecto'),
      'not_found' => __('Nothing found in the Database.'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
    ),
                           'description' => __( '' ),
                           'public' => true,
                           'publicly_queryable' => true,
                           'exclude_from_search' => false,
                           'show_ui' => true,
                           'query_var' => true,
                           'menu_position' => 8,
                           'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
                           'rewrite' => true,
                           'capability_type' => 'post',
                           'hierarchical' => false,
                           
                           'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
                           'has_archive' => true        )
                     );



  register_taxonomy_for_object_type('proyecto', 'entrada_proyecto');




  register_post_type( 'taller',
                     
                     array('labels' => array(
      'name' => __('Talleres', 'Taller general name'),
      'singular_name' => __('Taller', 'Taller singular name'),
      'add_new' => __('Add New', 'taller type item'),
      'add_new_item' => __('Añadir Taller'),
      'edit' => __( 'Edit' ),
      'edit_item' => __('Editar Talleres'),
      'new_item' => __('Taller Nuevo'),
      'view_item' => __('Ver Taller'),
      'search_items' => __('Buscar Taller'),
      'not_found' => __('Nothing found in the Database.'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
    ),
                           'description' => __( '' ),
                           'public' => true,
                           'publicly_queryable' => true,
                           'exclude_from_search' => false,
                           'show_ui' => true,
                           'query_var' => true,
                           'menu_position' => 8,
                           'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
                           'rewrite' => true,
                           'capability_type' => 'post',
                           'hierarchical' => false,
                           
                           'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
                           'has_archive' => true	)
                     );



  // creating (registering) the custom type
  
  register_post_type( 'entrada_taller', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
                     // let's now add all the options for this Entrada De Taller
                     array('labels' => array(
      'name' => __('Entradas De Taller', 'Entrada De Taller general name'), /* This is the Title of the Group */
      'singular_name' => __('Entrada De Taller', 'Entrada De Taller singular name'), /* This is the individual type */
      'add_new' => __('Add New', 'entrada de taller type item'), /* The add new menu item */
      'add_new_item' => __('Añadir Entrada De Taller'), /* Add New Display Title */
      'edit' => __( 'Edit' ), /* Edit Dialog */
      'edit_item' => __('Editar Entradas De Talleres'), /* Edit Display Title */
      'new_item' => __('Entrada De Taller Nueva'), /* New Display Title */
      'view_item' => __('Ver Entrada De Taller'), /* View Display Title */
      'search_items' => __('Buscar Entradas De Taller'), /* Search Custom Type Title */
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
                           'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Entrada De Taller type menu */
                           'rewrite' => true,
                           'capability_type' => 'post',
                           'hierarchical' => false,
                           /* the next one is important, it tells what's enabled in the post editor */
                           'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky'),
                           'has_archive' => true	) /* end of options */
                     ); /* end of register Taller */


  register_taxonomy_for_object_type('taller', 'entrada_taller');



















  register_post_type( 'miembro', array(
    'labels' => array(
      'name' => __('Miembro', 'Miembro general name'),
      'singular_name' => __('Miembro', 'Miembro singular name'),
      'add_new' => __('Add New', 'miembro type item'),
      'add_new_item' => __('Añadir Miembro'),
      'edit' => __( 'Edit' ),
      'edit_item' => __('Editar Miembro'),
      'new_item' => __('Miembro Nuevo'),
      'view_item' => __('Ver Miembro'),
      'search_items' => __('Buscar Miembro'),
      'not_found' => __('Nothing found in the Database.'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
    ),
    'description' => __( '' ),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'query_var' => true,
    'menu_position' => 8,
    'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky', 'page-attributes'),
    'has_archive' => true
  ));

























  register_post_type( 'lcc', array(
    'labels' => array(
      'name' => __('LCC', 'LCC general name'),
      'singular_name' => __('Lcc', 'Lcc singular name'),
      'add_new' => __('Add New', 'lcc type item'),
      'add_new_item' => __('Añadir Lcc'),
      'edit' => __( 'Edit' ),
      'edit_item' => __('Editar Lcc'),
      'new_item' => __('Lcc Nuevo'),
      'view_item' => __('Ver Lcc'),
      'search_items' => __('Buscar Lcc'),
      'not_found' => __('Nothing found in the Database.'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
    ),
    'description' => __( '' ),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'query_var' => true,
    'menu_position' => 8,
    'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png',
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'sticky', 'page-attributes'),
    'has_archive' => true
  ));



register_taxonomy_for_object_type('seccion', 'lcc');






  
}


add_action( 'init', 'cpt');



register_taxonomy( 'proyecto', array('proyecto'), array(
  'hierarchical' => true,
  'labels' => array(
    'name' => __( 'Proyecto' ),
    'singular_name' => __( 'Proyecto' ),
    'search_items' => __( 'Buscar Proyecto' ),
    'all_items' => __( 'Todas las Proyectos' ),
    'parent_item' => __( 'Proyecto Superior' ),
    'parent_item_colon' => __( 'Proyecto Superior:' ),
    'edit_item' => __( 'Editar Proyecto' ),
    'update_item' => __( 'Actualizar Proyecto' ),
    'add_new_item' => __( 'Añadir Proyectos' ),
    'new_item_name' => __( 'Nombre de proyecto nuevo' )
  ),
  'show_ui' => true,
  'query_var' => true,
)
);







register_taxonomy( 'seccion', array('seccion'), array(
  'hierarchical' => true,
  'labels' => array(
    'name' => __( 'Seccion' ),
    'singular_name' => __( 'Seccion' ),
    'search_items' => __( 'Buscar Seccion' ),
    'all_items' => __( 'Todas las Secciones' ),
    'parent_item' => __( 'Seccion Superior' ),
    'parent_item_colon' => __( 'Seccion Superior:' ),
    'edit_item' => __( 'Editar Seccion' ),
    'update_item' => __( 'Actualizar Seccion' ),
    'add_new_item' => __( 'Añadir Secciones' ),
    'new_item_name' => __( 'Nombre de seccion nuevo' )
  ),
  'show_ui' => true,
  'query_var' => true,
)
);

























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




// crear taxonomía nueva "proyecto" al crear un nuevo proyecto

add_action( 'publish_proyecto_tim', 'add_proyecto_term' );
function add_proyecto_term( $post_ID ) {
    $post = get_post( $post_ID ); 
    wp_insert_term( $post->post_title, 'proyecto' );
}




?>