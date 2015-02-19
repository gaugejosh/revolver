<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bpca-master
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <?php
                    // link to depends on the post type
               // echo get_post_type() . "<br />";
                $sendto = "";
                    switch (get_post_type()) {
                        case 'leaders':
                            $sendto = "/about-2/leadership?id=" . get_the_ID() . "#bio-area-box-" . get_the_ID();
                            break;
                        case 'places':
                            $category = get_the_terms(get_the_ID(), 'places_categories');
                            //print_r($category);
                            //echo $category[0]->name;
                            $thiscat = "";
                            foreach ($category as $catslug) {
                                // only grab the primary category
                                $thiscat = $catslug->slug;
                                break;
                            }
                            $sendto = "/places-2/";
                            switch ($thiscat) {
                                case 'get-around':
                                    $sendto .= "get-around";
                                    break;
                                case 'museums-memorials':
                                    $sendto .= "museums-memorials";
                                    break;
                                case 'parks':
                                    $sendto .= "parks";
                                    break;
                                case 'public-art':
                                    $sendto .= "public-art-libraries";
                                    break;
                                case 'public-spaces':
                                    $sendto .= "public-spaces";
                                    break;
                            }
                            $sendto .= "#descr-area-box-" . get_the_ID();
                            break;
                        case 'resident':
                            $sendto = "/residential-life/";
                            $category = get_the_terms(get_the_ID(), 'resident_categories');
                            $thiscat = "";
                            foreach ($category as $catslug) {
                                // only grab the primary category
                                $thiscat = $catslug->slug;
                                break;
                            }
                            switch($thiscat) {
                                case 'buildings':
                                case 'apartments':
                                case 'apt-green':
                                case 'condos':
                                case 'condo-green':
                                    $sendto .= "buildings";
                                    break;
                                case 'schools':
                                    $sendto .= "schools";
                                    break;
                            }
                            $sendto .= "#descr-area-box-" . get_the_ID();
                            break;
                        case 'attachment':
                            $sendto = get_the_guid();
                            break;
                        case 'tribe_events':
                            $sendto = "/news/events#descr-area-box-" . get_the_ID();
                            break;
                        case 'timeline':
                            $sendto = "/about-2/who-we-are";
                            break;
                    }
                ?>
                <?php
                    if ($sendto != "") {
                        if (get_post_type() == "attachment") {
                            the_title( sprintf( '<div class="search-res-title"><a href="%s" rel="bookmark" target="_blank">', esc_url($sendto) ), '</a></div>' );
                            echo "FILE";
                        } else {
                            the_title( sprintf( '<div class="search-res-title"><a href="%s" rel="bookmark">', esc_url($sendto) ), '</a></div>' );
                            the_excerpt();
                        }
                        
                    } else {
                        the_title( sprintf( '<div class="search-res-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></div>' );
                        the_excerpt();
                    }
                ?>
        </header><!-- .entry-header -->

	
		
</article><!-- #post-## -->
