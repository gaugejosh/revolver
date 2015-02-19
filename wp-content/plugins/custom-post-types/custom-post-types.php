<?php

/*
Plugin Name: BPCA Custom Post Types
Description: Custom Post Types for the Battery Parks City Authority website.
Author: Erik Dreistadt
Author URI: http://www.revolverstudios.com
*/

// adding the custom post type
add_action( 'init', 'bpca_cpt' );

function bpca_cpt() {

register_post_type( 'leaders', array(
  'labels' => array(
    'name' => 'Leaders',
    'singular_name' => 'Leaders',
   ),
  'description' => 'Holds the Biographies of All Leaders at BPCA.',
  'public' => true,
  'menu_position' => 20,
  'supports' => array( 'title', 'editor', 'thumbnail')
));

register_post_type( 'places', array(
  'labels' => array(
    'name' => 'Places',
    'singular_name' => 'Places',
   ),
  'description' => 'Posts for all the information in the Places section of the BPCA site.',
  'public' => true,
  'menu_position' => 20,
  'supports' => array( 'title', 'editor', 'thumbnail'),
));

register_post_type( 'resident', array(
  'labels' => array(
    'name' => 'Residential',
    'singular_name' => 'Residential',
   ),
  'description' => 'Posts for all the information in the Residential Life section of the BPCA site.',
  'public' => true,
  'menu_position' => 20,
  'supports' => array( 'title', 'editor', 'thumbnail'),
));

register_post_type( 'timeline', array(
  'labels' => array(
    'name' => 'Timeline',
    'singular_name' => 'Timeline',
   ),
  'description' => 'Posts to be placed on the Timeline.',
  'public' => true,
  'menu_position' => 20,
  'supports' => array( 'title', 'editor', 'thumbnail'),
));

register_post_type( 'videos', array(
  'labels' => array(
    'name' => 'Videos',
    'singular_name' => 'Videos',
   ),
  'description' => 'Post Type that has all the embed codes for the meeting videos.',
  'public' => true,
  'menu_position' => 20,
  'menu_icon' => 'dashicons-video-alt2',
  'supports' => array( 'title', 'editor', 'thumbnail'),
));

register_post_type( 'archive_photos', array(
  'labels' => array(
    'name' => 'Archive Photos',
    'singular_name' => 'Archive Photos',
   ),
  'description' => 'Post Type that has all the photos for the archive viewer.',
  'public' => true,
  'menu_position' => 20,
  'menu_icon' => 'dashicons-camera',
  'supports' => array( 'title', 'editor', 'thumbnail'),
));
/*
register_post_type( 'events', array(
  'labels' => array(
    'name' => 'Events',
    'singular_name' => 'Events',
   ),
  'description' => 'Posts for all the information in the Events section of the BPCA site.',
  'public' => true,
  'menu_position' => 20,
  'menu_icon' => 'dashicons-calendar',
  'supports' => array( 'title', 'editor', 'thumbnail'),
));
*/
// for custom post type "places"
register_taxonomy(
        'places_categories',
        'places',
        array(
            'labels' => array(
                'name' => 'Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

// for custom post type "resident"
register_taxonomy(
        'resident_categories',
        'resident',
        array(
            'labels' => array(
                'name' => 'Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
/*
// for custom post type "events"
register_taxonomy(
        'event_categories',
        'events',
        array(
            'labels' => array(
                'name' => 'Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );*/
}

// leadership table headers with sorting

// build the leader header
function bpca_leaders_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'leader_order' 	=> 'Leader Order',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

// show the custom field for the order that the leader appears on the Leadership Page
function bpca_leaders_custom_columns($column)
{
        if($column == 'leader_order')
	{
            echo get_field('leader_order');
	}
}

// make the columns sortable
function bpca_leaders_column_register_sortable( $columns )
{
	$columns['leader_order'] = 'leader_order';
	return $columns;
}

// make the leader order column properly sort
function bpca_leaders_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'leader_order' == $orderby ) {
        $query->set('meta_key','leader_order');
        $query->set('orderby','meta_value_num');
    }
}

add_action( 'pre_get_posts', 'bpca_leaders_orderby' );
add_action("manage_posts_custom_column", "bpca_leaders_custom_columns");
add_filter("manage_edit-leaders_columns", "bpca_leaders_page_columns");
add_filter("manage_edit-leaders_sortable_columns", "bpca_leaders_column_register_sortable" );

// places table headers with sorting

// build the places header
function bpca_places_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'places_page_order' 	=> 'Page Order',
                'places_categories'  => 'Category',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

// show the custom field for the order that the place appears on whatever places page is used
function bpca_places_custom_columns($column)
{
        if($column == 'places_page_order')
	{
            echo get_field('places_page_order');
	} elseif ($column == 'places_categories') {
            $postterms = wp_get_post_terms( get_the_ID(), 'places_categories', true );
            echo $postterms[0]->name;
        }
}

// make the columns sortable
function bpca_places_column_register_sortable( $columns )
{
	$columns['places_page_order'] = 'places_page_order';
	return $columns;
}

// make the places order column properly sort
function bpca_places_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'places_page_order' == $orderby ) {
        $query->set('meta_key','places_page_order');
        $query->set('orderby','meta_value_num');
    }
}

// add a category filter
function bpca_places_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'places' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Categories',
            'taxonomy' => 'places_categories',
            'name' => 'places_categories',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['places_categories'] ) ? $wp_query->query['places_categories'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => true,
            'hide_empty' => true,
        ) );
    }
}

