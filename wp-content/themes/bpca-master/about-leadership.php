<?php

/**
 * Template Name: About Us Leadership
 */

// wordpress footer hook. do not remove or bearshark will find you
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="breadcrumbs">
			<?php if (function_exists('bcn_display') && ! is_home())
			{
				bcn_display();
			}
			?>
		</div>
		<!-- .breadcrumbs -->

		<div class="about-leaders">
			<ul class="grids">
				<?php
				$args = array(
					'post_type'      => 'leaders',
					'posts_per_page' => - 1,
					'meta_key'       => 'leader_order',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC'
				);

				// instantiate new WP_Query object
				$loop = new WP_Query($args);

				// create iterator for expanded content
				$i = 1;

				// start ze loop!
				while ($loop->have_posts()) : $loop->the_post();
					?>

					<li class="grid">
						<div class="grid-content">
							<div class="grid-info">
								<ul class="grid-info-list">
									<li><h2><?php the_title() ?></h2></li>
									<li><?php the_field('position_title') ?></li>
									<li><?php the_field('confirmed_on') ?></li>
								</ul>
							</div>
							<!-- .grid-info -->

							<div class="grid-image">
								<?php the_post_thumbnail() ?>
							</div>
							<!-- .grid-image -->

							<div class="grid-button"></div>
						</div>
						<!-- .grid-content -->

						<div class="grid-description">
							<div class="left-col">
								<p><?php the_field('bio_column_1') ?></p>
							</div>
							<!-- .left-col -->
							<div class="right-col">
								<p><?php the_field('bio_column_2') ?></p>
							</div>
							<!-- .right-col -->
						</div>
						<!-- .grid-description -->
					</li>

					<?php // insert the description container in the correct place ?>
					<?php if ($i % 3 === 0): ?>
						<li class="grid-alt">
						</li>
					<?php endif; ?>

					<?php // increment the iterator ?>
					<?php $i ++; ?>

				<?php endwhile; ?>
			</ul>
		</div>
		<!-- .about-grids -->
	</main>
</div><!-- #primary -->

<script src="http://revolver.dev/wp-content/themes/bpca-master/js/bpca-grid.js"></script>

<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
