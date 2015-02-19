<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package bpca-master
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ny_favicon_100-01.ico" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bpca-master' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
            <div class="header-container">
                <div id="nygov-universal-navigation" class="nygov-universal-container" data-iframe="true" data-updated="2014-11-07 08:30">
    <noscript>
        <iframe width="100%" height="86px" src="//static-assets.ny.gov/load_global_menu/ajax?iframe=true" frameborder="0" style="border:none; overflow:hidden; width:100%; height:86px;" scrolling="no">
            Your browser does not support iFrames
        </iframe>
    </noscript>
    <script type="text/javascript">
        var _NY = {
            HOST: "static-assets.ny.gov",
            BASE_HOST: "www.ny.gov",
            hideSettings: false,
            hideSearch: true
        };
        (function (document, bundle, head) {
            head = document.getElementsByTagName('head')[0];
            bundle = document.createElement('script');
            bundle.type = 'text/javascript';
            bundle.async = true;
            bundle.src = "//static-assets.ny.gov/sites/all/widgets/universal-navigation/js/dist/global-nav-bundle.js";
            head.appendChild(bundle);
        }(document));
    </script>
</div>
                <div class="header-bottom-container">
                    <div class="header-bottom-logo">
                            <div class="head-logo-light">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    HUGH L. CAREY
                                </a>
                            </div>
                            <div class="head-logo-bold">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    BATTERY PARK CITY<br />AUTHORITY
                                </a>
                            </div>
                    </div>
                    <div class="header-bottom-nav-area">
                       <nav id="site-navigation" class="main-navigation2" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><i class="fa fa-bars fa-2x"></i>
</button>
                        <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
		</nav><!-- #site-navigation -->
                <!--<div class="search-logo">
                    &nbsp;
                </div>-->
                <div class="search-icon">
                    
                </div>
                <div class="search-area">
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <img class="closed" id="search-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/search_icon.jpg" />
                            <label>
                	        <span class="screen-reader-text">Search for:</span>
                	        <input type="search" id="site-search" class="search-field" placeholder="" value="" name="s" title="Search for:" />                	    
                            </label>
                            <input type="submit" class="search-submit" value="Search" />
                        </form>
                    </div>
                    </div>
                    <!--
                    -->
                    <!-- <div class="search-bar">
                            <i class="fa fa-search"></i>
                    </div>-->
                </div>
                </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">