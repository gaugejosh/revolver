<?php

/**
* Template Name: About Us Board
* 
*/

get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
            </div>
        <div id="page-quote-blue">
            <div class="head-quote-text">
                <?php 
                $page_data = get_page(get_the_ID());
                echo apply_filters('the_content', $page_data->post_content);
                ?>
            </div>
            <div class="head-quote-attrib">
                <?=strtoupper(get_field('board_quote_attrib'));?><br />
                <?=get_field('board_quote_title');?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
        <div class="section-title">
                <?=strtoupper(get_field('board_head_1'));?>
            </div>
        <div class="board-material-container">
        <form method="POST" name="downloadform" id="downloadform" onsubmit="return false">
        <div class="board-col">
            <div class="past-board-min">
            <b><?=get_field('board_s1b1_head');?></b><br />
            <?php
                if (get_field('board_s1b1_descr')) {
                    echo the_field('board_s1b1_descr') . '<br />';
                }
                
                // retrieve the past 5 meeting minutes
                
                $args = array( 'post_type' => 'attachment', 
                               'post_status' => 'inherit',
                               'post_mime_type' => 'application/pdf',
                               'posts_per_page' => 5,
                               'tax_query' => array(
                                                array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => 'members_meeting_minutes',
                                                ),
                                        ),
                               //'meta_key' => 'places_page_order', 
                               'orderby' => 'post_date', 
                               'order' => 'DESC'
                            );
                $loop2 = new WP_Query( $args );
                //echo "<pre>";
                //print_r($loop);
                //echo "</pre>";
                while ( $loop2->have_posts() ) : $loop2->the_post();
                echo '<br /><input type="checkbox" id="link' . get_the_ID() . '" name="downlink[]" value="' . get_the_guid() . '" />';
                echo '<label for="link' . get_the_ID() . '">' . get_the_title() . '</label>';
                endwhile;
                
            ?>
            </div>
            <br />
            <b><?=get_field('board_s1b2_head');?></b><br />
            <?php
                if (get_field('board_s1b2_descr')) {
                    echo the_field('board_s1b2_descr') . '<br />';
                }
            ?>
            <?php
                // grab all file urls available for download
                if (get_field('board_add_info_1') != "") {
                    echo '<input type="checkbox" id="link1" name="downlink[]" value="' . get_field('board_add_info_1') . '" />';
                    echo '<label for="link1">' . get_field('board_add_info_name_1') . '</label><br />';
                }
                
                if (get_field('board_add_info_2') != "") {
                    echo '<input type="checkbox" id="link2" name="downlink[]" value="' . get_field('board_add_info_2') . '" />';
                    echo '<label for="link2">' . get_field('board_add_info_name_2') . '</label><br />';
                }
                
                if (get_field('board_add_info_3') != "") {
                    echo '<input type="checkbox" id="link3" name="downlink[]" value="' . get_field('board_add_info_3') . '" />';
                    echo '<label for="link3">' . get_field('board_add_info_name_3') . '</label><br />';
                }
                
                if (get_field('board_add_info_4') != "") {
                    echo '<input type="checkbox" id="link4" name="downlink[]" value="' . get_field('board_add_info_4') . '" />';
                    echo '<label for="link4">' . get_field('board_add_info_name_4') . '</label><br />';
                }
                
                if (get_field('board_add_info_5') != "") {
                    echo '<input type="checkbox" id="link5" name="downlink[]" value="' . get_field('board_add_info_5') . '" />';
                    echo '<label for="link5">' . get_field('board_add_info_name_5') . '</label><br />';
                }
            ?>
            <div class="board-download">
            <a href="#" onclick="downloadChecked()"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
            <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
            <a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a> 
            </div>
        </div>
        <div class="board-col">
            <b><?=get_field('board_s1b3_head');?></b><br />
            <?php
                if (get_field('board_s1b3_descr')) {
                    echo the_field('board_s1b3_descr') . '<br />';
                }
                
                // grab the next 4 upcoming meetings
                $upcomingmeet = getUpcomingMeets();
            ?>
            <br />
            <b><?=get_field('board_s1b4_head');?></b><br />
            <?php
                if (get_field('board_s1b4_descr')) {
                    echo the_field('board_s1b4_descr') . '<br />';
                }
            ?>
            <?php
                // grab all file urls available for download
                if (get_field('board_meet_mat_1') != "") {
                    echo '<input type="checkbox" id="link1" name="downlink[]" value="' . get_field('board_meet_mat_1') . '" />';
                    echo '<label for="link1">' . get_field('board_meet_mat_name_1') . '</label><br />';
                }
                
                if (get_field('board_meet_mat_2') != "") {
                    echo '<input type="checkbox" id="link2" name="downlink[]" value="' . get_field('board_meet_mat_2') . '" />';
                    echo '<label for="link2">' . get_field('board_meet_mat_name_2') . '</label><br />';
                }
                
                if (get_field('board_meet_mat_3') != "") {
                    echo '<input type="checkbox" id="link3" name="downlink[]" value="' . get_field('board_meet_mat_3') . '" />';
                    echo '<label for="link3">' . get_field('board_meet_mat_name_3') . '</label><br />';
                }
                
                if (get_field('board_meet_mat_4') != "") {
                    echo '<input type="checkbox" id="link4" name="downlink[]" value="' . get_field('board_meet_mat_4') . '" />';
                    echo '<label for="link4">' . get_field('board_meet_mat_name_4') . '</label><br />';
                }
                
                if (get_field('board_meet_mat_5') != "") {
                    echo '<input type="checkbox" id="link5" name="downlink[]" value="' . get_field('board_meet_mat_5') . '" />';
                    echo '<label for="link5">' . get_field('board_meet_mat_name_5') . '</label><br />';
                }
            ?>
            <br /><br /><b>MEETING WEBCASTS</b><br />
            View our past meetings or stream live meetings at:<br />
            <a href="http://webcasting.granicus.com/bpca/" target="_blank">http://webcasting.granicus.com/bpca/</a>
        </div>
</form>
        </div> <!-- board-material-container -->
                <div class="section-title">
                <?=strtoupper(get_field('board_head_3'));?>
            </div>
            <div class="board-commit-area-container">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Board Committees') ) : ?>  
<?php endif; ?>
        </div>
    </main>
</div>
<?php 

// function to grab the next 4 upcoming meetings
function getUpcomingMeets() {
    $args = array( 
        'posts_per_page' => 4,
        'eventDisplay' => 'upcoming',
        'tax_query' => array(
                            array(
                                    'taxonomy' => 'tribe_events_cat',
                                    'field'    => 'slug',
                                    'terms'    => 'event-board-meetings',
                            ),
                    )
     );
    $eventdata = tribe_get_events ($args);
    //echo '<pre>';
    //print_r($eventdata);
    //echo '</pre>';
    foreach ($eventdata as $curevent) {
        echo $curevent->post_title . '<br />';
    }
}

get_footer(); ?>