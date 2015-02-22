<?php

/**
* Template Name: About Us Board
* 
*/
if (array_key_exists('down-files', $_POST)) {
    // download each file selected
    // only zip up the files if there is more than one
    if (sizeof($_POST['downlink']) > 1) {
        # create new zip opbject
        $zip = new ZipArchive();

        # create a temp file & open it
        $tmp_file = tempnam('.','');
        $zip->open($tmp_file, ZipArchive::CREATE);

        # loop through each file
        foreach($_POST['downlink'] as $file){

            # download file
            $download_file = file_get_contents($file);

            #add it to the zip
            $zip->addFromString(basename($file),$download_file);

        }

        # close zip
        $zip->close();

        # send the file to the browser as a download
        header('Content-disposition: attachment; filename=bpcapdffiles.zip');
        header('Content-type: application/zip');
        readfile($tmp_file);
    } else {
        // simply send the file
        foreach($_POST['downlink'] as $file){
            header("Content-Type: application/octet-stream");
$filename = explode("/", $file);
// last index is the file name
$thisname = $filename[sizeof($filename) - 1];
header("Content-Disposition: attachment; filename=" . urlencode($thisname));   
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");            
header("Content-Length: " . filesize($file));
flush(); // this doesn't really matter.
$fp = fopen($file, "r");
while (!feof($fp))
{
    echo fread($fp, 65536);
    flush(); // this is essential for large downloads
} 
fclose($fp); 
        }
    }
    
}
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
        <?php
            // save all custom form fields
            $page_data = get_page(get_the_ID());
            $quote = apply_filters('the_content', $page_data->post_content);
            $quoteattrib = get_field('board_quote_attrib');
            $quotetitle = get_field('board_quote_title');
            $header1 = get_field('board_head_1');
            $header2 = get_field('board_head_2');
            $header3 = get_field('board_head_3');
            $s1b1head = get_field('board_s1b1_head');
            $s1b1descr = get_field('board_s1b1_descr');
            $s1b2head = get_field('board_s1b2_head');
            $s1b2descr = get_field('board_s1b2_descr');
            $s1b3head = get_field('board_s1b3_head');
            $s1b3descr = get_field('board_s1b3_descr');
            $s1b4head = get_field('board_s1b4_head');
            $s1b4descr = get_field('board_s1b4_descr');
            $addinfo1 = get_field('board_add_info_1');
            $addinfoname1 = get_field('board_add_info_name_1');
            $addinfo2 = get_field('board_add_info_2');
            $addinfoname2 = get_field('board_add_info_name_2');
            $addinfo3 = get_field('board_add_info_3');
            $addinfoname3 = get_field('board_add_info_name_3');
            $addinfo4 = get_field('board_add_info_4');
            $addinfoname4 = get_field('board_add_info_name_4');
            $addinfo5 = get_field('board_add_info_5');
            $addinfoname5 = get_field('board_add_info_name_5');
            $meetmat1 = get_field('board_meet_mat_1');
            $meetmatname1 = get_field('board_meet_mat_name_1');
            $meetmat2 = get_field('board_meet_mat_2');
            $meetmatname2 = get_field('board_meet_mat_name_2');
            $meetmat3 = get_field('board_meet_mat_3');
            $meetmatname3 = get_field('board_meet_mat_name_3');
            $meetmat4 = get_field('board_meet_mat_4');
            $meetmatname4 = get_field('board_meet_mat_name_4');
            $meetmat5 = get_field('board_meet_mat_5');
            $meetmatname5 = get_field('board_meet_mat_name_5');
        ?>
        <div id="page-quote-blue">
            <div class="head-quote-text">
                <?php 
                echo $quote;
                ?>
            </div>
            <div class="head-quote-attrib board">
                <?=strtoupper($quoteattrib);?><br />
                <?=$quotetitle;?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
        <div class="section-title">
                <?=strtoupper($header1);?>
            </div>
        <div class="board-material-container">
        <form method="POST" name="downloadform" id="downloadform">
        <div class="board-col">
            <div class="past-board-min">
                <div id="minhead">
                    <strong><?=$s1b1head;?></strong></div>
            <?php
                if ($s1b1descr != "") {
                    //echo $s1b1descr . '<br />';
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
                echo '<div class="checker">';
                echo '<span class="">';
                echo '<br /><input type="checkbox" id="link' . get_the_ID() . '" name="downlink[]" value="' . get_the_guid() . '" />';
                echo '</span>';
                echo '</div>';
                echo '<div class="styled-check">';
                echo '<label for="link' . get_the_ID() . '">' . get_the_title() . '</label>';
                echo '</div>';
                endwhile;
                
            ?>
            <div class="box-read-more" id="more-results">
                    <a id="rm-black" href="../../public-information?meetings">SEE MORE RESULTS</a>
            </div>
            </div>
            <div class="boardinfo">
                <div id="head2"><strong><?=$s1b2head;?></strong><br /></div>
            <?php
                if ($s1b2descr != "") {
                    echo $s1b2descr . '<br />';
                }
            ?>
            <?php
                // grab all file urls available for download
                if ($addinfo1 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link1" name="downlink[]" value="' . $addinfo1 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link1">' . $addinfoname1 . '</label><br />';
                    echo '</div>';
                }
                
                if ($addinfo2 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link2" name="downlink[]" value="' . $addinfo2 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link2">' . $addinfoname2 . '</label><br />';
                    echo '</div>';
                }
                
                if ($addinfo3 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link3" name="downlink[]" value="' . $addinfo3 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link3">' . $addinfoname3 . '</label><br />';
                    echo '</div>';
                }
                
                if ($addinfo4 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link4" name="downlink[]" value="' . $addinfo4 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link4">' . $addinfoname4 . '</label><br />';
                    echo '</div>';
                }
                
                if ($addinfo5 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link5" name="downlink[]" value="' . $addinfo5 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link5">' . $addinfoname5 . '</label><br />';
                    echo '</div>';
                }
            ?>
            </div>
        </div>
        <div class="board-col2">
            <div id="head3"><strong><?=$s1b3head;?></strong><br /></div>
            <?php
                if ($s1b3descr != "") {
                    echo $s1b3descr . '<br />';
                }
                
                // grab the next 4 upcoming meetings
                $upcomingmeet = getUpcomingMeets();
            ?>
            <br />
            <div class="upcomingboard">
                <div id="head4"> <strong><?=$s1b4head;?></strong><br /></div>
            <?php
                if ($s1b4descr != "") {
                    echo $s1b4descr . '<br />';
                }
            ?>
            <?php
                // grab all file urls available for download
                if ($meetmat1 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link10" name="downlink[]" value="' . $meetmat1 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link10">' . $meetmatname1 . '</label><br />';
                    echo '</div>';
                }
                
                if ($meetmat2 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link20" name="downlink[]" value="' . $meetmat2 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link20">' . $meetmatname2 . '</label><br />';
                    echo '</div>';
                }
                
                if ($meetmat3 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link30" name="downlink[]" value="' . $meetmat3 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link30">' . $meetmatname3 . '</label><br />';
                    echo '</div>';
                }
                
                if ($meetmat4 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link40" name="downlink[]" value="' . $meetmat4 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link40">' . $meetmatname4 . '</label><br />';
                    echo '</div>';
                }
                
                if ($meetmat5 != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link50" name="downlink[]" value="' . $meetmat5 . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-check">';
                    echo '<label for="link50">' . $meetmatname5 . '</label><br />';
                    echo '</div>';
                }
                ?></div>
            <br /><br /><div class="webcast"><strong>MEETING WEBCASTS</strong><br /></div>
            View our past meetings or stream live meetings at:<br />
            <a href="http://webcasting.granicus.com/bpca/" target="_blank">http://webcasting.granicus.com/bpca/</a>
        </div>
            <div class="board-download">
            <a href="#" onclick="javascript:document.downloadform.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
            <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
            <!-- <a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a> --> 
            </div>
            <input type='hidden' name='down-files' value='1' />
</form>
        </div> <!-- board-material-container -->
                <div class="section-title">
                <?=strtoupper($header3);?>
            </div>
            <div class="board-commit-area-container">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Board Committees') ) : ?>  
<?php endif; ?>
        </div>
        <div class="teaser-area">
            <?php
            if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 1') ) : 
                    endif;
            ?>
        </div>
    </main>
</div>
<script type='text/javascript'>
    // click event for checkboxes
    $('.checker span').click(function (){
        if ($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            $(':checkbox', this).prop('checked', false);
        } else {
            $(this).addClass('checked');
            $(':checkbox', this).prop('checked', true);
        }
    });
// function to initiate multiple downloads
            function makeFrame( url ) 
            { 
                ifrm = document.createElement( "IFRAME" ); 
                ifrm.setAttribute( "style", "display:none;" ) ;
                ifrm.setAttribute( "src", url ) ; 
                ifrm.style.width = 0+"px"; 
                ifrm.style.height = 0+"px"; 
                document.body.appendChild( ifrm ) ; 
            }  
            
            // force download of selected pdf files
            /*
            function downloadChecked( )
            {
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            console.log(foo.value);
                            makeFrame(foo.value);
                      }
                }
            }
            
            // force download of selected pdf files
            function downloadChecked2( )
            {
                for( i = 0 ; i < document.rfpcontact.elements.length ; i++ )
                {
                      foo = document.rfpcontact.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            console.log(foo.value);
                            makeFrame(foo.value);
                      }
                }
            }
            */
            // open new windows to print selected files
            function printChecked() {
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            window.open(foo.value);
                      }
                }
            }
            
            // email links to the checked off files
            function emailChecked() {
                var emailbody = "";
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            emailbody += foo.value + "%0D%0A";
                            //window.open(foo.value);
                      }
                }
                // open up the user's email client
                window.location.href = "mailto:?subject=BPCA RFP Documents&body=" + emailbody; 
            }
</script>
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