<?php

/*
Plugin Name: DM Job Listings
Plugin URI: http://www.designmissoula.com/
Description: This is not just a plugin, it makes WordPress better.
Author: Bradford Knowlton
Version: 1.6
Author URI: http://bradknowlton.com/
*/

add_action( 'init', 'register_cpt_job_listing' );

function register_cpt_job_listing() {

	if(dm_check_user_role('member') || current_user_can('edit_others_pages') ){
		$labels = array(
			'name' => _x( 'Job Listing Categories', 'job_listing_categories' ),
			'singular_name' => _x( 'Job Listing Category', 'job_listing_categories' ),
			'search_items' => _x( 'Search Job Listing Categories', 'job_listing_categories' ),
			'popular_items' => _x( 'Popular Job Listing Categories', 'job_listing_categories' ),
			'all_items' => _x( 'All Job Listing Categories', 'job_listing_categories' ),
			'parent_item' => _x( 'Parent Job Listing Category', 'job_listing_categories' ),
			'parent_item_colon' => _x( 'Parent Job Listing Category:', 'job_listing_categories' ),
			'edit_item' => _x( 'Edit Job Listing Category', 'job_listing_categories' ),
			'update_item' => _x( 'Update Job Listing Category', 'job_listing_categories' ),
			'add_new_item' => _x( 'Add New Job Listing Category', 'job_listing_categories' ),
			'new_item_name' => _x( 'New Job Listing Category', 'job_listing_categories' ),
			'separate_items_with_commas' => _x( 'Separate job listing categories with commas', 'job_listing_categories' ),
			'add_or_remove_items' => _x( 'Add or remove job listing categories', 'job_listing_categories' ),
			'choose_from_most_used' => _x( 'Choose from the most used job listing categories', 'job_listing_categories' ),
			'menu_name' => _x( 'Job Listing Categories', 'job_listing_categories' ),
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'show_admin_column' => false,
			'hierarchical' => true,
			'rewrite' => true,
			'query_var' => true
		);
		register_taxonomy( 'job_listing_categories', array('job_listing'), $args );

		$labels = array(
			'name' => _x( 'Job Listings', 'job_listing' ),
			'singular_name' => _x( 'Job Listing', 'job_listing' ),
			'add_new' => _x( 'Add New', 'job_listing' ),
			'add_new_item' => _x( 'Add New Job Listing', 'job_listing' ),
			'edit_item' => _x( 'Edit Job Listing', 'job_listing' ),
			'new_item' => _x( 'New Job Listing', 'job_listing' ),
			'view_item' => _x( 'View Job Listing', 'job_listing' ),
			'search_items' => _x( 'Search Job Listings', 'job_listing' ),
			'not_found' => _x( 'No job listings found', 'job_listing' ),
			'not_found_in_trash' => _x( 'No job listings found in Trash', 'job_listing' ),
			'parent_item_colon' => _x( 'Parent Job Listing:', 'job_listing' ),
			'menu_name' => _x( 'Job Listings', 'job_listing' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions' ),
			'taxonomies' => array( 'job_listing_categories' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
		);
		register_post_type( 'job_listing', $args );

	}

}

/**
 * Checks if a particular user has a role.
 * Returns true if a match was found.
 *
 * @param string $role Role name.
 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
 * @return bool
 *
 * Source: http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/
 */
function dm_check_user_role( $role, $user_id = null ) {

	if ( is_numeric( $user_id ) )
		$user = get_userdata( $user_id );
	else
		$user = wp_get_current_user();

	if ( empty( $user ) )
		return false;

	return in_array( $role, (array) $user->roles );
} 