// filter by selected category
function bpca_places_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( ( $qv['places_categories'] ) && is_numeric( $qv['places_categories'] ) ) {
        $term = get_term_by( 'id', $qv['places_categories'], 'places_categories' );
        $qv['places_categories'] = $term->slug;
    }
}

add_action( 'pre_get_posts', 'bpca_places_orderby' );
add_action("manage_posts_custom_column", "bpca_places_custom_columns");
add_action( 'restrict_manage_posts', 'bpca_places_filter_list' );
add_filter( 'parse_query','bpca_places_filtering' );
add_filter("manage_edit-places_columns", "bpca_places_page_columns");
add_filter("manage_edit-places_sortable_columns", "bpca_places_column_register_sortable" );

// photo archive table headers with sorting

// build the leader header
function bpca_archive_photos_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'photo_order' 	=> 'Photo Order',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

// show the custom field for the order that the leader appears on the Leadership Page
function bpca_archive_photos_custom_columns($column)
{
        if($column == 'photo_order')
	{
            echo get_field('photo_order');
	}
}

// make the columns sortable
function bpca_archive_photos_column_register_sortable( $columns )
{
	$columns['photo_order'] = 'photo_order';
	return $columns;
}

// make the leader order column properly sort
function bpca_archive_photos_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'photo_order' == $orderby ) {
        $query->set('meta_key','photo_order');
        $query->set('orderby','meta_value_num');
    }
}

add_action( 'pre_get_posts', 'bpca_archive_photos_orderby' );
add_action("manage_posts_custom_column", "bpca_archive_photos_custom_columns");
add_filter("manage_edit-archive_photos_columns", "bpca_archive_photos_page_columns");
add_filter("manage_edit-archive_photos_sortable_columns", "bpca_archive_photos_column_register_sortable" );

// build the resident header
function bpca_resident_page_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Title',
		'resident_page_order' 	=> 'Page Order',
                'resident_categories'  => 'Category',
		'author'	=>	'Author',
		'date'		=>	'Date',
	);
	return $columns;
}

// show the custom field for the order that the resident appears on whatever resident page is used
function bpca_resident_custom_columns($column)
{
        if($column == 'resident_page_order')
	{
            echo get_field('resident_page_order');
	} elseif ($column == 'resident_categories') {
            $postterms = wp_get_post_terms( get_the_ID(), 'resident_categories', true );
            echo $postterms[0]->name;
        }
}

// make the columns sortable
function bpca_resident_column_register_sortable( $columns )
{
	$columns['resident_page_order'] = 'resident_page_order';
	return $columns;
}

// make the resident order column properly sort
function bpca_resident_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'places_page_order' == $orderby ) {
        $query->set('meta_key','resident_page_order');
        $query->set('orderby','meta_value_num');
    }
}

// add a category filter
function bpca_resident_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'resident' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Categories',
            'taxonomy' => 'resident_categories',
            'name' => 'resident_categories',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['resident_categories'] ) ? $wp_query->query['resident_categories'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => true,
            'hide_empty' => true,
        ) );
    }
}

// filter by selected category
function bpca_resident_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( ( $qv['resident_categories'] ) && is_numeric( $qv['resident_categories'] ) ) {
        $term = get_term_by( 'id', $qv['resident_categories'], 'resident_categories' );
        $qv['resident_categories'] = $term->slug;
    }
}

add_action( 'pre_get_posts', 'bpca_resident_orderby' );
add_action("manage_posts_custom_column", "bpca_resident_custom_columns");
add_action( 'restrict_manage_posts', 'bpca_resident_filter_list' );
add_filter( 'parse_query','bpca_resident_filtering' );
add_filter("manage_edit-resident_columns", "bpca_resident_page_columns");
add_filter("manage_edit-resident_sortable_columns", "bpca_resident_column_register_sortable" );
