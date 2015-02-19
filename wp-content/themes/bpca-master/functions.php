<?php
/**
 * bpca-master functions and definitions
 *
 * @package bpca-master
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bpca_master_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bpca_master_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bpca-master, use a find and replace
	 * to change 'bpca-master' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bpca-master', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bpca-master' ),
                'secondary' => __('Secondary Menu', 'bpca-maser'),
                'footer' => __('Footer Menu', 'bpca-master'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bpca_master_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
        
        // support featured images
        add_theme_support('post-thumbnails');
        
        // allow shortcode in widgets
        add_filter( 'widget_text', 'shortcode_unautop');
        add_filter( 'widget_text', 'do_shortcode');
}
endif; // bpca_master_setup
add_action( 'after_setup_theme', 'bpca_master_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bpca_master_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bpca-master' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bpca_master_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bpca_master_scripts() {
	wp_enqueue_style( 'bpca-master-style', get_stylesheet_uri() );
        wp_enqueue_style( 'bpca-master-tablet-style', get_template_directory_uri() . '/tablet-styles.css', array(), '', 'screen and (max-width: 1024px)');
        wp_enqueue_style( 'bpca-master-phone-style', get_template_directory_uri() . '/phone-styles.css', array(), '', 'screen and (max-width: 414px)');
        wp_enqueue_style( 'bpca-master-calendario-main-style', get_template_directory_uri() . '/calendar.css');
        wp_enqueue_style( 'bpca-master-calendario-style', get_template_directory_uri() . '/custom_2.css');
        wp_enqueue_style( 'bpca-master-icheck-style', get_template_directory_uri() . '/js/iCheck/skins/minimal/minimal.css');
        wp_enqueue_style( 'bpca-master-flexslider-style', get_template_directory_uri() . '/js/FlexSlider/flexslider.css');

	wp_enqueue_script( 'bpca-master-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
        
        // jquery + jquery EasyTabs
        wp_enqueue_script( 'bpca-master-jquery', get_template_directory_uri() . '/js/vendor/jquery-1.11.2.min.js', array(), '1.7.1', false );
        //wp_enqueue_script( 'bpca-master-jquery-ui', get_template_directory_uri() . '/js/vendor/jquery-ui.js', array(), '1.7.1', false );
        //wp_enqueue_script('jquery');
        wp_enqueue_script( 'bpca-master-jquery-easytabs', get_template_directory_uri() . '/js/lib/jquery.easytabs.js', array(), '20140115', false );
        wp_enqueue_script( 'bpca-master-jquery-hashchange', get_template_directory_uri() . '/js/vendor/jquery.hashchange.min.js', array(), '20140115', false );
        
	wp_enqueue_script( 'bpca-master-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        /* fullcalendar */
        //wp_enqueue_script( 'bpca-master-fullcalendar-moment', get_template_directory_uri() . '/js/moment.min.js', array(), '20150122', false);
        //wp_enqueue_script( 'bpca-master-fullcalendar', get_template_directory_uri() . '/js/fullcalendar.js', array('jquery'), '20150122', false);
        
        /*Calendario*/
        wp_enqueue_script(' bpca-master-calendario-dependent ', get_template_directory_uri() . '/js/modernizr.custom.63321.js', array('jquery'), '20150122', false);
        wp_enqueue_script(' bpca-master-calendario ', get_template_directory_uri() . '/js/jquery.calendario.js', array('jquery'), '20150122', false);
        /*iCheck*/
        //wp_enqueue_script(' bpca-master-icheck ', get_template_directory_uri() . '/js/iCheck/icheck.js', array('jquery'), '1.0.1', false);
        /*jPages*/
        wp_enqueue_script(' bpca-master-jpages ', get_template_directory_uri() . '/js/jPages/js/jPages.min.js', array('jquery'), '3.0.1', false);
       /*FlexSlider*/
        wp_enqueue_script(' bpca-master-flexslider ', get_template_directory_uri() . '/js/FlexSlider/jquery.flexslider-min.js', array('jquery'), '2.0', false);
        /*FlexSlider Navigation*/
        //wp_enqueue_script(' bpca-master-flexslider-nav ', get_template_directory_uri() . '/js/FlexSlider/jquery.flexslider.manualDirectionControls.js', array('jquery'), '2.0', false);
        /*jPaginate*/
        //wp_enqueue_script(' bpca-master-jpaginate ', get_template_directory_uri() . '/js/jPaginate.js', array('jquery'), '3.0.1', false);
        
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bpca_master_scripts' );

// loads necessary fonts from google fonts
/*
function load_fonts() {
            // google fonts
            wp_register_style('et-googleFonts', 'http://fonts.googleapis.com/css?family=Montserrat:400,700|Oswald:400,700');
            wp_enqueue_style( 'et-googleFonts');
            
        }
add_action('wp_print_styles', 'load_fonts');
*/
//* Load Font Awesome
function enqueue_font_awesome() {
wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
} 
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );

