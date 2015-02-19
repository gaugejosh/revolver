<?php
/*
Plugin Name: My Carousel
Plugin URI: http://taraprasad.com/wordpress/mycarousel/
Description: A carousel Plugin for Wordpress.
Version: 1.1.0
Author: NT Company
Author URI: http://www.taraprasad.com

Copyright 2012 by NT Company (email : ntcomp.themeforest@gmail.com)
*/

include('config.php');

add_action('init', 'create_my_post_type');

add_action('save_post', 'com_my_save_metaa');

add_action('admin_init', 'com_register_my_meta_box');

add_shortcode('mycarousel', 'mycarousel_func' );

add_filter( 'enter_title_here', 'change_default_my_title' );

add_filter('manage_edit-mycarousel_columns', 'set_custom_edit_mycarousel_columns' );

add_action('manage_mycarousel_posts_custom_column' , 'custom_mycarousel_column', 10, 2 );

add_action('wp_enqueue_scripts', 'my_scripts_method');

remove_filter( 'the_content', 'wpautop' );

add_filter( 'the_content', 'wpautop' , 12);

function is_my_nggal_there() {
	$plugins = get_plugins('/nextgen-gallery');
	if($plugins) return true;
	
	return false;
}

function is_my_nggal_active() {
	if(is_plugin_active('nextgen-gallery/nggallery.php')) {
		return true;
	}
	return false;
}

function check_my_nggal() {
	if(is_my_nggal_there()) {
		if(!is_my_nggal_active()) {
			echo "Please activate nextgen-gallery plugin";
		}else {
			return;
		}
	}else {
		echo "Please install nextgen-gallery plugin<br />http://wordpress.org/extend/plugins/nextgen-gallery/";
	}
	exit();
}

function my_scripts_method() {
	wp_enqueue_script('mycarousel', plugins_url('js/jquery.mycarousel.min.js', __FILE__), array('jquery'));
	wp_enqueue_script('imageloaded', plugins_url('js/jquery.imagesloaded.min.js', __FILE__), array('jquery'));
	wp_enqueue_script('easing', plugins_url('js/jquery.easing.min.js', __FILE__), array('jquery'));
	wp_enqueue_script('easingCompatible', plugins_url('js/jquery.easing.compatibility.js', __FILE__), array('jquery'));
	wp_enqueue_script('mousewheel', plugins_url('js/jquery.mousewheel.js', __FILE__), array('jquery'));
	wp_enqueue_script('touchSwipe', plugins_url('js/jquery.touchSwipe.min.js', __FILE__), array('jquery'));
	
	wp_enqueue_style('styles', plugins_url('css/mycarousel.css', __FILE__));
}

function set_custom_edit_mycarousel_columns($columns) {
	$tempdate = $columns['date'];
	unset($columns['date']);
	return $columns + array('short_code' => __('Short Code'), 'date'=> $tempdate);
}

function custom_mycarousel_column( $column, $post_id ) {
    switch($column) {
      case 'short_code':
        echo '<input type="text" onclick="this.select();" value="[mycarousel id='.$post_id.']" />';
        break;
    }
}

function com_my_save_metaa($postId) {
	$screen = get_current_screen();
	
	if($screen->post_type=='mycarousel' and isset($_POST)) {
		//update_post_meta($postId, 'title_text', $_POST['title_text']);
		
		global $dbkeys;
		
		foreach($dbkeys as $key) {
			if(isset($_POST[$key])) {
				update_post_meta($postId, $key, $_POST[$key]);
			}else {
				update_post_meta($postId, $key, '');
			}
		}
	}
}

function com_register_my_meta_box() {
	wp_enqueue_style('styles', plugins_url('/css/mycarousel.css', __FILE__));
	add_meta_box('mycarousel_meta', __('Carousel Options'), 'mycarousel_meta', 'My Carousel', 'normal', 'high');
}

function mycarousel_meta() {
	include('admin-views/mycarousel-meta.php');
}

/*
 * Creating Admin Menus
 */
function create_my_post_type() {
	register_post_type( 'My Carousel',
	array(
      'labels' => array(
        'name' => __( 'Carousel' ),
		'add_new_item' => __('Add New Carousel'),
        'singular_name' => __( 'Menu item' )
	),
	'public' => true,
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'menu_position'=> 5,
	'supports' => array( 'title', 'page-attributes', 'thumbnail'),
	'rewrite' => false
	)
	);
	
	register_taxonomy(
		'mycarousel_category',
		'post',
		array(
			'labels' => array(
			'name' => _x( 'Category', 'taxonomy general name' ),
			'search_items' =>  __( 'Search Content Slides' ),
			'all_items' => __( 'All Content Slides' ),
			'parent_item' => __( 'Parent Slide' ),
			'parent_item_colon' => __( 'Parent Slide:' ),
			'edit_item' => __( 'Edit Slide' ),
			'update_item' => __( 'Update Slide' ),
			'add_new_item' => __( 'Add New Slide' ),
			'new_item_name' => __( 'New Slide Name' ),
			'menu_name' => __( 'Category' ),
		),
		'public' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud' => false,
		'show_admin_column'=>false,
		'hierarchical'=>true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'Content Slides', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
		)
		)
	);
	
	register_post_type( 'Content Slides',
	array(
      'labels' => array(
        'name' => __( 'Content Carousel' ),
		'add_new_item' => __('Add New Slide'),
        'singular_name' => __( 'Menu item' )
	),
	'taxonomies' => array('mycarousel_category'),
	'public' => true,
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'menu_position'=> 5,
	'supports' => array( 'title', 'editor', 'page-attributes'),
	'rewrite' => false
	)
	);
}

function mycarousel_func($atts) {
	$postid = (int)$atts['id'];
	
	ob_start();
	if($postid>0) {
		$post = get_post($postid);
		if($post->post_type=='mycarousel') {
			include('views/mycarousel.php');
		}else {
			
		}
	}
	$string = ob_get_contents();
	ob_end_clean();
	return $string;
}

function change_default_my_title( $title ){
	$screen = get_current_screen();

	if($screen->post_type == 'mycarousel') {
		$title = 'Enter Carousel Name';
	}
	
	return $title;
}

function show($val) {
	if(is_array($val) or is_object($val)) {
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}else {
		echo $val;
	}
}

function generate_checkbox($name, $value, $check) {
	$selected = '';
	if($check==$value) {
		$selected = ' checked="checked"';
	}
	return '<input type="checkbox" name="'.$name.'" id="'.$name.'" value="'.$value.'"'.$selected.' />';
}

function generate_textbox($name, $value='', $param='') {
	return '<input type="text" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$param.' />';
}

function check_percentage($val='') {
	if($val=='') return;
	
	if(substr($val, -1)=='%') {
		return $val;
	}else {
		return $val."px";
	}
}
?>