<?php

/**
* Template Name: Static Page Template 1
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
        <?php
            // what is the background and text color of the quotation box?
            switch (get_field('quote_bg')) {
                case 1:
                    // blue with white text
        ?>
        <div id="page-quote-blue">
        <?php
                    break;
                case 2:
                    // yellow with black text
        ?>
        <div id="page-quote-yellow">
        <?php
                    break;
            }
        ?>
            <div class="head-quote-text">
                &quot;<?=the_field('quote_box');?>&quot;
            </div>
            <div class="head-quote-attrib">
                <?=strtoupper(get_field('quote_attrib'));?><br />
                <?=get_field('quote_title');?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
            <?php
                // does the page have a diagram
                if (get_field('diagram_1') != "") {
                    
            ?>
            <div class="diagram">
                <img src="<?=the_field('diagram_1');?>" border="0" />
            </div>
            <?php
                }
                // count the number of words in the description text and split the text in half
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
                //echo $fulldescrtext;
                $totalwords = str_word_count($fulldescrtext);
                $halfwords = ceil($totalwords / 2);
                //echo $halfwords . "<br />";
                $descr1text = splitTextByWords($fulldescrtext, $halfwords);
                $descr2text = splitTextByWords($fulldescrtext, $halfwords, $halfwords);
            ?>
            
            <div class="section-title" 
                 <?php
                    // does the page have a diagram
                if (get_field('diagram_1') == "") {
                    echo 'id="notop" ';
                }
                ?>
                 >
                <?=strtoupper(get_field('section_title_1'));?>
            </div>
            <div class="page-descr-container"
                 <?php
                    // does the page have a diagram
                if (get_field('section_title_2') != "") {
                    echo 'id="nobottom" ';
                }
                ?>
                 >
                <?php
                if (get_field('static_content_columns') == "1") {
                ?>
                <div class="page-descr-text">
                <?php
                } else {
                ?>
                    <div class="page-descr-text-2col">
                <?php
                }
                ?>
                        <?=$fulldescrtext;?>
                </div>
            </div>
            <?php
                // does the page have a diagram
                if (get_field('section_title_2') != "") {
                    
            ?>
            <div class="section-title">
                <?=strtoupper(get_field('section_title_2'));?>
            </div>
            <?php
                }
                // does the page have a second diagram
                if (get_field('diagram_2') != "") {
                    
            ?>
            <div class="diagram">
                <img src="<?=the_field('diagram_2');?>" border="0" />
            </div>
        <?php
                }
                
                // show the timeline?
                if (get_field('has_timeline') == 'true') {
        ?>
                <div class="section-title">
                    TIMELINE
                </div>
                <a name="timelinearea"></a>
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
                    $totaltabs = 0;
                    
                    echo '<div id="tab-container" class="timeline">';
                            echo '<div class="time-nav-col">';
                            echo get_previous_posts_link( '<div class="prev-page-link"></div>' ); // display newer posts link
                            echo '</div>';
                    echo '  <ul id="time-years">';
                    while ( $loop->have_posts() ) : $loop->the_post();
                    // place the years on the timeline
                    $totaltabs++;
                        echo '<li class="timeline-year" id="time-year-' . $totaltabs . '">';
                        echo '<a href="#timeline-info-' . $totaltabs . '">' . get_field('timeline_year') . '</a>';
                        echo '</li>';
                    // save the rest of the info for the tabs
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                    array_push($timelineinfo, array(
                        'title' => get_the_title(),
                        'content' => get_the_content(),
                        'bgimg' => $image[0]
                    ));
                    endwhile;
                    echo '  </ul>';
                            echo '<div class="time-nav-col">';
                            echo get_next_posts_link( '<div class="next-page-link"></div>', $loop->max_num_pages ); // display older posts link
                            echo '</div>';
                            
                    // keep track of total tabs for id numbers
                    $totaltabs = 0;

                    // build the tabs
                    foreach ($timelineinfo as $info) {
                        $totaltabs++;
                        echo '<div class="timeline-info-container" id="timeline-info-' . $totaltabs . '">';
                        echo '<div class="timeline-photo">';
                        echo '<img src="' . $info['bgimg'] . '" />';
                        echo '</div>'; // timeline-photo
                        echo '<div class="time-descr-box">';
                        echo '<div class="timeline-header-text">';
                        echo $info['title'];
                        echo '</div>'; // timeline-header-text
                        echo '<div class="timeline-descr">';
                        echo $info['content'];
                        echo '</div>'; // timeline-descr
                        echo '</div>'; // timeline-descr-box  
                        echo '</div>'; // timeline-info-container
                    }
                    echo '</div>';
              echo '</div>';
              ?>
            </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.time-nav-col a').each(function(i,a){$(a).attr('href',$(a).attr('href')+'#timelinearea');});
                    });
$('#tab-container').easytabs({
              collapsible: false,
              updateHash: false
            });
</script>
        <?php
                }
        ?>
        <?php
            // which teaser box needs to be displayed?
            switch (get_field('teaser_box')) {
                case 1:
                   if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 1') ) : 
                    endif;
                   break;
                case 2:
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 2') ) : 
                    endif;
                   break;
                case 3:
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 3') ) : 
                    endif;
                   break;
            }
        ?>
    </main>
</div>
<?php
// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
    $arr = preg_split("/[\s]+/", $str, $words+1);
    $arr = array_slice($arr, $startat, $words);
    return join(' ', $arr);
}

get_footer(); ?>