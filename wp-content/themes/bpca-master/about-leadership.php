<?php

/**
 * Template Name: About Us Leadership
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="breadcrumbs">
				<?php if (function_exists('bcn_display') && ! is_home()) bcn_display(); ?>
			</div>

			<div class="about-leaders">
				<ul class="leaders">
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

						// start ze loop!
						while ($loop->have_posts()) : $loop->the_post();
					?>
						<li class="leader">
							<div class="leader-content">
								<div class="leader-info">
									<ul class="leader-info-list">
										<li><h2><?php the_title() ?></h2></li>
										<li><?php the_field('position_title') ?></li>
										<li><?php the_field('confirmed_on') ?></li>
									</ul>
								</div><!-- .leader-info -->
								<div class="leader-image">
									<?php the_post_thumbnail() ?>
								</div><!-- .leader-image -->
							</div><!-- .leader-content -->
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!-- .about-leaders -->
		</main>
	</div>

<?php get_footer(); ?>
