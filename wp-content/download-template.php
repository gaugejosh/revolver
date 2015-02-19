<?php

/**
* Template Name: Download Template
* 
*/
if (array_key_exists('down-files', $_POST)) {
    // download each file selected
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
}
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
            if (get_field('down_has_header') == 'true') {
                if (get_field('down_quote_color') == "1") {
        ?>
        <div id="page-quote-yellow">
        <?php
                } else {
        ?>
        <div id="page-quote-blue">
        <?php
                }
        ?>
            <div class="head-quote-text">
                &quot;<?=the_field('down_quote_box');?>&quot;
            </div>
            <div class="head-quote-attrib">
                <?=strtoupper(get_field('down_quote_attrib'));?><br />
                <?=get_field('down_quote_title');?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
            <?php
            }
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
                if (get_field('down_text_cols') == "2") {
                    // count the number of words in the description text and split the text in half
                    $totalwords = str_word_count($fulldescrtext);
                    $halfwords = ceil($totalwords / 2);
                    //echo $halfwords . "<br />";
                    $descr1text = splitTextByWords($fulldescrtext, $halfwords);
                    $descr2text = splitTextByWords($fulldescrtext, $halfwords, $halfwords);
                } else {
                    $descr1text = $fulldescrtext;
                    $descr2text = "";
                }
            ?>
            
            <div class="section-title">
                <?=strtoupper(get_field('down_section_1'));?>
            </div>
            <div class="page-descr-container"
                 <?php
                    // does the page have a diagram
                if (get_field('section_2') != "") {
                    echo 'id="nobottom" ';
                }
                ?>
                 >
                <div class="descr-text-box one-column">
                    <?=$fulldescrtext;?>
                </div>
            </div>
            <?php
                // second section?
                if (get_field('down_section_2') != "") {
                    
            ?>
            <div class="section-title">
                <?=strtoupper(get_field('down_section_2'));?>
            </div>
            <?php
                }
                // does the page have key dates and deadlines?
                if (get_field('down_deadline_text') != "") {
                    
            ?>
        <div class="deadline-container">
            <div class="deadline-descr">
                <?php the_field('down_deadline_text'); ?>
            </div>
        <?php
            if (get_field('down_deadline_1') != "") {
                
        ?>
        <div class="deadline-text">
            <div class="deadline-head">
                DEADLINE #1
            </div>
            <div class="deadline-info">
                <?php the_field('down_deadline_1'); ?>
            </div>
        </div>
        <div class="deadline-text">
            <div class="deadline-head">
                DEADLINE #2
            </div>
            <div class="deadline-info">
                <?php the_field('down_deadline_2'); ?>
            </div>
        </div>
        <div class="deadline-text">
            <div class="deadline-head">
                DEADLINE #3
            </div>
            <div class="deadline-info">
                <?php the_field('down_deadline_3'); ?>
            </div>
        </div>
        <?php
            }
        ?>
        </div>
        <?php
                }
        ?>
        <div class="download-area">
            <form method="POST" name="downloadform" id="downloadform">
            <?php
                // grab all file urls available for download
            
                if (get_field('down_file_name_1') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link1" name="downlink[]" value="' . get_field('down_file_1') . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link1">' . get_field('down_file_name_1') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_2') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link2" name="downlink[]" value="' . get_field('down_file_2') . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link2">' . get_field('down_file_name_2') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_3') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link3" name="downlink[]" value="' . get_field('down_file_3') . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link3">' . get_field('down_file_name_3') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_4') != "") {echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link4" name="downlink[]" value="' . get_field('down_file_4') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link4">' . get_field('down_file_name_4') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_5') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link5" name="downlink[]" value="' . get_field('down_file_5') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link5">' . get_field('down_file_name_5') . '</label>';
                    echo '</div>';
                }
                /*
                if (get_field('down_file_name_6') != "") {
                    echo '<br /><input type="checkbox" id="link6" name="downlink[]" value="' . get_field('down_file_6') . '" />';
                    echo '<label for="link6">' . get_field('down_file_name_6') . '</div></label>';
                }
                */
                if (get_field('down_file_name_6') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link6" name="downlink[]" value="' . get_field('down_file_6') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link6">' . get_field('down_file_name_6') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_7') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link7" name="downlink[]" value="' . get_field('down_file_7') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link7">' . get_field('down_file_name_7') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_8') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link8" name="downlink[]" value="' . get_field('down_file_8') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link8">' . get_field('down_file_name_8') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_9') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link9" name="downlink[]" value="' . get_field('down_file_9') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link9">' . get_field('down_file_name_9') . '</label>';
                    echo '</div>';
                }
                
                if (get_field('down_file_name_10') != "") {
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<br /><input type="checkbox" id="link10" name="downlink[]" value="' . get_field('down_file_10') . '" />';
                     echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link10">' . get_field('down_file_name_10') . '</label>';
                    echo '</div>';
                }
            ?>
              <input type="hidden" name="down-files" value="1" />
            </form><br />
            <div class="download-link-area">
                <a href="#" onclick="javascript:document.downloadform.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
                <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
                <a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>
            </div>
        </div>
        <?php
            // which teaser box needs to be displayed?
            switch (get_field('down_teaser_box')) {
                case 1:
                    ?>
                   <div class="teaser-area">
            <!-- Tesaser Box 1 -->
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
                                    <a id="rm-black" href="../../apply/employment-opps/">READ MORE</a>
                            </div>
                        </div>
            <!-- Teaser Box 2 -->
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
                                       <!-- <a href="http://instagram.com/bpca_ny" target="_blank" class="social-icon-link"><i class="fa fa-instagram fa-3x"></i></a>--><br /><br /><br />
                                        <p class="html-slider-text">Stay in the loop with social media</p>
                                        </div>
                                </div>
                            </div>
                        </li>
 
                        <li>
                            <div class="slides">
                                <div class="slides_content">
                                    <div class="social-block-slider">
                                        <form method="post" action="http://bpca.revolverbranding.com/wp-content/plugins/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">
                                        <div>
                                        <input class="newsletter-email" type="email" name="ne" size="100" value=" ENTER EMAIL ADDRESS" required></div><br />
                                        <div class="news-button">
                                                <input class="newsletter-submit" type="submit" value="Subscribe"/>
                                        </div>
                                        </form>
                                        <p class="html-slider-text">Stay informed by signing up for our newsletter</p>
                                        </div>
                                </div>
                            </div>
                        </li>
                         
                        <li>
                            <div class="slides">
                                <div class="slides_content">
                                    <div class="bpcp-block-slider">
                                        <a href="http://bpcparks.org" target="_blank">
                                        <div class="img-swap"></div>
                                        </a>
                                        <br />
                                        <p class="html-slider-text">Check out what's happening in the Parks</p>
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
            <div class="twitter-foot">
                            <div class="twitter-head">
                                TWITTER <a href="http://twitter.com/bpca_ny"><i class="fa fa-twitter"></i></a>
                            </div>
                             <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page - Twitter Widget Block') ) : ?>  
          <?php endif; ?>
                            <div class="twitter-follow">
                                <a href="http://twitter.com/bpca_ny">FOLLOW US @BPCA_NY</a>
                            </div>
                        </div>
            <!-- Teaser Box 3 -->
            <div class="teaser-box-navy">
                            <div class="mr1c1-text-block">
                                <div class="mr1c1-head-text" id="teaser-alerts">
                                    STAY INFORMED WITH CUSTOM E-ALERTS
                                </div>
                                <div class="mr1c1-sub-text">
                                      OPT IN TO TOPICS THAT MATTER THE MOST TO YOU!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="../../news/alert-subscription">READ MORE</a>
                            </div>
                        </div>
        </div>
            <?php
                   break;
                case 2:
                    ?>
            <div class="teaser-area">
        <!-- Teaser 1 -->
        <div class="main-row-1-col-1">
                            <div class="mr1c1-text-block">
                                <div class="mr1c1-head-text">
                                    NEED A PERMIT?
                                </div>
                                <div class="mr1c1-sub-text">
                                    VISIT OUR NEW PERMIT PAGE TO GET STARTED!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="../../apply/permits">READ MORE</a>
                            </div>
                        </div>
        <!-- Teaser 2 -->
        <div class="main-row-3-col-3"> 
                            <div class="widget-head"><a href="<?php get_template_directory_uri(); ?>/news/events">UPCOMING EVENTS</a></div>
                            <?php
                                // grab the upcoming event
                                $args = array( 
                               'posts_per_page' => 3,
                               'eventDisplay' => 'upcoming'
                            );
                                $eventdata = tribe_get_events ($args);
                                foreach ($eventdata as $curevent) {
                                    echo '  <div class="event-widget-box">';
                                    echo '  <div class="event-box-date-area">';
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
                                                echo '" id="list-cat-boxes" style="float: left">';
                                                echo '<div class="cat-text">';
                                                echo strtoupper($showcategory) . '</div></div>';
                                        }
                                    }
                                        echo '  </div>';
                                        echo '  <div class="event-box-text-block">';
                                        echo '      <div class="event-tease-head">';
                                        echo strtoupper($curevent->post_title);
                                        echo '      </div>'; // name-box-head
                                        /*
                                        echo '      <div class="event-tease-sub-head">';
                                        //echo date('l F j', strtotime($curevent->EventStartDate));
                                        //echo '      <br />';
                                        echo tribe_get_venue($curevent->ID);
                                        echo '      </div>'; // name-box-sub-head
                                         * 
                                         */
                                        echo '  </div>'; // name-box-text-block
                                        echo ' </div>'; // event-widget-box
                                }
                            ?>
                            <div class="box-read-more" id="events">
                                    <a id="rm-black" href="../../news/events">READ MORE</a>
                            </div>
                        </div>
        
        <!-- Teaser 3 -->
        <div class="main-row-1-col-3">
                            <div class="mr1c1-text-block" id="piera" style="color:#fff">
                                <div class="mr1c1-head-text">
                                    PIER A'S HISTORIC RENOVATION IS COMPLETE!
                                </div>
                                <div class="mr1c1-sub-text">
                                   COME DINE, DRINK, SHOP AND TAKE IT IN!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="../../places-2/public-spaces#descr-area-box-1390">READ MORE</a>
                            </div>
                        </div>
        </div>
            <?php
                   break;
                case 3:
                    ?>
            <div class="teaser-area">
            <!-- Teaser 1 -->
            <div class="main-row-1-col-3">
                            <div class="mr1c1-text-block" style="color:#fff">
                                <div class="mr1c1-head-text">
                                    DO YOU DREAM OR LIVING GREEN?
                                </div>
                                <div class="mr1c1-sub-text">
                                   SEE WHY BPC IS A LEED PIONEER!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="../../places-2/public-spaces#descr-area-box-1390">READ MORE</a>
                            </div>
                        </div>
            <!-- Teaser 2 -->
            <div class="twitter-foot">
                            <div class="twitter-head">
                                TWITTER <a href="http://twitter.com/bpca_ny"><i class="fa fa-twitter"></i></a>
                            </div>
                             <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page - Twitter Widget Block') ) : ?>  
          <?php endif; ?>
                            <div class="twitter-follow">
                                <a href="http://twitter.com/bpca_ny">FOLLOW US @BPCA_NY</a>
                            </div>
                        </div>
            <!-- Teaser 3 -->
            <div class="main-row-1-col-3">
                            <div class="mr1c1-text-block" style="color:#fff">
                                <div class="mr1c1-head-text">
                                    BPCA FUNDS COMMUNITY PROJECTS
                                </div>
                                <div class="mr1c1-sub-text">
                                   APPLY NOW AND YOURS COULD BE NEXT!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-white" href="../../places-2/public-spaces#descr-area-box-1390">READ MORE</a>
                            </div>
                        </div>
        </div>
                    
            <?php
                   break;
            }
        ?>
    </main>
</div>
<script type="text/javascript">
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
// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
    $arr = preg_split("/[\s]+/", $str, $words+1);
    $arr = array_slice($arr, $startat, $words);
    return join(' ', $arr);
}

//This script is developed by www.webinfopedia.com
//For more examples in php visit www.webinfopedia.com
function zipFilesAndDownload($file_names,$archive_file_name,$file_path)
{
    $zip = new ZipArchive();
    //create the file and throw the error if unsuccessful
    if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
        exit("cannot open <$archive_file_name>\n");
    }
    //add each files of $file_name array to archive
    foreach($file_names as $files)
    {
          $zip->addFile($file_path.$files,$files);
        //echo $file_path.$files,$files."<br>";
    }
    $zip->close();
    //then send the headers to foce download the zip file
    header("Content-type: application/zip"); 
    header("Content-Disposition: attachment; filename=$archive_file_name"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    readfile("$archive_file_name");
    exit;
}
get_footer(); ?>