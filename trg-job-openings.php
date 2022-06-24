<?php
/*
Plugin Name: Job Openings and Applications
Description: Adds a custom post type for Job Openings and the ability for website visitors apply for jobs.
Author: Tom Greer
Author URI: http://trgwebdesigns.com
*/

/**
 * Register the Job Opening custom post type
 */
function trg_job_opening_cpt() {
    register_post_type( 'trg_job_opening', 
        array(
            'labels' => array(
                'name'               => 'Job Openings',
                'singular_name'      => 'Job Opening',
                'menu_name'          => 'Job Openings',
                'name_admin_bar'     => 'Job Opening',
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Job Opening',
                'new_item'           => 'New Job Opening',
                'edit_item'          => 'Edit Job Opening',
                'view_item'          => 'View Job Opening',
                'all_items'          => 'All Job Openings',
                'search_items'       => 'Search Job Openings',
                'not_found'          => 'No Job Openings found.',
                'not_found_in_trash' => 'No Job Openings found in Trash.'
            ),
        'description' => 'Job openings',
        'public' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-id',
        'has_archive' => false,
        'rewrite' => array(
            'slug' => 'job_opening',
            'with_front' => false,
        ),
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'page-attributes', )
        )
    );
}

add_action( 'init', 'trg_job_opening_cpt' );

/**
 * Register the Job Category Taxonomy
 */
function trg_job_category_taxonomy() {
    register_taxonomy( 'trg_job_category', 'trg_job_opening', 
        array(
            'hierarchical' => true,
            'labels' => array(
                'name'               => 'Job Category',
                'singular_name'      => 'Job Category',
                'menu_name'          => 'Job Categories',
                'name_admin_bar'     => 'Job Category',
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Job Category',
                'new_item'           => 'New Job Category',
                'edit_item'          => 'Edit Job Category',
                'view_item'          => 'View Job Category',
                'all_items'          => 'All Job Categories',
                'search_items'       => 'Search Job Categories',
                'parent_item_colon'  => 'Parent Job Categories:',
                'not_found'          => 'No Job Categories found.',
                'not_found_in_trash' => 'No Job Categories found in Trash.'
            ),
            'query_var' => true,
            'rewrite' => array(
            'slug' => 'job_category',
            'with_front' => false
            )
        )
    );
}
add_action( 'init', 'trg_job_category_taxonomy');

/**
 * On plugin installation, we need to flush the rewrite rules after registering new custom post types.
 */
function trg_job_openings_activate() {
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'trg_job_openings_activate' );

/**
 * Add Apply Now button to bottom of Job Opening posts 
 */
function trg_add_apply_now_button( $content ) {
	global $post;
	$href = get_site_url() . '/job-application/?job_title=' . urlencode( $post->post_title );
	$button = "<div class=\"et_pb_button_module_wrapper job-apply\"><a class=\"et_pb_button\" href=\"$href\">Apply Now</a></div>"; 
	if( is_singular( 'trg_job_opening' ) ) {
		$content .= $button;
	}
		return $content;
}
add_filter('the_content','trg_add_apply_now_button');

?>