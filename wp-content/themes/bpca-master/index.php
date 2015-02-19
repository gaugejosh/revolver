<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bpca-master
 */
// get the two swappable homepage images
$homepagefull = "";
$homepage800 = "";
$cat1 = "";
$cat2 = "";
if (is_mobile()) {
    $cat1 = "homepage-mobile";
    $cat2 = "homepage-800-mobile";
} else {
    $cat1 = "homepage-fullwidth";
    $cat2 = "homepage-800";
}
$args = array( 'post_type' => 'attachment',
                               'post_status' => 'inherit',
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => $cat1,
                                        ),
                                ),
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        $homepagefull = get_the_guid();
                        endwhile;
                        
                        $args = array( 'post_type' => 'attachment',
                               'post_status' => 'inherit',
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => $cat2,
                                        ),
                                ),
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        $homepage800 = get_the_guid();
                        endwhile;
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
                    <div>&nbsp;</div>
                    <div class="main-image" style="margin-bottom: -8px">
                        <img src="<?=$homepagefull;?>" />
                           <div class="main-image-link">
                               <div class="main-image-link-text">
                                   <a href="/about-2/who-we-are">
                                   READ MORE ABOUT WHO WE ARE</a>
                               </div>
                            </div> 
                    </div>
                    <!--<div class="main-row-1"> -->
                        <div class="main-row-1-col-1">
                            <div class="mr1c1-text-block">
                                <div class="mr1c1-head-text">
                                    NEED A BATTERY PARK CITY PERMIT?
                                </div>
                                <div class="mr1c1-sub-text">
                                    VISIT OUR NEW PERMIT PAGE TO GET STARTED!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="/apply/permits">READ MORE</a>
                            </div>
                        </div>
                        <div class="main-row-1-col-2">
                            <div class="gallery-container">          
                                <div class="gallery">
                                    <div class="slider">
                                        <ul>
                                            <li>
                                                <div class="slides">
                                                    <div class="slides_content">
                                                        <div class="social-block-slider">
                                                            <a href="https://twitter.com/bpca_ny" target="_blank" class="social-icon-link"><i class="fa fa-twitter fa-3x"></i></a>&nbsp;&nbsp;
                                                            <a href="https://www.facebook.com/bpca.ny" target="_blank" class="social-icon-link"><i class="fa fa-facebook fa-3x"></i></a> &nbsp;&nbsp;
                                                            <!-- <a href="http://instagram.com/bpca_ny" target="_blank" class="social-icon-link"><i class="fa fa-instagram fa-3x"></i></a>-->
                                                            <br /><br /><br />
                                                            <p class="html-slider-text" id="social-slide">Stay in the loop with social media</p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="slides">
                                                    <div class="slides_content">
                                                        <div class="social-block-slider">
                                                            <!--
                                                            <form method="post" action="http://bpca.revolverbranding.com/wp-content/plugins/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">
                                                            <div>
                                                            <input class="newsletter-email" type="email" name="ne" size="100" placeholder=" ENTER EMAIL ADDRESS" required></div><br />
                                                            <div class="news-button">
                                                                    <input class="newsletter-submit" type="submit" value="SIGN UP"/>
                                                            </div>
                                                            </form>-->
                                                            <form id="sf_widget_constantcontact_2_form" class="constantcontactwidget_form" onsubmit="return sf_widget_constantcontact_2_submit(this);">
                                                            <input type="hidden" value="General Interest" name="grp">
                                                            <input class="input" type="text" placeholder="ENTER EMAIL ADDRESS" name="eml">
                                                            <input type="submit" value="SIGN UP">
                                                            </form>
                                                            <script>
                                                                function sf_widget_constantcontact_2_submit(n){for(var a=n.querySelectorAll("input"),i=0,eml=false,val=["action=constantcontactadd"];i<a.length;i++)if(a[i].name){if(a[i].name=="req"){if(!a[i].checked){alert("Consent required");return false;}}else{if(!(a[i].name!="eml"||!a[i].value))eml=true;val.push(a[i].name+"="+encodeURIComponent(a[i].value));}}if(!eml){alert("Please enter an email address");return false;}var xml=new XMLHttpRequest();xml.open("POST","http://bpca.revolverbranding.com/wp-admin/admin-ajax.php",true);xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");xml.onreadystatechange=function(){if(this.readyState==4){if(this.status==200){if(this.responseText)alert(this.responseText);else n.innerHTML="<input type=\"text\" name=\"eml\" class=\"input\" placeholder=\"ENTER EMAIL ADDRESS\"><input type=\"submit\" value=\"Submit\"><div class=\"yay\">Thank You For Subscribing!</div>";}else alert(this.statusText);}};xml.send(val.join(String.fromCharCode(38)));return false;}
                                                                </script>
                                                            <p class="html-slider-text" id="news-slide">Stay informed by signing up for our newsletter</p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="slides">
                                                    <div class="slides_content">
                                                        <div class="bpcp-block-slider">
                                                            <a href="http://bpcparks.org" target="_blank">
                                                            <div class="img-swap" onclick="revertImg();"></div>
                                                            </a>
                                                            <br />
                                                            <p class="html-slider-text" id="parks-slide">Check out what's happening in the Parks</p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Navigation Button Controls -->

                                    <div class="slider-nav">
                                        <button class="backbtn" data-dir="prev">&nbsp;</button>
                                        <button class="nextbtn" data-dir="next" style="float:right;">&nbsp;</button>
                                    </div>

                                </div>
                                <!-- Pagination Controls -->
                                <div class="slider-pagi">
                                    <div class="pagi-container">
                                        <ul></ul>   <!-- Here Paginations will be dynamically created, depending on Number of elements in the list. -->                  

                                    </div>
                                </div>
                            </div>
                            <?php //if( function_exists('cyclone_slider') ) cyclone_slider('scrolling-teaser-box'); ?>
                        </div>
                        <div class="main-row-1-col-3">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page - Leadership Block') ) : ?>  
          <?php endif; ?>
                        <div class="box-read-more" id="leadership">
                                    <a id="rm-white" href="/about-2/leadership">READ MORE</a>
                            </div>
                        </div>
                    <!--</div>
                    <div class="main-row-2"> -->
                        <div class="main-row-2-col-1">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/homepage map.png" />
                            <div class="map-image-link">
                               <div class="map-image-link-text">
                                   <a href="https://maps.google.com?daddr=200+Liberty+Street+New+York+NY+10281" target="_blank">
                                   GET DIRECTIONS TO BATTERY PARK CITY</a>
                               </div>
                            </div>
                        </div>
                        <div class="main-row-2-col-2">
                            <img src="<?=$homepage800;?>" />
                            <div class="building-image-link">
                               <div class="building-image-link-text">
                                   <a href="/residential-life/buildings?leed=yes">
                                   EXPLORE OUR LEED CERTIFIED BUILDINGS</a>
                               </div>
                        </div>
                   </div>
                    <!-- <div class="main-row-3"> -->
                        <div class="main-row-3-col-1">
                            <div class="twitter-head">
                                TWITTER <a href="http://twitter.com/bpca_ny"><i class="fa fa-twitter"></i></a>
                            </div>
                             <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page - Twitter Widget Block') ) : ?>  
          <?php endif; ?>
                            <div class="twitter-follow">
                                <a href="http://twitter.com/bpca_ny">FOLLOW US @BPCA_NY</a>
                            </div>
                        </div>
                        <div class="main-row-3-col-2">
                             <div class="mr3c2-text-block">
                                <div class="mr3c2-head-text">
                                    WANT TO JOIN THE BPCA TEAM?
                                </div>
                                <div class="mr3c2-sub-text">
                                    CHECK OUT OUR JOB LISTING TO APPLY!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-black" href="/apply/employment-opps">READ MORE</a>
                            </div>
                        </div>
                        <div class="main-row-3-col-3"> 
                            <?php
                                // grab the upcoming event
                                $args = array( 
                               'posts_per_page' => 3,
                               'eventDisplay' => 'upcoming'
                            );
                                $eventdata = tribe_get_events ($args);
                                foreach ($eventdata as $curevent) {
                                    echo '  <div class="event-widget-box">';
                                    echo '  <div class="event-box-date-area home">';
                                    echo '  <div class="event-tease-date-format">';
                                    echo date('n/j', strtotime($curevent->EventStartDate));
                                    echo '  </div>';
                                    $categories = tribe_get_event_cat_slugs($curevent->ID);
                                    if($categories){
                                        $showcategory = "";
                                        foreach($categories as $category) {
                                            echo '<div class="';
                                            switch ($category) {
                                                case 'event-parks-rec':
                                                    $showcategory = "Parks &amp; Rec.";
                                                    echo 'cat-yellow';
                                                    break;
                                                case 'event-art-culture':
                                                    $showcategory = "Art &amp; Culture";
                                                    echo 'cat-blue';
                                                    break;
                                                case 'event-environment':
                                                    $showcategory = "Environment";
                                                    echo 'cat-black';
                                                    break;
                                                case 'event-kids-family':
                                                    $showcategory = "Kids &amp; Family";
                                                    echo 'cat-drk-blue';
                                                    break;
                                                case 'event-governance':
                                                    $showcategory = "Governance";
                                                    echo 'cat-drk-gray';
                                                    break;
                                                case 'event-volunteer':
                                                    $showcategory = "Volunteer";
                                                    echo 'cat-light-gray';
                                                    break;
                                            }
                                                echo ' events" id="list-cat-boxes" style="float: left">';
                                                echo '<div class="cat-text" id="teaser">';
                                                echo strtoupper($showcategory) . '</div></div>';
                                        }
                                    }
                                        echo '  </div>';
                                        echo '  <div class="event-box-text-block">';
                                        echo '      <div class="event-tease-head">';
                                        echo '<a href="/news/events/#descr-area-box-' . $curevent->ID . '">';
                                        echo strtoupper($curevent->post_title);
                                        echo '</a>';
                                        echo '      </div>'; // name-box-head
                                        /*
                                        echo '      <div class="event-tease-sub-head">';
                                        //echo date('l F j', strtotime($curevent->EventStartDate));
                                        //echo '      <br />';
                                        echo tribe_get_venue($curevent->ID);
                                        echo '      </div>'; // name-box-sub-head
                                         * 
                                         */
                                        echo '  </div>'; // event-text-block
                                        echo ' </div>'; // event-widget-box
                                }
                            ?>
                            <div class="box-read-more" id="events">
                                    <a id="rm-black" href="news/events">SEE MORE EVENTS</a>
                            </div>
                        </div>
                   <!-- </div> -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
