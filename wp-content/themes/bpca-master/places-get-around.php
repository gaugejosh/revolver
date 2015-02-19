<?php

/**
* Template Name: Places - Get Around
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
                
                // array to hold the description information for building the collapsable divs
                $descrinfo = array();
                
                // create loop to display all descriptions from the post type
                $args = array( 'post_type' => 'places', 
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'places_categories',
                                                'field'    => 'slug',
                                                'terms'    => 'get-around',
                                        ),
                                ),
                               'meta_key' => 'places_page_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    // create a new unordered list if this is a new row
                    if ($curcolcount == 1) {
                        echo '<div id="tab-container' . $currowcount . '">';
                        echo '<ul id="box-row-' . $curcolcount . '">';
                    }
                    echo '<li class="header-box" id="name-box-' . get_the_ID() . '">';
                    echo '  <div class="name-box-text-block">';
                    echo '      <div class="name-box-head" id="get-around">';
                    echo strtoupper(get_the_title());
                    echo '      </div>'; // name-box-head
                    echo '      <div class="name-box-icon">';
                    echo '      <img src="' . get_field('place_icon_image') . '" />';
                    echo '      </div>'; // name-box-sub-head
                    echo '  </div>'; // name-box-text-block
                    echo '  <a href="#descr-area-box-' . get_the_ID() . '">';
                    echo '      <p class="exc-text-yellow"><span>Replacing</span></p>';
                    echo '  </a>';
                    echo '</li>'; // name-box
                    // image pulled is based on what device is being used
                    $ismobile = false;
                    if (is_tablet() || is_mobile()) {
                        // use mobile cropped image
                        $imgfile = get_field('resident_mobile_img');
                        $ismobile = true;
                    } else {
                        $imgfile = get_the_post_thumbnail();
                    }
                    // count the number of words in the description text and split the text in half
                    $fulldescrtext = get_the_content();
                    array_push($descrinfo, array(
                                                    'pic' => $imgfile,
                                                    'ismobile' => $ismobile,
                                                    'address' => get_field('places_address'),
                                                    'gmap' => get_field('place_gmap'),
                                                    'descr' => $fulldescrtext,
                                                    'box-id' => get_the_ID()
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
                        
                        // build the description section before starting a new row
                        build_descr_box($descrinfo, $currowcount);
                        
                        // clear the description information array
                        $descrinfo = array();
                        
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
                      echo '  <a href="#descr-area-box-' . $curcolcount . $currowcount . '"></a>';
                      //echo '      <p class="exc-text"><span>Replacing</span></p>';
                      //echo '  </a>';
                      echo '&nbsp;</li>';
                      $curcolcount++;
                  }
                  echo "</ul>"; // close the list
                  // build the remaining description information boxes
                  build_descr_box($descrinfo, $currowcount);
                  // build any blank description boxes so the easytabs will work
                  while ($savedcolcount <= $maxcolumns) {
                      echo '<div class="" id="descr-area-box-' . $savedcolcount . $currowcount . '"></div>';
                      $savedcolcount++;
                  }
                  echo '</div><!-- #tab-container' . $currowcount . '-->';
                  $currowcount++;
              }
            ?>
    </main>
</div>
<?php
// function to build the description details under each description box
// Parameters: array $descrdetail
function build_descr_box ($descrdetail, $rownum) {
    $descrnum = 1; // track the number of description details being displayed
    
    foreach ($descrdetail as $descrtext) {
        echo '<div class="" id="descr-area-box-' . $descrtext['box-id'] . '"';
        // need inline style to clear floats when starting a new row
        if ($descrnum == 1) {
            echo ' style="clear:both"';
        }
        echo '>'; // descr-area-box
        echo '  <div class="descr-pic-box">';
        if ($descrtext['ismobile']) {
            echo '<img src="' . $descrtext['pic'] . '" />';
        } else {
            echo $descrtext['pic'];
        }
        echo '  </div>';
        echo '  <div class="descr-map-box">';
        echo '      <div class="descr-map">';
        echo '<a href="http://maps.google.com/maps/?daddr=' . str_replace(" ", "+", $descrtext['address']) . '">';
        echo '<img src="' . $descrtext['gmap']['url'] . '" />';
        echo '</a>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="descr-text-box-container">';
        echo '      <div class="descr-text-3-box">';
        echo '          <div class="descr-text">';
        echo $descrtext['descr'];
        echo '          </div>';
        echo '      <div class="descr-text-4-box">';
        echo '          <div class="links-text alt" id="getaround">';
        echo '<a class="yellow-link" href="mailto:?subject=' . $descrtext['post-title'] . '&amp;body=' . $descrtext['post-title'] . '%20-%20' . htmlentities($descrtext['descr']) . '">';
        echo '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text">Forward to Friends</div></a><br />';
        echo '<a href="#" onclick="javascript:window.print();">';
        echo '<div class="social-icon"><i class="fa fa-print"></i></div><div class="share-text">Print</div>';
        echo '</a><br />';
        echo '</div>';
        echo '      <div class="link-dir-area2 short">';
        echo '      <div class="social-icon"><i class="fa fa-map-marker"></i></div><div class="share-text">Get Personalized Directions</div><br />';
        echo '<form id="gdirects" action="http://maps.google.com/maps" method="get" target="_blank">
                <input type="text" name="saddr" placeholder="ENTER START ADDRESS" />
                <input type="hidden" name="daddr" value="' . $descrtext['address'] . '" />
                <input type="hidden" name="dirflg" value="r" />
                <input type="hidden" name="mra" value="ltm" />
                <input type="hidden" name="t" value="m" />
                <input type="hidden" name="z" value="8" />
                <input type="submit" value="GO" />
             </form>';
        echo '      </div>';
        echo '      </div>';
        echo '      </div>';
        
        echo '  </div>';
        echo '</div>';
        $descrnum++;
    }
}

// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
    $arr = preg_split("/[\s]+/", $str, $words+1);
    $arr = array_slice($arr, $startat, $words);
    return join(' ', $arr);
}
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
</script>
<?php get_footer(); ?>