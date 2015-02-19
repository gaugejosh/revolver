<?php

/**
* Template Name: About Us Leadership
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
                $curcolcount = 1; // track what column is being built, limited to 3
                $currowcount = 1; // track what row we are on
                $totalblocks = 0; // tracks how many total boxes are being used
                $maxcolumns = 3; // default number of columns per row
                
                // reduce column count if reading page from a mobile device or tablet
                if (is_tablet()) {
                    $maxcolumns = 2;
                } else if (is_mobile()) {
                    $maxcolumns = 1;
                }
                
                // array to hold the bio information for building the collapsable divs
                $bioinfo = array();
                
                // create loop to display all leader bios from the leaders post type
                $args = array( 'post_type' => 'leaders', 
                               'posts_per_page' => -1, 
                               'meta_key' => 'leader_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    // create a new unordered list if this is a new row
                    if ($curcolcount == 1) {
                        echo '<div id="tab-container' . $currowcount . '">';
                        echo '<ul class="box-rows" id="box-row-' . $curcolcount . '">';
                    }
                    echo '<li class="header-box closed thisid' . get_the_ID() . '" id="name-box-' . $curcolcount . $currowcount . '">';
                    echo '  <div class="name-box-text-block nameid' . get_the_ID() . '">';
                    echo '      <div class="name-box-head">';
                    echo strtoupper(get_the_title());
                    echo '      </div>'; // name-box-head
                    echo '      <div class="name-box-sub-head">';
                                    the_field('position_title');
                    echo '      <br />';
                                    the_field('confirmed_on');
                    echo '      </div>'; // name-box-sub-head
                    echo '  </div>'; // name-box-text-block
                    echo '  <a href="#bio-area-box-' . get_the_ID() . '" name="#bio-area-box-' . get_the_ID() . '">';
                    echo '      <p class="exc-text"><span>Replacing</span>';
                    echo '<input type="hidden" id="bio-row" value="' . $currowcount . '" />';
                    echo ' </p>';
                    echo '  </a>';
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->ID ), 'single-post-thumbnail' );
                    echo '<input type="hidden" id="bio-image" class="imgid' . get_the_ID() . '" value="' . $image[0] . '" />';
                    echo '</li>'; // name-box
                    
                    // count the number of words in the bio text and split the text in half
                    $fullbiotext = get_the_content();
                    
                    $bio1text = get_field('bio_column_1');
                    $bio2text = get_field('bio_column_2');
                    array_push($bioinfo, array(
                                                    'name' => strtoupper(get_the_title()),
                                                    'title' => get_field('position_title'),
                                                    'confirmed' => get_field('confirmed_on'),
                                                    'bio' => $fullbiotext,
                                                    'id' => get_the_ID(),
                                                    'bio1' => $bio1text,
                                                    'bio2' => $bio2text
                                                )
                     );
                    
                    // increase the count for the next column
                    $curcolcount++;
                    // add to the total blocks
                    $totalblocks++;
                    // need to start a new row?
                    if ($curcolcount > $maxcolumns) {
                        // close the current unordered list
                        echo '</ul>';
                        // reset the column count to start a new row
                        $curcolcount = 1;
                        
                        // build the bio section before starting a new row
                        build_bio_box($bioinfo, $currowcount);
                        
                        // clear the bio information array
                        $bioinfo = array();
                        echo '</div><!-- #tab-container' . $currowcount . '-->';
                  
                        // increase the row number by 1
                        $currowcount++;
                    }
              endwhile;
              
              // do any blank boxes need to be added?
              if ($curcolcount > 1 && $curcolcount <= $maxcolumns) {
                  $savedcolcount = $curcolcount;
                  while ($curcolcount <= $maxcolumns) {
                      echo '<li class="header-box" id="name-box-' . $curcolcount . $currowcount . '">';
                      echo '  <a href="#bio-area-box-' . $curcolcount . $currowcount . '"></a>';
                      //echo '      <p class="exc-text"><span>Replacing</span></p>';
                      //echo '  </a>';
                      echo '&nbsp;</li>';
                      $curcolcount++;
                  }
                  echo "</ul>"; // close the list
                  // build the remaining bio information boxes
                  build_bio_box($bioinfo, $currowcount);
                  // build any blank bio boxes so the easytabs will work
                  while ($savedcolcount < $maxcolumns) {
                      echo '<div class="" id="bio-area-box-' . $savedcolcount . $currowcount . '"></div>';
                      $savedcolcount++;
                  }
                  echo '</div><!-- #tab-container' . $currowcount . '-->';
                  $currowcount++;
              }
            ?>
    </main>
</div>
<?php
// function to build the bio details under each bio box
// Parameters: array $biodetail
function build_bio_box ($biodetail, $rownum) {
    $bionum = 1; // track the number of bio details being displayed
    
    foreach ($biodetail as $biotext) {
        echo '<div class="" id="bio-area-box-' . $biotext['id'] . '"';
        // need inline style to clear floats when starting a new row
        if ($bionum == 1) {
            echo ' style="clear:both"';
        }
        echo '>'; // bio-area-box
        echo '  <div class="bio-text-box-container">';
        echo '      <div class="bio-text-1-box">';
        echo $biotext['name'] . '<br />';
        echo $biotext['title'] . '<br />';
        echo $biotext['confirmed'] . '<br /><br />';
        echo $biotext['bio1'];
        echo '      </div>';
        echo '      <div class="bio-text-2-box">';
        echo $biotext['bio2'];
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        $bionum++;
    }
}
/*
// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
    $arr = preg_split("/[\s]+/", $str, $words+1);
    $arr = array_slice($arr, $startat, $words);
    return join(' ', $arr);
}

// function to split text into two columns
function splitTextToColumns($str) {
    $len = strlen($str);
    $space = strrpos($str," ",-$len/2);
    $cols = array();
    array_push($cols, substr($str,0,$space));
    array_push($cols, substr($str,$space));
    return $cols;
}
 * 
 */
