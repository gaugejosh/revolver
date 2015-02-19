<?php
/**
 * The template for displaying search results pages.
 *
 * @package bpca-master
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
                        <div id="page-quote-blue">
            <div class="head-quote-text">
                &quot;Quote Goes Here&quot;
            </div>
            <div class="head-quote-attrib">
                Who Said It<br />
                What is their Title
            </div>
        </div>
            <div class="page-head-img">
                <img src='http://bpca.revolverbranding.com/wp-content/uploads/2015/01/2002_crop1.jpg' />
            </div>
        <div class="section-title">
                SEARCH RESULTS
            </div>
                    <div class="results-container">
		<?php if ( have_posts() ) : ?>

			<!--<header class="page-header">
				<h1 class="page-title"><?php //printf( __( 'Search Results for: %s', 'bpca-master' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                        </header><br /><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
                    </div>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_footer(); ?>
