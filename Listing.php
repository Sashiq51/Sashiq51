<?php
   /*
   Plugin Name: Listing
   Plugin URI: https://twitter.com
   description: >-This is simple listening plugin
   Version: 6.01.2
   Author: Salman Ashiq
   Author URI: https://mrtotallyawesome.com
   License: GPL2
   */
  
?>
<?php
function listing_post_type() {
    register_post_type('listing',
        array(
            'labels' => array(
                'name' => __( 'listing' ),
                'singular_name' => __( 'list' )
            ),
            'public' => true,

            'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite'   => array( 'slug' => 'listing' ),
            'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-post',
        'taxonomies' => array('country', 'features') // this is IMPORTANT
        )
    );
}
add_action( 'init', 'listing_post_type' );
//country features
//// Add country taxonomy
function create_listing_taxonomy() {
    register_taxonomy('country','listing',array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x( 'country', 'taxonomy general name' ),
            'singular_name' => _x( 'country', 'taxonomy singular name' ),
            'menu_name' => __( 'country' ),
            'all_items' => __( 'All country' ),
            'edit_item' => __( 'Edit country' ),
            'update_item' => __( 'Update country' ),
            'add_new_item' => __( 'Add country' ),
            'new_item_name' => __( 'New country' ),
        ),
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    ));
    register_taxonomy('features','listing',array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x( 'features', 'taxonomy general name' ),
            'singular_name' => _x( 'features', 'taxonomy singular name' ),
            'menu_name' => __( 'features' ),
            'all_items' => __( 'All features' ),
            'edit_item' => __( 'Edit features' ),
            'update_item' => __( 'Update features' ),
            'add_new_item' => __( 'Add features' ),
            'new_item_name' => __( 'New features' ),
        ),
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    ));
}
add_action( 'init', 'create_listing_taxonomy', 0 );
/////////////////////
function hcf_register_meta_boxes() {
    add_meta_box( 'hcf-1', __( 'Custom Data', 'hcf' ), 'hcf_display_callback', 'listing' );
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );?>
<?php
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './form.php';
}
?>
<?php
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'hcf_author',
        'hcf_choose',
        'hcf_coments',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'hcf_save_meta_box' );


function tax2_shortcode() {
    $new = get_terms([
      'taxonomy' => 'country',
      'hide_empty' => false,
    ]);
    $terms = get_terms([
        'taxonomy' => 'features',
        'hide_empty' => false,
      ]);
      
    $search_form =  "";
    $search_form .= '<form method="post" id="search-form" action="">
    <select id="cntry" name="cntry">';
    $search_form.='<option value="">Choose country</option>';
    foreach ($new as $term){
  $search_form .= '<option value="'. $term->name .'">'.$term->name.'</option>';
    } 

    $search_form .='</select>
    
    <select id="feature" name="feature">
    <option value="">Choose features</option>';
      foreach ($terms as $term){
    $search_form .= '<option value="'. $term->name .'">'.$term->name.'</option>';
    }
    $search_form .='</select>
  <input type="text" name="search" id="search" placeholder="Search..">
      <input type="submit" name="submit" value="submit">
      </form>
    ';
      return $search_form;
  }


add_shortcode('tax2', 'tax2_shortcode');




