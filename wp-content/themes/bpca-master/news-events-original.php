<?php

/**
* Template Name: News - Events
* 
*/

get_header(); 

// array of selected categories
$catarray = array();

// event display: upcoming by default and when filtering by category, all when a date is selected
$eventdisplay = 'upcoming';
$startdate = "none";
$enddate = "none";
if (array_key_exists('filter-by-cat', $_POST)) {
                    // build the category array
                    if (!empty($_POST['cat'])) {
                    foreach ($_POST['cat'] as $selcat) {
                        //echo $selcat . "<br />";
                        array_push($catarray, $selcat);
                    }
                }
                if ($_POST['filter-start-date'] != "none") {
                    // make sure the date wasn't previously selected
                    if ($_POST['current-date'] != date('Y-m-d', strtotime($_POST['filter-start-date']))) {
                        // filter by selected date
                        $eventdisplay = 'all';
                        $startdate = date('Y-m-d', strtotime($_POST['filter-start-date']));
                        $enddate = date('Y-m-d', strtotime($_POST['filter-end-date']));
                        $curday = date('d', strtotime($_POST['filter-start-date']));
                        $curdate = $startdate;
                        //echo $startdate . "<br />";
                        //echo $enddate . "<br />";
                    }
                    
                }
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }
                ?>
            </div>
        <div class="event-header-area">
            <div class="event-image-area">
                <?=the_post_thumbnail();?>
            </div>
            <div class="mobile-events">
                <div class="event-filter-area">
                <span class="filter-head">FILTER BY FOCUS AREA</span><br />
                <form name="filter-cat" id="filter-cat" method="POST" action="<?php echo get_permalink(); ?>">
                    <div class="cat-sel-col" id="events">
                    <div class="checker big">
                    <span class="<?php if (array_search('event-parks-rec', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="community-check" class="cat-check" name="cat[]" value="event-parks-rec"  
                        <?php if (array_search('event-parks-rec', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="community-check">
                    <div class="cat-yellow" id="cat-box-blog">
                        <div class="cat-text">
                            PARKS &amp; REC.
                        </div>
                    </div>
                    </label>
                    </div><br />
                    <div class="checker big">
                    <span class="<?php if (array_search('event-art-culture', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="art-check" class="cat-check" name="cat[]" value="event-art-culture" 
                           <?php if (array_search('event-art-culture', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="art-check">
                               <div class="cat-blue" id="cat-box-blog">
                        <div class="cat-text">
                        ART &amp; CULTURE
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    <div class="checker big">
                    <span class="<?php if (array_search('event-environment', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="enviro-check" class="cat-check" name="cat[]" value="event-environment" 
                           <?php if (array_search('event-environment', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="enviro-check">
                                <div class="cat-black" id="cat-box-blog">
                        <div class="cat-text">
                            ENVIRONMENT
                        </div>
                    </div>
                    </label>
                    </div>
                   <br />
                    </div>
                    <div class="cat-sel-col" id="events">
                        <div class="checker big">
                    <span class="<?php if (array_search('event-kids-family', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="people-check" class="cat-check" name="cat[]" value="event-kids-family" 
                           <?php if (array_search('event-kids-family', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="people-check">
                               <div class="cat-drk-blue" id="cat-box-blog">
                        <div class="cat-text">
                            KIDS &amp; FAMILY
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    <div class="checker big">
                    <span class="<?php if (array_search('event-governance', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="gov-check" class="cat-check" name="cat[]" value="event-governance" 
                           <?php if (array_search('event-governance', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="gov-check">
                               <div class="cat-drk-gray" id="cat-box-blog">
                        <div class="cat-text">
                        GOVERNANCE
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    <div class="checker big">
                    <span class="<?php if (array_search('event-volunteer', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="bid-check" class="cat-check" name="cat[]" value="event-volunteer"
                           <?php if (array_search('event-volunteer', $catarray) !== false) { echo ' checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="bid-check">
                                <div class="cat-light-gray" id="cat-box-blog">
                        <div class="cat-text">
                        VOLUNTEER
                        </div>
                    </div>
                    </label>
                    </div>
                   <br />
                    </div><br />
                    <input type="hidden" name="filter-start-date" id="filter-start-date" value="<?=$startdate;?>" />
                    <input type="hidden" name="filter-end-date" id="filter-end-date" value="<?=$enddate;?>" />
                    <input type="hidden" name="filter-by-cat" value="filter" />
                    <input type="hidden" name="current-date" value="<?=$curdate;?>" />
                    <input type="submit" class="cat-button events" name="filter-by-cat" value="GO" />
                </form>
            </div>
            
            <div class="calendar-area">
                <div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
						<div class="custom-header clearfix">
							<nav>
                                                            <span id="custom-prev" class="custom-prev">
                                                                <i class="fa fa-angle-left"></i>
                                                            </span>
                                                            <span id="custom-next" class="custom-next">
                                                                <i class="fa fa-angle-right"></i>
                                                            </span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
						</div>
						<div id="calendar" class="fc-calendar-container"></div>
					</div>
				</div>
            </div>
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
                    array_push($catarray, 'event-art-culture');
                    array_push($catarray, 'event-environment');
                    array_push($catarray, 'event-parks-rec');
                    array_push($catarray, 'event-kids-family');
                    array_push($catarray, 'event-volunteer');
                    array_push($catarray, 'event-governance');
                }
                
                // create loop to display all descriptions from the post type
                $args = array( 
                               'posts_per_page' => 15,
                               'eventDisplay' => $eventdisplay,
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'tribe_events_cat',
                                                'field'    => 'slug',
                                                'terms'    => $catarray,
                                        ),
                                )
                                //'start_date' => '2015-01-29',
                                //'end_date' => '2015-01-30'
                );
                if ($startdate != "none") {
                    // add the date filter
                    $args['start_date'] = $startdate;
                    $args['end_date'] = $enddate;
                }
                //echo tribe_get_meta();
                $eventdata = tribe_get_events ($args);
                foreach ($eventdata as $curevent) {
                    // create a new unordered list if this is a new row
                    if ($curcolcount == 1) {
                        echo '<div id="tab-container' . $currowcount . '">';
                        echo '<ul id="box-row-' . $curcolcount . '">';
                    }
                    echo '<li class="header-box" id="name-box-' . $curevent->ID . '">';
                    echo '  <div class="event-box-date-area">';
                    echo '  <div class="blog-date-format events">';
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
                            echo ' events" id="list-cat-boxes" style="float: left">';
                            echo '<div class="cat-text">';
                            echo strtoupper($showcategory) . '</div></div>';
                    }
                }
                    echo '  </div>';
                    echo '  <div class="event-box-text-block">';
                    echo '      <div class="name-box-head">';
                    echo strtoupper($curevent->post_title);
                    echo '      </div>'; // name-box-head
                    echo '      <div class="name-box-sub-head">';
                   // echo date('l F j', strtotime($curevent->EventStartDate));
                    //echo '      <br />';
                    //echo tribe_get_venue($curevent->ID);
                    echo tribe_get_start_time($curevent->ID) . ' - ' . tribe_get_end_time($curevent->ID);
                    echo '      </div>'; // name-box-sub-head
                    echo '  </div>'; // name-box-text-block
                    echo '  <a href="#descr-area-box-' . $curevent->ID . '">';
                    echo '      <p class="event-box-text"><span>Replacing</span></p>';
                    echo '  </a>';
                    echo '</li>'; // name-box
                    // image pulled is based on what device is being used
                    $ismobile = false;
                    if (is_tablet() || is_mobile()) {
                        // use mobile cropped image
                        $imgfile = get_field('resident_mobile_img');
                        if ($imgfile != "") {
                            $ismobile = true;
                        } else {
                            // the thumbnail is blank, use the featured image
                            $imgfile = tribe_event_featured_image($curevent->ID);
                        }
                        
                    } else {
                        $imgfile = tribe_event_featured_image($curevent->ID);
                    }
                    // grab all of the address information
                    $venuestreet = str_replace(' ', '+', tribe_get_address($curevent->ID));
                    $venuecity = str_replace(' ', '+', tribe_get_city($curevent->ID));
                    $venuestate = str_replace(' ', '+', tribe_get_state($curevent->ID));
                    $venuezip = str_replace(' ', '+', tribe_get_zip($curevent->ID));
                    $venueaddress = $venuestreet . '+' . $venuecity . '+' . $venuestate . '+' . $venuezip;
                    array_push($descrinfo, array(
                                                    'pic' => tribe_event_featured_image($curevent->ID),
                                                    'ismobile' => $ismobile,
                                                    'address' => $venueaddress,
                                                    'gmap' => get_field('event_custom_gmap_img', $curevent->ID),
                                                    'descr' => $curevent->post_content,
                                                    'gcal' => tribe_get_gcal_link($curevent->ID),
                                                    'ical' => tribe_get_single_ical_link(),
                                                    'email' => tribe_get_event_link(),
                                                    'event-title' => $curevent->post_title,
                                                    'box-id' => $curevent->ID,
                                                    'status' => get_field('event_custom_status', $curevent->ID),
                                                    'venue' => tribe_get_venue($curevent->ID),
                                                    'cost' => get_field('event_custom_cost', $curevent->ID),
                                                    'tickets' => get_field('event_buy_tickets', $curevent->ID)
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
                }
                
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
        echo '<a href="http://maps.google.com/maps/?daddr=' . str_replace(" ", "+", $descrtext['address']) . '" target="_blank">';
        echo '<img src="' . $descrtext['gmap'] . '" />';
        echo '</a>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="descr-text-box-container events-page">';
        echo '      <div class="descr-text-3-box events-page">';
        echo '          <div class="descr-text">';
        echo 'Status: ';
        if ($descrtext['status'] == 'off') {
            echo '<span style="color:#8C1C1C">CANCELLED</span>';
        } else {
            echo 'This event will occur as scheduled';
        }
        echo '<br />';
        echo 'Venue: ' . $descrtext['venue'] . '<br />';
        echo 'Cost: ' . $descrtext['cost'] . '<br />';
        if ($descrtext['tickets'] != "") {
             echo 'Tickets: ' . $descrtext['tickets'] . '<br />';
        }
        echo '<br />';
        echo  $descrtext['descr'];
        echo '          </div>';
        echo '      <div class="descr-text-blue-links-box" id="resident">';
        echo '          <div class="links-text alt" id="white-links">';
        echo '<a href="mailto:?subject=' . $descrtext['event-title'] . '&amp;body=' . $descrtext['event-title'] . '%20-%20' . $descrtext['email'] . '">';
        echo '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-white">Forward to Friends</div></a><br />';
        echo '<a href="' . $descrtext['gcal'] . '" target="_blank">';
        echo '<div class="social-icon"><i class="fa fa-google"></i></div><div class="share-text-white">Add to Google Calendar</div>';
        echo '</a><br />';
        echo '<a href="' . $descrtext['ical'] . '" target="_blank">';
        echo '<div class="social-icon"><i class="fa fa-calendar"></i></div><div class="share-text-white">Add to iCal</div>';
        echo '</a><br />';
        echo '<a href="#" onclick="javascript:window.print();">';
        echo '<div class="social-icon"><i class="fa fa-print"></i></div><div class="share-text-white">Print</div>';
        echo '</a><br />';
        echo '<a href="http://twitter.com/share?text=' . $descrtext['event-title'] . '&url=' . $descrtext['email'] . '">';
        echo '<div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-white">Share on Twitter</div>';
        echo '</a><br />';
        echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $descrtext['email'] . '">';
        echo '<div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-white">Share on Facebook</div>';
        echo '</a>';
        echo '          </div>';
        echo '      <div class="link-dir-area-white short">';
        echo '      <div class="social-icon"><i class="fa fa-map-marker"></i></div><div class="share-text-white">Get Personalized Directions</div><br />';
        echo '<form id="gdirects-white" action="http://maps.google.com/maps" method="get" target="_blank">
                <input type="text" name="saddr" placeholder="ENTER START ADDRESS" />
                <input type="hidden" name="daddr" value="' . $descrtext['address'] . '" />
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
?>
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
    //$('#filter-cat').submit();
});
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
              //defaultTab: '#default-tab'
            });
</script>
<script type="text/javascript">
$(function() {
					$wrapper = $( '#custom-inner' ),
					$calendar = jQuery( '#calendar' ),
					cal = $calendar.calendario( {
						onDayClick : function( $el, $contentEl, dateProperties ) {
                                                    /*
                                                        var stmonth = dateProperties.month;
                                                        if (stmonth <= 9) {
                                                            stmonth = '0' + stmonth;
                                                        }
                                                        var stday = dateProperties.day;
                                                        if (stday <= 9) {
                                                            stday = '0' + stday;
                                                        }
                                                        var styear = dateProperties.year;
                                                        */
                                                        var stdate = dateProperties.year + '-' + dateProperties.month + '-' + dateProperties.day;
                                                        var formatteddate = dateProperties.month + '/' + dateProperties.day + '/' + dateProperties.year;
                                                        var eddate = new Date(formatteddate);
                                                        //console.log(eddate);
                                                        eddate.setDate(eddate.getDate() + 1);
                                                        var neweddate = eddate.getFullYear() + "-" + (eddate.getMonth() + 1) + "-" + eddate.getDate();
                                                        //console.log(neweddate);
                                                        $( '#filter-start-date' ).val(stdate);
                                                        $( '#filter-end-date').val(neweddate);
                                                        $( '#filter-cat' ).submit();
						},
                                                startIn: 0,
                                                <?php
                                                    if ($startdate != "none") {
                                                        // preserve the month and day being viewed
                                                        $thistime = strtotime($startdate);
                                                        $thismonth = date('n', $thistime);
                                                        $thisyear = date('Y', $thistime);
                                                        echo 'month:' . $thismonth . ',';
                                                        echo 'year:' . $thisyear . ',';
                                                    }
                                                ?>
						displayWeekAbbr : true
					} ),
					$month = $( '#custom-month' ).html( cal.getMonthName() + ' ' + cal.getYear()),
					//$year = $( '#custom-year' ).html( cal.getYear() );

				$( '#custom-next' ).on( 'click', function() {
					cal.gotoNextMonth( updateMonthYear );
				} );
				$( '#custom-prev' ).on( 'click', function() {
					cal.gotoPreviousMonth( updateMonthYear );
				} );
                                
                                <?php
                                    if ($curday != "") {
                                ?>
                                        $('.fc-date:contains("<?=$curday;?>")').addClass("CurDate");
                                <?php
                                    }
                                ?>
                                       
                                

				function updateMonthYear() {				
					$month.html( cal.getMonthName() + ' ' + cal.getYear() );
					//$year.html( cal.getYear() );
				}
			}); 
</script>
<script language="javascript">
    // submits the filter form when a user clicks a checkbox
    function submitform() {
        var formid = document.getElementById('filter-cat');
        formid.submit();
    }
</script>
<?php get_footer(); ?>