<?php

/**
* Template Name: Apply - RFP Template
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
    header('Content-disposition: attachment; filename=bpcarfpfiles.zip');
    header('Content-type: application/octet-stream');
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
            // save all custom fields to be displayed
            $quotebox = get_field('rfp_quote_box');
            $quoteattrib = get_field('rfp_quote_attrib');
            $quotetitle = get_field('rfp_quote_title');
            $section1 = get_field('rfp_section_3');
            $section2 = get_field('rfp_section_2');
            $section3 = get_field('rfp_section_1');
            $rfpdescr = get_field('rfp_description');
            $formtitle = get_field('rfp_form_title');
            $formdescr = get_field('rfp_form_descr');
            $file1 = get_field('rfp_file_1');
            $file2 = get_field('rfp_file_2');
            $file3 = get_field('rfp_file_3');
            $file4 = get_field('rfp_file_4');
        ?>
        <div id="page-quote-yellow">
            <div class="head-quote-text yellowbg">
                &quot;<?=$quotebox;?>&quot;
            </div>
            <div class="head-quote-attrib">
                <?=strtoupper($quoteattrib);?><br />
                <?=$quotetitle;?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
            <?php
                // count the number of words in the description text and split the text in half
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
                //echo $fulldescrtext;
                //$totalwords = str_word_count($fulldescrtext);
                //$halfwords = ceil($totalwords / 2);
                ///echo $halfwords . "<br />";
                //$descr1text = splitTextByWords($fulldescrtext, $halfwords);
                //$descr2text = splitTextByWords($fulldescrtext, $halfwords, $halfwords);
            ?>
            <div class="section-title">
                <?=strtoupper($section1);?>
            </div>
        <div class="page-descr-container rfp">
                    <div class="page-descr-text2">
                        <?=$rfpdescr;?>
                    </div>
            </div>
            <div class="rfp-file-section">
                <div id="contact-details">2015 RFPs</div><br /><br />
                <div class="rfp-down-checks">
                <?php
                    // grab the 8 most recent RFPs
                    $args = array( 'post_type' => 'attachment', 
                        'post_status' => 'inherit',
                               'posts_per_page' => 8,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => 'rfps_bid_opportunites',
                                        ),
                                ),
                               'orderby' => 'post_date', 
                               'order' => 'DESC'
                );
                $loop = new WP_Query( $args );
                echo '<form name="downloadform" id="downloadform" method="post">';
                while ( $loop->have_posts() ) : $loop->the_post();
                    $thisid = get_the_ID();
                    echo '<div class="checker">';
                    echo '<span class="">';
                    echo '<input type="checkbox" id="link' . $thisid . '" name="downlink[]" value="' . get_the_guid() . '" />';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="styled-checks">';
                    echo '<label for="link' . $thisid . '">' . get_the_title() . '</label><br />';
                    echo '</div>';
                endwhile;
                echo '<input type="hidden" name="down-files" value="1" />';
                echo "</form>";
                ?><br />
                <div class="box-read-more" id="more-results">
                    <a id="rm-black" href="../../public-information/#pub-info-2-cont-11">SEE MORE RESULTS</a>
                </div>
                <div class="download-link-area" id="rfp">
                    <a href="#" onclick="javascript:document.downloadform.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
                    <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
                    <!-- <a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a> -->
                </div>
                </div>
            </div>
            <div class="section-title">
                <?=strtoupper($section2);?>
            </div>
            <div class="rfp-contactinfo">
                <?php
                    echo '<div id="contact-details">' . $formtitle . '</div><br />';
                    echo '<div class="page-sub-text">' . $formdescr . '</div><br />';
                ?>
                <div id="contact-details">CONTACT DETAILS</div><br />
                    <?php echo do_shortcode('[sform]1[/sform]'); ?>
                <div class="download-form" id="down-form-area">
                    <form method="POST" name="rfpcontact" id="rfpcontact">
                        <div id="contact-details2" class="form-disabled">CLICK TO DOWNLOAD FORMS</div><br />
                        <div id="diverse-box">
                        <div class="checker disabled">
                        <span class="disabled">
                        <input type="checkbox" id="diverse-question" name="downlink[]" value="<?=$file1;?>" />
                        </span>
                        </div>
                        <div class="styled-checks">
                        <label for="diverse-question"><div class="form-checks disabled">VENDOR MANDATORY FORMS</div></label>
                        </div>
                        </div>
                        <div id="vendor-box">
                        <div class="checker disabled">
                        <span class="disabled">
                        <input type="checkbox" id="vendor-setup" name="downlink[]" value="<?=$file2;?>" />
                        </span>
                        </div>
                         <div class="styled-checks">
                        <label for="vendor-setup"><div class="form-checks disabled">NEW VENDOR SETUP REQUEST FORM IRS</div></label>
                         </div>
                         </div>
                        <div id="ach-box">
                            <div class="checker disabled">
                        <span class="disabled">
                        <input type="checkbox" id="ach-form" name="downlink[]" value="<?=$file3;?>" />
                        </span>
                            </div>
                            <div class="styled-checks">
                        <label for="ach-form"><div class="form-checks disabled">ACH ENROLLMENT FORM</div></label>
                            </div>
                            </div>
                        <div id="w9-box">
                            <div class="checker disabled">
                        <span class="disabled">
                        <input type="checkbox" id="w9-form" name="downlink[]" value="<?=$file4;?>" />
                        </span>
                            </div>
                             <div class="styled-checks">
                        <label for="w9-form"><div class="form-checks disabled">FORM W-9</div></label>
                             </div>
                             </div>
                        <input type="hidden" name="down-files" value="1" />
                        <div class="down-form-link" id="down-link-forms">
                        <a href="#" onclick="javascript:document.rfpcontact.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
                       <!-- <a href="#" onclick="printChecked2()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a> -->
                        </div>
                    </form>
                <!--<div class="download-form-gray-box" id="dl-overlay"></div>-->
                </div>
            </div>
        <div class="section-title" >
                <?=strtoupper($section3);?>
            </div>
            <div class="page-descr-container rfp">
                    <div class="page-descr-text">
                        <?=$fulldescrtext;?>
                    </div>
            </div>
        <!--<iframe src="" id="download-iframe" style="display:none;" />-->
        <div class="teaser-area">
        <!-- Teaser 1 -->
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
                                    <a id="rm-white" href="../../apply/permits">READ MORE</a>
                            </div>
                        </div>
        <!-- Teaser 2 -->
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
                                        echo '<a href="../../news/events#descr-area-box-' . $curevent->ID . '">';
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
                                        echo '  </div>'; // name-box-text-block
                                        echo ' </div>'; // event-widget-box
                                }
                            ?>
                            <div class="box-read-more" id="events">
                                    <a id="rm-black" href="../../news/events">SEE MORE EVENTS</a>
                            </div>
                        </div>
        
        <!-- Teaser 3 -->
         <?php
                // only show the last one if the user is not on a mobile device
                if (!is_tablet() && !is_mobile())
                {
            ?>
        <div class="main-row-1-col-3">
                            <div class="mr1c1-text-block" id="piera" style="color:#fff">
                                <div class="mr1c1-head-text" id="piera">
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
        <?php
                }
        ?>
        </div>
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
            
            // open new windows to print selected files
            function printChecked2() {
                for( i = 0 ; i < document.rfpcontact.elements.length ; i++ )
                {
                      foo = document.rfpcontact.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            window.open(foo.value);
                      }
                }
            }
            
            // email links to the checked off files
            function emailChecked2() {
                var emailbody = "";
                for( i = 0 ; i < document.rfpcontact.elements.length ; i++ )
                {
                      foo = document.rfpcontact.elements[ i ] ;
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

get_footer(); ?>