<?php

/**
* Template Name: News - Press
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
    header('Content-disposition: attachment; filename=bpcapressphotos.zip');
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
            <div class="section-title">
                MEDIA CONTACT INFORMATION
            </div>
            <?php
                // count the number of words in the description text and split the text in half
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
                //$totallines = countTextInDiv($fulldescrtext, 2, 480);
                //echo $totallines . '<br />';
                //echo $fulldescrtext;
                $totalwords = str_word_count($fulldescrtext);
                $halfwords = ceil($totalwords / 2);
                //echo $halfwords . "<br />";
                $descr1text = splitTextByWords($fulldescrtext, $halfwords);
                $descr2text = splitTextByWords($fulldescrtext, $halfwords, $halfwords);
            ?>
            <div class="page-descr-container" id="nobottom">
                <div class="descr-text-box one-column">
                    <?=$fulldescrtext;?>
                </div>
            </div>
            <div class="section-title">
                PRESS
            </div>
            <div id="tab-container-press">
                <ul class="press-tabs">
                    <li class="press-tab active" id="press-tab2">
                        <a href="#press-cont-2">
                             <div class="press-text">AWARDS
                             </div>
                        </a>
                    </li>
                    <li class="press-tab" id="press-tab3">
                        <a href="#press-cont-3"> <div class="press-text">PRESS PHOTOS
                            </div></a>
                    </li>
                </ul>
                <div class="press-tab-content" id="press-cont-2">
                    <?php
                        // maximum boxes per row dependent on device being used
                        $maxboxes = 3;
                        if (is_tablet()) {
                            $maxboxes = 2;
                        } else if (is_mobile()) {
                            $maxboxes = 1;
                        }
                        $curboxes = 1;
                        // grab all posts from the awards category
                        $args = array( 'post_type' => 'post', 
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'category',
                                                'field'    => 'slug',
                                                'terms'    => 'awards',
                                        ),
                                ),
                               'orderby' => 'id', 
                               'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="awards-container-box"';
                if ($curboxes == 1) {
                    echo ' style="clear: both" ';
                }
                echo '>';
                echo '<div class="awards-logo">';
                the_post_thumbnail();
                echo '</div>';
                /*
                echo '<div class="awards-title-box">';
                the_title();
                echo '</div>';
                 * 
                 */
                echo '<div class="awards-content-box">';
                the_content();
                echo '</div>';
                echo '</div>';
                if ($curboxes == $maxboxes) {
                    $curboxes = 1;
                } else {
                    $curboxes++;
                }
                endwhile;
                    ?>
                </div> <!-- #press-cont-2 -->
                <div class="press-tab-content" id="press-cont-3">
                    <form name="downloadform" id="downloadform" method='post'>
                        <ul id="all-files">
                    <?php
                        // show downloadable press photos
                        $args = array( 'post_type' => 'attachment',
                               'post_status' => 'inherit',
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => 'press-photos',
                                        ),
                                ),
                               'orderby' => 'id', 
                               'order' => 'ASC'
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        echo '<li><div class="checker">';
                        echo '<span class="">';
                        echo '<br /><input type="checkbox" id="link' . get_the_ID() . '" name="downlink[]" value="' . get_the_guid() . '" />';
                        echo '</span>';
                        echo '</div>';
                        echo '<div class="styled-checks">';
                        echo '<label for="link' . get_the_ID() . '">';
                        echo get_the_title() . '</label>';
                        echo '</div></li>';
                        endwhile;
                    ?>
                    <input type='hidden' name='down-files' value='1' />
                    <input type='hidden' id='current_page' />  
                    <input type='hidden' id='show_per_page' /> 
                        </ul>
                    <div id='page_navigation'></div> 
                    </form><br />
                    <div class="download-link-area">
                    <a href="#" onclick="javascript:document.downloadform.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
                    <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
                    <!--<a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>-->
                    </div>
                </div>
            </div>
    </main>
</div>
<script language="javascript">
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
// jQuery EasyTabs
$('#tab-container-press').easytabs({
              collapsible: false,
              updateHash: false
            });
</script>
<script type="text/javascript">
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
            
// jPages
$(document).ready(function() {
    setPagination();
});

function setPagination() {
    //how much items per page to show  
    var show_per_page = 20;  
    //getting the amount of elements inside content div  
    var number_of_items = $('#all-files').children().size();
    console.log(number_of_items);
    //calculate the number of pages we are going to have  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
    console.log(number_of_pages);
    //set the value of our hidden input fields  
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
  
    //now when we got all we need for the navigation let's make it '  
  
    /* 
    what are we going to have in the navigation? 
        - link to previous page 
        - links to specific pages 
        - link to next page 
    */  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">PREV</a>&nbsp;&nbsp;&nbsp;';  
    var current_link = 0;  
    while(number_of_pages > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>&nbsp;&nbsp;&nbsp;';  
        current_link++;  
    }  
    navigation_html += '<a class="next_link" href="javascript:next();">NEXT</a>';  
  
    $('#page_navigation').html(navigation_html);  
  
    //add active_page class to the first page link  
        $('#page_navigation .page_link:first').addClass('active_page');  

    //hide all the elements inside content div  
    $('#all-files').children().css('display', 'none');  
  
    //and show the first n (show_per_page) elements  
    $('#all-files').children().slice(0, show_per_page).css('display', 'block');
}

function previous(){  
  
    new_page = parseInt($('#current_page').val()) - 1;  
    //if there is an item before the current active link run the function  
    if($('.active_page').prev('.page_link').length > 0){  
        go_to_page(new_page);  
    }  
  
}  
  
function next(){  
    new_page = parseInt($('#current_page').val()) + 1;  
    //if there is an item after the current active link run the function  
    if($('.active_page').next('.page_link').length > 0){  
        go_to_page(new_page);  
    }  
  
}  
function go_to_page(page_num){  
    //get the number of items shown per page  
    var show_per_page = parseInt($('#show_per_page').val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page;  
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page;  
  
    //hide all children elements of content div, get specific items and show them  
    $('#all-files').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    $('#current_page').val(page_num);  
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