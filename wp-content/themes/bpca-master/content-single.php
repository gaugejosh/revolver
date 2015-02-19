<?php
/**
 * @package bpca-master
 */
?>
 <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
</div>
<div class="blog-single-container">
        <div class="blog-container">
            <div class="blog-head-container">
            
            
                <div class="event-image-area">
                <img src="http://bpca.revolverbranding.com/wp-content/uploads/2015/01/piera_crop_use.jpg" />
                </div>
                <div class="blog-sidebar">
                <span class="filter-head disabled">FILTER BY FOCUS AREA</span><br />
                <form name="filter-cat" id="filter-cat" method="POST" action="">
                    <div class="cat-sel-col blog disabled">
                    <div class="cat-wrapper">
                    <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="community-check" class="cat-check" name="cat[]" value="community" disabled/>
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
                    <span class="">
                    <input type="checkbox" id="art-check" class="cat-check" name="cat[]" value="art-culture" disabled />
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
                    <span class="">
                    <input type="checkbox" id="enviro-check" class="cat-check" name="cat[]" value="environment" disabled />
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
                    <div class="cat-sel-col blog disabled">
                    <div class="cat-wrapper">
                        <div class="checker big">
                    <span class="">
                    <input type="checkbox" id="people-check" class="cat-check" name="cat[]" value="bpc-people" disabled />
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
                    <span class="">
                    <input type="checkbox" id="gov-check" class="cat-check" name="cat[]" value="governance" disabled />
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
                    <span class="">
                    <input type="checkbox" id="bid-check" class="cat-check" name="cat[]" value="rfpbid-opps" disabled />
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
                    <input type="submit" class="cat-button blog disabled" name="filter-by-cat" value="GO" disabled />
                </form>
            </div> <!-- .blog-sidebar -->
            </div>
    <div class="blog-date-cat">
        <div class="blog-date-format">
            <?php the_date('n/j'); ?>
        </div>
        <?php
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
        ?>
    </div> <!-- .blog-date-cat -->
    <div class="single-blog-list-cont" id="single-post">
        <span class="blog-title"><?php the_title(); ?></span><br />
        <span class="blog-text"><?php the_content(); ?></span>
        <?php echo '<img class="blogimg" src="' . get_field('blog_required_image') . '" />'; ?><br />
        <?php if (get_field('blog_image_2') != "") { ?>
        <?php echo '<img class="blogimg" src="' . get_field('blog_image_2'). '" />';?><br />
        <?php } ?>
        <?php if (get_field('blog_image_3') != "") { ?>
        <?php echo '<img class="blogimg" src="' . get_field('blog_image_3'). '" />';?>
        <?php } ?>
        <div class="blog-share">
   <?php
        echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">';
        echo '<div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-white">Share on Facebook</div>';
        echo '</a><br />';
        echo '<a href="http://twitter.com/share?text=' . get_the_title() . '&url=' . get_the_permalink() . '">';
        echo '<div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-white">Share on Twitter</div>';
        echo '</a><br />';
        echo '<a href="mailto:?subject=' . get_the_title() . '&amp;body=' . get_the_title() . '%20-%20' . get_the_permalink() . '">';
        echo '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-white">Forward to Friends</div></a><br />';
        echo '<a href="#" onclick="javascript:window.print();">';
        echo '<div class="social-icon"><i class="fa fa-print"></i></div><div class="share-text-white">Print</div>';
        echo '</a><br />';

    ?>
             
        </div>
        <div class="blog-read-more back">
    <a id="rm-black-blog" href="/news/blog">BACK TO BLOG HOMEPAGE</a>
    </div>
    </div> <!-- .blog-list-cont -->
   <br /><br />
</div> <!-- .blog-container -->
