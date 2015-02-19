<?php

/**
* Template Name: Timeline Template
* 
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
            </div>
        <div class="section-title">BATTERY PARK CITY HISTORY</div>
        <div class="timeline-container">
        <?php
            $timelineinfo = array(); // for constructing the tabs
            // get all of the timeline posts, ordering by the sequence
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $args = array( 'post_type' => 'timeline', 
                               'posts_per_page' => 4,
                               'paged' => $paged,
                               'meta_key' => 'timeline_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                $firstentry = true;
                while ( $loop->have_posts() ) : $loop->the_post();
                // add the image to a div, first is active
                /*
                echo '<div class="timeline-image';
                if ($firstentry) {
                    echo ' active';
                    $firstentry = false;
                }
                echo '">';
                the_post_thumbnail();
                echo '</div>';
                 * 
                 */
                // save the rest of the info for the tabs
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                // save first image
                if ($firstentry) {
                    $firstimage = $image[0];
                    $firstentry = false;
                }
                array_push($timelineinfo, array(
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'year' => get_field('timeline_year')
                    //'bgimg' => $image[0]
                ));
                endwhile;
                
                // image holder
                echo '<div class="main-tabs-container" id="time-contain" ';
                echo 'style="background:url(\'' . $firstimage . '\')"></div>';
                
                // keep track of total tabs for id numbers
                $totaltabs = 0;
                
                // build the tabs
                echo '<div id="tab-container" class="timeline">';
                foreach ($timelineinfo as $info) {
                    $totaltabs++;
                    echo '<div id="time-descr-box-' . $totaltabs . '">';
                    echo '<div class="timeline-header-text">';
                    echo $info['title'];
                    echo '</div>'; // timeline-header-text
                    echo '<div class="timeline-descr">';
                    echo $info['content'];
                    echo '</div>'; // timeline-descr
                    echo '</div>'; // timeline-tab                
                }
                // reset total tabs for the years in the timeline
                $totaltabs = 0;
                // now place the years on the timeline
                echo '  <ul id="time-years">';
                foreach ($timelineinfo as $info) {
                    $totaltabs++;
                    echo '<li class="timeline-year" id="time-year-' . $totaltabs . '">';
                    //echo '<div class="timeline-year" id="time-year-' . $totaltabs . '">';
                    echo '<a href="#time-descr-box-' . $totaltabs . '">' . $info['year'] . '</a>';
                    //echo '</div>'; // timeline-year
                    echo '</li>';
                }
                echo '  </ul>';
                echo '</div>';
        ?>
        <?php if ($loop->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
            <nav class="prev-next-posts">
              <div class="prev-page-link">
                <?php echo get_previous_posts_link( '<img src="' . get_template_directory_uri() . '/images/back-arrow.png" />' ); // display newer posts link ?>
              </div>
              <div class="next-page-link">
                <?php echo get_next_posts_link( '<img src="' . get_template_directory_uri() . '/images/next-arrow.png" />', $loop->max_num_pages ); // display older posts link ?>
              </div>
            </nav>
          <?php } 
          echo '</div>';
          ?>
        </div>
    </main>
</div>
<script type="text/javascript">
$('#tab-container').easytabs({
              collapsible: true,
              collapsedByDefault: true,
              transitionIn: 'slideDown',
              transitionInEasing: 'linear',
              transitionOut: 'slideUp',
              transitionOutEasing: 'linear',
              updateHash: false,
              animationSpeed: 1000
            });
</script>
<?php get_footer(); ?>