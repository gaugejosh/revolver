<?php

/**
* Template Name: News - Blog
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
                }
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
        <div class="blog-container">
            <div class="blog-head-container">

                <div class="event-image-area">
                <?=the_post_thumbnail();?>
                </div>
<div class="blog-sidebar">
                <span class="filter-head">FILTER BY FOCUS AREA</span><br />
                <form name="filter-cat" id="filter-cat" method="POST" action="<?php echo get_permalink(); ?>">
                    <div class="cat-sel-col">
                    <div class="cat-wrapper">
                    <div class="checker big">
                    <span class="<?php if (array_search('community', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="community-check" class="cat-check" name="cat[]" value="community"  
                        <?php if (array_search('community', $catarray) !== false) { echo 'checked'; } ?>
                           />
                    </span>
                    </div>
                    <div class="styled-checks colored">
                    <label for="community-check">
                    <div class="cat-yellow" id="cat-box-blog">
                        <div class="cat-text">
                            COMMUNITY
                        </div>
                    </div>
                    </div>
                    </label>
                    </div>
                    
                    <div class="cat-wrapper">
                    <div class="checker big">
                    <span class="<?php if (array_search('art-culture', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="art-check" class="cat-check" name="cat[]" value="art-culture" 
                           <?php if (array_search('art-culture', $catarray) !== false) { echo 'checked'; } ?>
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
                    </div>
                    
                    <div class="cat-wrapper">
                    <div class="checker big">
                    <span class="<?php if (array_search('environment', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="enviro-check" class="cat-check" name="cat[]" value="environment" 
                           <?php if (array_search('environment', $catarray) !== false) { echo 'checked'; } ?>
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
                    </div>
                    </div>
                    <div class="cat-sel-col">
                    <div class="cat-wrapper">
                        <div class="checker big">
                    <span class="<?php if (array_search('bpc-people', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="people-check" class="cat-check" name="cat[]" value="bpc-people" 
                           <?php if (array_search('bpc-people', $catarray) !== false) { echo 'checked'; } ?>
                           />
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
                    </div>
                    
                    <div class="cat-wrapper">
                        <div class="checker big">
                    <span class="<?php if (array_search('governance', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="gov-check" class="cat-check" name="cat[]" value="governance" 
                           <?php if (array_search('governance', $catarray) !== false) { echo 'checked'; } ?>
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
                    </div>
                    
                    <div class="cat-wrapper">
                         <div class="checker big">
                    <span class="<?php if (array_search('rfpbid-opps', $catarray) !== false) { echo 'checked'; } ?>">
                    <input type="checkbox" id="bid-check" class="cat-check" name="cat[]" value="rfpbid-opps" 
                           <?php if (array_search('rfpbid-opps', $catarray) !== false) { echo 'checked'; } ?>
                           />
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
                    </div>
                    </div>
                    <input type="hidden" name="filter-by-cat" value="filter" />
                    <input type="submit" class="cat-button blog" name="filter-by-cat" value="GO" />
                </form>
            </div> <!-- .blog-sidebar -->
            </div>
            <div class="blog-list">
                <?php
                // is this the default setting for the page?
                if (sizeof($catarray) == 0) {
                    // put all of the categories to show into the array
                    array_push($catarray, 'community');
                    array_push($catarray, 'art-culture');
                    array_push($catarray, 'environment');
                    array_push($catarray, 'bpc-people');
                    array_push($catarray, 'governance');
                    array_push($catarray, 'rfpbid-opps');
                }
                // for pagination
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                // create loop to display all descriptions from the post type
                $args = array( 'post_type' => 'post', 
                               'posts_per_page' => 8,
                               'paged' => $paged,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'category',
                                                'field'    => 'slug',
                                                'terms'    => $catarray,
                                        ),
                                ),
                               'orderby' => 'date', 
                               'order' => 'DESC'
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="blog-disp-container">';
                echo '<div class="blog-date-cat list">';
                echo '  <div class="blog-date-format">';
                echo get_the_date('n/j');
                echo '  </div>';
                $categories = get_the_category(get_the_ID());
                if($categories){
                    foreach($categories as $category) {
                        echo '<div class="';
                        switch ($category->slug) {
                            case 'community':
                                echo 'cat-yellow';
                                break;
                            case 'art-culture':
                                echo 'cat-blue';
                                break;
                            case 'environment':
                                echo 'cat-black';
                                break;
                            case 'bpc-people':
                                echo 'cat-drk-blue';
                                break;
                            case 'governance':
                                echo 'cat-drk-gray';
                                break;
                            case 'rfpbid-opps':
                                echo 'cat-light-gray';
                                break;
                        }
                            echo '" id="list-cat-boxes" style="float: left">';
                            echo '<div class="cat-text">';
                            echo strtoupper($category->name) . '</div></div>';
                    }
                }
                echo '</div>';
                echo '<div class="blog-list-cont">';
                echo '<div class="blog-list-sized">';
                echo '<span class="blog-title">' . strtoupper(get_the_title()) . '</span><br />';
                echo '<span class="blog-text">';
                // custom excerpt being used?
                if (get_field('blog_custom_excerpt') != "") {
                    // use custom excerpt
                    echo get_field('blog_custom_excerpt');
                } else {
                    // use default excerpt
                    echo get_the_excerpt();
                }
                echo '</span><br /><br />';
                echo '<div class="blog-img">' . get_the_post_thumbnail() . "</div><br />";
                echo '</div>';
                echo '<div class="blog-read-more">';
                echo '<a href="' . get_permalink(get_the_ID()) . '" id="rm-black">READ MORE</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                endwhile;
                ?>
            </div> <!-- blog-list -->
            <div class="blog-pages">
                <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $loop->max_num_pages,
                            'prev_text'=> __('PREV'),
                            'next_text'=> __('NEXT'),
                    ));
                ?>
            </div>
        </div> <!-- .blog-container -->
    </main>
</div>
<script language="javascript">
    /*
jQuery('#community-check').on('ifChecked', function(event) {
    jQuery('#community-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#community-check').on('ifUnchecked', function(event) {
    jQuery('#community-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});

jQuery('#art-check').on('ifChecked', function(event) {
    jQuery('#art-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#art-check').on('ifUnchecked', function(event) {
    jQuery('#art-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});

jQuery('#enviro-check').on('ifChecked', function(event) {
    jQuery('#enviro-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#enviro-check').on('ifUnchecked', function(event) {
    jQuery('#enviro-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});

jQuery('#people-check').on('ifChecked', function(event) {
    jQuery('#people-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#people-check').on('ifUnchecked', function(event) {
    jQuery('#people-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});

jQuery('#gov-check').on('ifChecked', function(event) {
    jQuery('#gov-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#gov-check').on('ifUnchecked', function(event) {
    jQuery('#gov-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});

jQuery('#bid-check').on('ifChecked', function(event) {
    jQuery('#bid-check').iCheck('check');
    jQuery('#filter-cat').submit();
});
        
jQuery('#bid-check').on('ifUnchecked', function(event) {
    jQuery('#bid-check').iCheck('uncheck');
    jQuery('#filter-cat').submit();
});
*/
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
</script>
<?php get_footer(); ?>