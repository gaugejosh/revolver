<?php

/**
* Template Name: Testing Template
* 
*/

get_header(); 

// grab the information for the sliders
$slideryears = array();
$mainimageinfo = array();

$timelineinfo = array(); // for constructing the tabs
            // get all of the timeline posts, ordering by the sequence
            $args = array( 'post_type' => 'timeline',
                            'posts_per_page' => -1,
                               'meta_key' => 'timeline_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                $firstentry = true;
                while ( $loop->have_posts() ) : $loop->the_post();
                // save the year
                array_push($slideryears, get_field('timeline_year'));
                // save the image information
                $imgobj = new stdClass();
                $imgobj->img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                $imgobj->imghead = get_the_title();
                $imgobj->imgtext = get_the_content();
                array_push($mainimageinfo, $imgobj);
                endwhile;

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div id="carousel" class="flexslider">
            <ul class="slides">
                <?php
                    // create the timeline year controller strip
                    foreach ($slideryears as $year) {
                        echo '<li>';
                        echo '<div class="timeline">';
                        echo '<div class="timeline-year">';
                        echo $year;
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                    }
                ?>
            </ul>
          </div>
        <div id="slider" class="flexslider">
            <ul class="slides">
                <?php
                    // place the images in the main image slider
                    foreach ($mainimageinfo as $imginfo) {
                        echo '<li>';
                ?>
                <div class="timeline-container">
                    <div class="timeline-photo">
                        <img src="<?=$imginfo->img[0];?>" />
                    </div>
                    <div class="timeline-info-container">
                        <div class="time-descr-box">
                            <div class="timeline-header-text">
                                <?=$imginfo->imghead;?>
                            </div>
                            <div class="timeline-descr">
                                <?=$imginfo->imgtext;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        echo '</li>';
                    }
                ?>
              <!-- items mirrored twice, total of 12 -->
            </ul>
          </div>
    </main>
</div>
<script type="text/javascript">
    $(window).load(function() {
  // The slider being synced must be initialized first
  jQuery('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 300,
    itemMargin: 0,
    move: 4,
    startAt: 0,
    asNavFor: "#slider",
    minItems: 4,
    maxItems: 4
  });
   
  jQuery('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    directionNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 1200,
    itemMargin: 0,
    sync: "#carousel",
    minItems: 1,
    maxItems: 1
  });
  
  fixFlexsliderHeight();
});



function fixFlexsliderHeight() {
    // Set fixed height based on the tallest slide
    jQuery('.flexslider').each(function(){
        var sliderHeight = 0;
        $(this).find('.slides > li').each(function(){
            slideHeight = $(this).height();
            if (sliderHeight < slideHeight) {
                sliderHeight = slideHeight;
            }
        });
        $(this).find('ul.slides').css({'height' : sliderHeight});
    });
}
</script>

<?php
get_footer(); ?>