?>
<script language="javascript">
// jQuery EasyTabs
<?php
// build tab rows
$tabnames = "";
for ($i = 1; $i < $currowcount; $i++) {
    if ($i != 1) {
        $tabnames .= ",";
    }
    $tabnames .= "#tab-container" . $i;
}
?>
$('<?=$tabnames;?>').easytabs({
              collapsible: true,
              collapsedByDefault: true,
              transitionIn: 'slideDown',
              transitionInEasing: 'linear',
              transitionOut: 'slideUp',
              transitionOutEasing: 'linear',
              updateHash: false,
              animationSpeed: 1000
            });
<?php
// call javascript function to load leader image if # is in url
if (array_key_exists('id', $_GET)) {
    // make sure the variable is a number
    if (is_numeric($_GET['id'])) {
        // echo out the javascript to set the picture in the biography
        echo 'showBioPic(' . $_GET['id'] . ');';
    }
}
?>
    
// sizing variables based on screen size
var tablet = window.matchMedia("(max-width: 768px)");
var phone = window.matchMedia("(max-width: 414px)");
var imgwidth = "400px";
var imgheight = "350px";

if (phone.matches) {
    imgwidth = "300px";
    imgheight = "280px";
} else if (tablet.matches) {
    imgwidth = "320px";
    imgheight = "280px";
}

function showBioPic(id) {
    var imageloc = $('.imgid' + id).val();
    console.log(imageloc);
    $('.thisid' + id).removeClass('closed');
    $('.thisid' + id).addClass('open');
    $('.nameid' + id).css({opacity: '0'});
    $('.thisid' + id).css({background:'url(' + imageloc + ')', opacity:'1', 'background-size':imgwidth + ' ' + imgheight, 'background-repeat':'no-repeat'});
}

if (!phone.matches && !tablet.matches) {
    // add the hover events to the page
    $('.header-box').hover(function () {
    if ($(this).hasClass('closed')) {
        var imageloc = $('#bio-image', this).val();
        $('.name-box-text-block', this).css({opacity: '0'});
        $(this).css({background:'url(' + imageloc + ')', opacity:'0.5', 'background-size':imgwidth + ' ' + imgheight, 'background-repeat':'no-repeat'});
    }
            $(this).addClass('curhover');
            
}, function () {
    if ($(this).hasClass('closed')) {
        $(this).css({background: '#fff'});
        $(this).css({opacity: '1'});
        $('.name-box-text-block', this).css({opacity: '1'});
    }
    $(this).removeClass('curhover');
});


$('.exc-text').click(function () {
    var currow = $('#bio-row', this).val();
    //console.log(currow);
    if ($('.header-box.curhover').hasClass('open' + currow)) {
        // closing the bio information
        $('.header-box.curhover').removeClass('open' + currow);
        $('.header-box.curhover').addClass('closed');
    } else {
        // any bios open?
       if ($('.header-box').hasClass('open' + currow)){
            // remove background from collapsed containers
            $('.header-box.open' + currow).css({background: '#fff'});
            //$('.header-box.open' + currow).css({opacity: 1});
            $('.header-box.closed > .name-box-text-block').css({opacity: '1'});
            $('.header-box.open' + currow).addClass('closed');
            $('.header-box.open' + currow).removeClass('open' + currow);
        }
        // keep the bio image up for the current person
        $('.name-box-text-block.curhover').css({opacity: '0'});
        $('.header-box.curhover').removeClass('closed');
        // check for other open boxes
        //$('.header-box.curhover').css({opacity: '1'});
        $('.header-box.curhover').addClass('open' + currow);
        $('.header-box.open' + currow).removeClass('curhover');
        $('.header-box.open' + currow).css({opacity: '1'});
        // hide any background not currently active
    }
});
} else {
    // only click rules apply to mobile devices
    $('.exc-text').click(function () {
            if($(this).hasClass('open')) {
                // close the bio information and hide the image
                $(this).css({background: '#fff'});
                $(this).removeClass('open');
                $(this).css({'background-image':'none'});
                // remove background from collapsed containers
                $(this).css({background: '#fff'});
                $(this).css({opacity: 1});
                $(this).addClass('closed');
                $(this).removeClass('open');
                var nameblock = $(this).prev('.name-box-text-block');
                nameblock.css({opacity: '1'});
            } else {
                 // any bios open?
                if ($('.header-box').hasClass('open')){
                    $('.header-box.open').css({background: '#fff'});
                     $('.header-box.open').removeClass('open');
                     // remove background from collapsed containers
                     $('.header-box.open').css({opacity: 1});
                     $('.header-box.open').addClass('closed');
                     $('.name-box-text-block').css({opacity: '1'});
                 }
                 var imageloc = $(this).prev("#bio-image").val();
                 // open up the currently clicked bio with their image
                 var nameblock2 = $(this).prev('.name-box-text-block');
                 nameblock2.css({opacity: 0});
                 var mainbox = $(this).prev('.header-box');
                 mainbox.css({background:'url(' + imageloc + ')', opacity:'1', 'background-size':imgwidth + ' ' + imgheight, 'background-repeat':'no-repeat'});
            }
       } 
    );
}
</script>
<?php get_footer(); ?>