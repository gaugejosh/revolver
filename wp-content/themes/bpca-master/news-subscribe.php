<?php

/**
* Template Name: News - Subscribe
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
        <div class="blog-container">
            <div id="page-quote-blue">
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
            <div class="section-title">
                ALERT SUBSCRIPTIONS
            </div>
    <div class="newsletter newsletter-subscription">
        <div class="bold-text">OPT-IN TO THE ALERTS THAT MATTER MOST TO YOU</div>
        <p class="regular-text">Web alerts are emails that notify you of new website content and BPCA information.
Alerts are available for the areas of the site listed below.
Complete the form below to receive web alerts. You can subscribe to multiple alerts.
</p>
    <form method="post" action="http://bpca.revolverbranding.com/wp-content/plugins/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">
        <p class="bold-text subs">SUBSCRIBER DETAILS:</p>
        <input class="newsletter-email" type="email" name="ne" size="100" placeholder="ENTER EMAIL ADDRESS" required><br /><br /><br />
        <p class="bold-text alerts">WEB ALERTS:</p>
        <div class="cat-sel-col news-sub">
                    <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="community-check" class="cat-check" name="nl[]" value="1" />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="community-check">
                        <div class="cat-yellow" id="cat-box-blog">
                        <div class="cat-text">
                            COMMUNITY
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="art-check" class="cat-check" name="nl[]" value="2" />
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
                    <span class="">
                    <input type="checkbox" id="bid-check" class="cat-check" name="nl[]" value="6" />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="bid-check">
                        <div class="cat-light-gray" id="cat-box-blog">
                        <div class="cat-text">
                        RFP/BID OPPS.
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    </div>
                    <div class="cat-sel-col news-sub">
                        <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="people-check" class="cat-check" name="nl[]" value="4" />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="people-check">
                        <div class="cat-drk-blue" id="cat-box-blog">
                        <div class="cat-text">
                            BPC PEOPLE
                        </div>
                    </div>
                    </label>
                    </div>
                    <br />
                    <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="gov-check" class="cat-check" name="nl[]" value="5" />
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
                    <span class="">
                    <input type="checkbox" id="enviro-check" class="cat-check" name="nl[]" value="3" />
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
                    </div><br />
                    <br />
                    <div class="news-sub-checks">
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="ae" name="nl[]" value="7" />
                    </span>
                    </div>
                    <div class="styled-check"> 
                    <label for="ae"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Architechture/Engineering</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="urban" name="nl[]" value="8" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="urban"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Urban Planning</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="construct" name="nl[]" value="9" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="construct"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Construction</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="construct-manage"name="nl[]" value="10" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="construct-manage"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Construction Management</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="consult" name="nl[]" value="11" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="consult"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Consulting</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="inspect" name="nl[]" value="12" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="inspect"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Inspections/Testing</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="expedite" name="nl[]" value="13" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="expedite"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Expediting/Permitting</div></div><br />
                    </div>
                    <div class="sub-checker disabled">
                    <span class="disabled">
                    <input type="checkbox" class="sub-cat-check" id="prop-service" name="nl[]" value="14" />
                    </span>
                    </div>
                    <div class="styled-check">
                    <label for="prop-service"></label>&nbsp;<div class="news-check-contain"><div class="news-check-text">Property Service and Maintenance</div></div><br />
                    </div>
                    </div>
                    <br /><br />
                    <div class="news-button">
                    <input class="newsletter-submit" type="submit" value="Subscribe"/>
                    </div>
    </form>
    </div>
</div>
        <div class="teaser-area">
            <!-- Teaser 1 -->
            <div class="main-row-3-col-2">
                            <div class="mr3c2-text-block" style="color:#fff">
                                <div class="mr3c2-head-text teaser">
                                    DO YOU DREAM OF LIVING GREEN?
                                </div>
                                <div class="mr3c2-sub-text teaser">
                                   SEE WHY BPC IS A LEED PIONEER!
                                </div>
                            </div>
                            <div class="box-read-more">
                                    <a id="rm-black" href="../..//residential-life/buildings/">READ MORE</a>
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
            <?php
                // only show the last one if the user is not on a mobile device
                if (!is_tablet() && !is_mobile())
                {
            ?>
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
            <?php
                }
            ?>
        </div>
    </main>
</div>
<script language="javascript">
/* Whenever Something is Checked, Filter The Results */
/*
jQuery(document).ready(function(){
    jQuery('.sub-cat-check').iCheck('disable');
    jQuery('.news-check-text').css({opacity:'0.3'});
});
jQuery('#bid-check').on('ifChecked', function(event) {
    jQuery('.sub-cat-check').iCheck('enable');
    jQuery('.news-check-text').css({opacity:'1'});
});
        
jQuery('#bid-check').on('ifUnchecked', function(event) {
    jQuery('.sub-cat-check').iCheck('uncheck');
    jQuery('.sub-cat-check').iCheck('disable');
    jQuery('.news-check-text').css({opacity:'0.3'});
});
*/
$(document).ready(function() {
    $('.news-check-text').css({opacity:'0.3'});
});

$('.checker span').click(function (){
    if ($(this).hasClass('checked')) {
        $(this).removeClass('checked');
        $(':checkbox', this).prop('checked', false);
    } else {
        $(this).addClass('checked');
        $(':checkbox', this).prop('checked', true);
    }
    
    // enable the bid checks?
    if ($('#bid-check').is(':checked')) {
        // enable the checkboxes
        $('.sub-checker').removeClass('disabled');
        $('.sub-checker span').removeClass('disabled');
        $('.news-check-text').css({opacity:'1'});
    } else {
        // disable the checkboxes
        $('.sub-checker').addClass('disabled');
        $('.sub-checker span').addClass('disabled');
        // remove any checked items
        $('.sub-checker span').removeClass('checked');
        $('.subchecker:checkbox').prop('checked', false);
        $('.news-check-text').css({opacity:'0.3'});
    }
});

$('.sub-checker span').click(function (){
    if ($(this).hasClass('checked')) {
        $(this).removeClass('checked');
        $(':checkbox', this).prop('checked', false);
    } else {
        $(this).addClass('checked');
        $(':checkbox', this).prop('checked', true);
    }
});
</script>

<?php get_footer(); ?>