<?php

/**
* Template Name: Residential - Buildings
* 
*/

get_header(); 

// array of selected categories
$catarray = array();
if (array_key_exists('filter-by-cat', $_POST)) {
                    // build the category array
                    if (!empty($_POST['cat'])) {
                    foreach ($_POST['cat'] as $selcat) {
                        //echo $selcat . "<br />";
                        array_push($catarray, $selcat);
                    }
                    // see if the green boxes were checked, if so, don't filter by the parent
                    if (in_array('apt-green', $catarray) && in_array('apartments', $catarray)) {
                        $remindex = array_search('apartments', $catarray);
                        unset($catarray[$remindex]);
                    }
                    
                    if (in_array('condo-green', $catarray) && in_array('condos', $catarray)) {
                        $remindex = array_search('condos', $catarray);
                        unset($catarray[$remindex]);
                    }
                }
}

if (array_key_exists('leed', $_GET)) {
    //array_push($catarray, 'apartments');
    array_push($catarray, 'apt-green');
    //array_push($catarray, 'condos');
    array_push($catarray, 'condo-green');
}

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
            </div>
        <div class="building-header-area">
            <div class="event-image-area">
                <?=the_post_thumbnail();?>
            </div>
            <div class="building-filter-area">
                <span class="filter-head">FILTER BY BUILDING TYPE</span><br />
                <form name="filter-cat" id="filter-cat" method="POST" action="<?php echo get_permalink(); ?>">
                    <div class="cat-sel-col">
                    <div class="cat-wrapper" id="buildings">
                    <div class="checker big">
                    <span class="apts <?php if (array_search('apartments', $catarray) !== false || array_search('apt-green', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="rental-check" name="cat[]" value="apartments"  
                        <?php if (array_search('apartments', $catarray) !== false || array_search('apt-green', $catarray) !== false) { echo 'checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="rental-check">
                    <div class="cat-yellow" id="cat-box-blog">
                        <div class="cat-text">
                            APARTMENT
                        </div>
                    </div>
                    </label>
                    </div>
                    </div>
                    <div class="indent-cat" id="apt-green-cat">
                    <div class="checker big apts
                         <?php if (array_search('apartments', $catarray) === false && array_search('apt-green', $catarray) === false) { echo ' disabled'; } ?>
                         ">
                    <span class="apts-green 
                          <?php if (array_search('apartments', $catarray) === false && array_search('apt-green', $catarray) === false) { echo 'disabled'; } ?>
                           <?php if (array_search('apt-green', $catarray) !== false) { echo 'checked'; } ?>
                          ">
                    <input type="checkbox" id="apt-green-check" name="cat[]" value="apt-green" 
                           <?php if (array_search('apartments', $catarray) === false && array_search('apt-green', $catarray) === false) { echo 'disabled'; } ?>
                           <?php if (array_search('apt-green', $catarray) !== false) { echo 'checked'; } ?>
                           />
                    </span>
                    </div>
                     <div class="styled-checks colored">   
                    <label for="apt-green-check">
                               <div class="cat-light-gray apts 
                                    <?php
                                        if (array_search('apartments', $catarray) === false && array_search('apt-green', $catarray) === false) { echo ' leed'; }
                                    ?>
                                    " id="cat-box-blog">
                        <div class="cat-text" id="build-green-text">
                        GREEN
                        </div>
                    </div>
                    </label>
                     </div>
                    </div><br />
                    <div class="cat-wrapper" id="buildings">
                    <div class="checker big">
                    <span class="condo <?php if (array_search('condos', $catarray) !== false || array_search('condo-green', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="condo-check" name="cat[]" value="condos" 
                           <?php if (array_search('condos', $catarray) !== false || array_search('condo-green', $catarray) !== false) { echo 'checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="condo-check">
                                <div class="cat-blue" id="cat-box-blog">
                        <div class="cat-text">
                           CONDO
                        </div>
                    </div>
                    </label>
                    </div>
                    </div>
                   <div class="indent-cat" id="condo-green-cat">
                   <div class="checker big condo
                         <?php if (array_search('condos', $catarray) === false && array_search('condo-green', $catarray) === false) { echo ' disabled'; } ?>
                        ">
                    <span class="condo-green 
                          <?php if (array_search('condos', $catarray) === false && array_search('condo-green', $catarray) === false) { echo 'disabled'; } ?>
                           <?php if (array_search('condo-green', $catarray) !== false) { echo 'checked'; } ?>
                          ">
                    <input type="checkbox" id="condo-green-check"  name="cat[]" value="condo-green"
                           <?php if (array_search('condos', $catarray) === false && array_search('condo-green', $catarray) === false) { echo 'disabled'; } ?>
                           <?php if (array_search('condo-green', $catarray) !== false) { echo 'checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">  
                    <label for="condo-green-check">
                               <div class="cat-light-gray condo
                                    <?php if (array_search('condos', $catarray) === false && array_search('condo-green', $catarray) === false) { echo ' leed'; } ?>
                                    " id="cat-box-blog">
                        <div class="cat-text" id="build-green-text">
                            GREEN
                        </div>
                    </div>
                    </label>
                    </div>
                   </div>
                    <br />
                    </div>
                    <input type="hidden" name="filter-by-cat" value="filter" />
                    <input type="submit" class="cat-button buildings" name="filter-by-cat" value="GO" />
                </form>
            </div>
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
                
                if (sizeof($catarray) == 0) {
                    // default to all categories
                    array_push($catarray, 'apartments');
                    array_push($catarray, 'apt-green');
                    array_push($catarray, 'condos');
                    array_push($catarray, 'condo-green');
                }
                
                // create loop to display all descriptions from the post type
                $args = array( 'post_type' => 'resident', 
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'resident_categories',
                                                'field'    => 'slug',
                                                'terms'    => $catarray,
                                        ),
                                )
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    // create a new unordered list if this is a new row
                    if ($curcolcount == 1) {
                        echo '<div id="tab-container' . $currowcount . '">';
                        echo '<ul id="box-row-' . $currowcount . '">';
                    }
                    echo '<li class="header-box" id="name-box-' . get_the_ID() . '">';
                    echo '  <div class="event-box-date-area" id="buildings">';
                    if (get_field('resident_leed_level') != "None" && get_field('resident_leed_level') != "") {
                        echo '  <div class="blog-date-format buildings" id="leed-level">';
                        echo strtoupper(get_field('resident_leed_level'));
                        echo '  </div>';
                    }
                    $categories = get_the_terms(get_the_ID(), 'resident_categories');
                    //print_r($categories);
                if($categories){
                    $showcategory = "";
                    foreach($categories as $category) {
                        if ($category->slug != 'buildings') {
                            echo '<div class="';
                            switch ($category->slug) {
                                case 'apartments':
                                    $showcategory = "APARTMENT";
                                    echo 'cat-yellow';
                                    break;
                                case 'apt-green':
                                    $showcategory = "GREEN";
                                    echo 'cat-light-gray';
                                    break;
                                case 'condos':
                                    $showcategory = "CONDO";
                                    echo 'cat-blue';
                                    break;
                                case 'condo-green':
                                    $showcategory = "GREEN";
                                    echo 'cat-light-gray';
                                    break;
                            }
                                // add another styling class if needed
                                if (get_field('resident_leed_level') == "None" || get_field('resident_leed_level') == "") {
                                    echo ' noleed';
                                }
                                echo '" id="build-cat-boxes" style="float: left">';
                                echo '<div class="cat-text">';
                                echo $showcategory . '</div></div>';
                        }
                    }
                }
                    echo '  </div>';
                    echo '  <div class="name-box-text-block building">';
                    echo '      <div class="name-box-head" id="buildings">';
                    echo strtoupper(get_the_title());
                    echo '      </div>'; // name-box-head
                    echo '      <div class="name-box-sub-head" id="buildings">';
                    if (get_field('resident_completed_year') != "") {
                    echo        the_field('resident_completed_year');
                    echo '      <br />';
                    }
                    if (get_field('resident_assoc_names') != "") {
                    echo        the_field('resident_assoc_names');
                    echo '      <br />';
                    }
                    echo        the_field('resident_address');
                    echo '      </div>'; // name-box-sub-head
                    echo '  </div>'; // name-box-text-block
                    echo '  <a href="#descr-area-box-' . get_the_ID() . '">';
                    echo '      <p class="exc-text buildings"><span>Replacing</span></p>';
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
                                                    'gmap' => get_field('resident_gmaps'),
                                                    'map_addr' => get_field('resident_map_address'),
                                                    'descr' => $fulldescrtext,
                                                    'post-text' => get_permalink(),
                                                    'post-title' => get_the_title(),
                                                    'website' => get_field('resident_site_url'),
                                                    'leed-info' => get_field('resident_leed_info_link'),
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
        //echo $descrtext['address'];
        echo '<a href="http://maps.google.com/maps/?daddr=' . str_replace(" ", "+", $descrtext['map_addr']) . '">';
        echo '<img src="' . $descrtext['gmap']['url'] . '" />';
        echo '</a>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="descr-text-box-container events-page">';
        echo '      <div class="descr-text-3-box events-page">';
        echo '          <div class="descr-text">';
        echo $descrtext['descr'];
        echo '          </div>'; 
        echo '      <div class="descr-text-blue-links-box" id="resident">';
        echo '          <div class="links-text alt" id="white-links">';
        echo '<a href="mailto:?subject=' . $descrtext['post-title'] . '&amp;body=' . $descrtext['post-title'] . '%20-%20' . $descrtext['post-text'] . '">';
        echo '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-white">Forward to Friends</div></a><br />';
        echo '<a href="http://twitter.com/share?text=' . $descrtext['post-title'] . '&url=' . $descrtext['post-text'] . '">';
        echo '<div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-white">Share on Twitter</div>';
        echo '</a><br />';
        echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $descrtext['post-text'] . '">';
        echo '<div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-white">Share on Facebook</div>';
        echo '</a>';
        if ($descrtext['website'] != "") {
        echo '      <br /><a href="' . $descrtext['website'] . '" class="website-white-link" target="_blank">';
        echo '      <div class="social-icon site"><div class="website-img-swap"></div></div>';
        //echo '      <img src="' . get_template_directory_uri() . '/images/website_trace-01.jpg" style="width:30px;height:30px;" />';
        echo '<div class="share-text-white site">Visit the Site</div>';
        echo '      </a>';
        }
        echo '          </div>';
        echo '      <div class="link-dir-area-white short">';
        echo '      <div class="social-icon"><i class="fa fa-map-marker"></i></div><div class="share-text-white">Get Personalized Directions</div><br />';
        echo '<form id="gdirects-white" action="http://maps.google.com/maps" method="get" target="_blank">
                <input type="text" name="saddr" placeholder="ENTER START ADDRESS" />
                <input type="hidden" name="daddr" value="' . $descrtext['map_addr'] . '" />
                <input type="submit" value="GO" />
             </form>';
        echo '      </div>';
        echo '      </div>';
        echo '      </div>'; // descr-text-3-box
        
        echo '  </div>'; // descr-text-box-container
        echo '</div>'; // descr-area-box
        $descrnum++;
    }
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
<script language="javascript">
    $('.checker span').click(function (){
    if ($(this).hasClass('checked')) {
        $(this).removeClass('checked');
        $(':checkbox', this).prop('checked', false);
    } else {
        $(this).addClass('checked');
        $(':checkbox', this).prop('checked', true);
    }
    
    // enable the green check for apartments?
    if ($('#rental-check').is(':checked')) {
        // enable the green checkbox
        $('.checker.apts').removeClass('disabled');
        $('.checker.apts span').removeClass('disabled');
        $('.cat-light-gray.apts').css({opacity:'1'});
    } else {
        // disable the checkboxes
        $('.checker.apts').addClass('disabled');
        $('.checker.apts span').addClass('disabled');
        // remove any checked items
        $('.checker.apts span').removeClass('checked');
        $('.checker.apts:checkbox').prop('checked', false);
        $('.cat-light-gray.apts').css({opacity:'0.3'});
    }
    
    // enable the green check for condos?
    if ($('#condo-check').is(':checked')) {
        // enable the green checkbox
        $('.checker.condo').removeClass('disabled');
        $('.checker.condo span').removeClass('disabled');
        $('.cat-light-gray.condo').css({opacity:'1'});
    } else {
        // disable the checkboxes
        $('.checker.condo').addClass('disabled');
        $('.checker.condo span').addClass('disabled');
        // remove any checked items
        $('.checker.condo span').removeClass('checked');
        $('.checker.condo:checkbox').prop('checked', false);
        $('.cat-light-gray.condo').css({opacity:'0.3'});
    }
});
</script>
<?php get_footer(); ?>