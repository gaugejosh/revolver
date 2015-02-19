<?php

/**
* Template Name: Links
* 
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="section-title">
            LINKS
        </div>
        <div class="links-area-container">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Links Area 1') ) : ?>  
<?php endif; ?>
            <div style="clear:both;"></div>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Links Area 2') ) : ?>  
<?php endif; ?>
        </div>
    </main>
</div>


<?php get_footer(); ?>