/* WIDGET AREAS */
// First Footer Widget Area
function footer1_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'footer_1',
                'description' => 'Footer Area 1',
		'before_widget' => '<div id="footer-widget-block">',
		'after_widget' => '</div>',
		'before_title' => '<span id="footer-widget-title" class="rounded">',
		'after_title' => '</span>',
	) );
}
add_action( 'widgets_init', 'footer1_widgets_init' );

// Second Footer Widget Area
function footer2_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'footer_2',
                'description' => 'Footer Area 2',
		'before_widget' => '<div id="footer-widget-block">',
		'after_widget' => '</div>',
		'before_title' => '<span id="footer-widget-title" class="rounded">',
		'after_title' => '</span>',
	) );
}
add_action( 'widgets_init', 'footer2_widgets_init' );

// Third Footer Widget Area
function footer3_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'footer_3',
                'description' => 'Footer Area 3',
		'before_widget' => '<div id="footer-widget-block">',
		'after_widget' => '</div>',
		'before_title' => '<span id="footer-widget-title" class="rounded">',
		'after_title' => '</span>',
	) );
}
add_action( 'widgets_init', 'footer3_widgets_init' );

// Home Page Leadership Block Widget Area
function home_leader_block_widgets_init() {

	register_sidebar( array(
		'name' => 'Home Page - Leadership Block',
		'id' => 'home_blockrow1_block3',
                'description' => 'Widget Specifically for the Leadership Block on the Homepage',
		'before_widget' => '<div id="leader-widget-block">',
		'after_widget' => '</div>',
		'before_title' => '<h2 id="leader-widget-title" class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'home_leader_block_widgets_init' );

// Home Page Twitter Widget Area
function home_twitter_widgets_init() {

	register_sidebar( array(
		'name' => 'Home Page - Twitter Widget Block',
		'id' => 'home_twitter',
                'description' => 'Widget Specifically for the Twitter Widget Block on the Homepage',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'home_twitter_widgets_init' );

// Home Page Instagram Widget Area
function home_instagram_widgets_init() {

	register_sidebar( array(
		'name' => 'Home Page - Instagram Widget Block',
		'id' => 'home_instagram',
                'description' => 'Widget Specifically for the Instagram Widget Block on the Homepage',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'home_instagram_widgets_init' );

// Teaser Set 1 Widget Area
function teaser1_widgets_init() {

	register_sidebar( array(
		'name' => 'Teasers Set 1',
		'id' => 'teasers_set_1',
                'description' => 'Widget Specifically for the first teaser set.',
		'before_widget' => '<div class="teaser-sets">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'teaser1_widgets_init' );

// Teaser Set 2 Widget Area
function teaser2_widgets_init() {

	register_sidebar( array(
		'name' => 'Teasers Set 2',
		'id' => 'teasers_set_2',
                'description' => 'Widget Specifically for the second teaser set.',
		'before_widget' => '<div class="teaser-sets">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'teaser2_widgets_init' );

// Teaser Set 3 Widget Area
function teaser3_widgets_init() {

	register_sidebar( array(
		'name' => 'Teasers Set 3',
		'id' => 'teasers_set_3',
                'description' => 'Widget Specifically for the third teaser set.',
		'before_widget' => '<div class="teaser-sets">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'teaser3_widgets_init' );

// Links Widget Area 1
function links_widgets_init() {

	register_sidebar( array(
		'name' => 'Links Area 1',
		'id' => 'links_area',
                'description' => 'Widget Specifically for the Links page.',
		'before_widget' => '<div class="links-area">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'links_widgets_init' );

// Links Widget Area 2
function links_widgets2_init() {

	register_sidebar( array(
		'name' => 'Links Area 2',
		'id' => 'links_area2',
                'description' => 'Widget Specifically for the Links page.',
		'before_widget' => '<div class="links-area2">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'links_widgets2_init' );

// board committee widget area
function board_widgets_init() {

	register_sidebar( array(
		'name' => 'Board Committees',
		'id' => 'board_area',
                'description' => 'Widget Specifically for the Board Committees.',
		'before_widget' => '<div class="board-commit-area">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="board-commit-head">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'board_widgets_init' );

/* Filters For Post Excerpts */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
* Custom functions that act independently of the theme templates
*/
require get_template_directory() . '/inc/tweaks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* CUSTOM FUNCTIONS ON PAGES */

// count the number of lines in a text div
function countTextInDiv($senttext, $charwidth, $divwidth) {
    $wrappedContent = wordwrap($senttext, ($divwidth / $charwidth), "\r\n");
    $explodedLines = explode("\r\n", $wrappedContent); 
    $nbOfLine = count($explodedLines);

    return $nbOfLine;
}