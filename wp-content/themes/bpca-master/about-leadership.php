<?php

/**
 * Template Name: About Us Leadership
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
				<?php if (function_exists('bcn_display') && ! is_home())
				{
					bcn_display();
				} ?>
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

						// start the loop
						$loop = new WP_Query($args);
						while ($loop->have_posts()) : $loop->the_post();
					?>
						<li class="leader">
							<div class="leader-info">
								<div class="leader-image">
									<?php the_post_thumbnail() ?>
								</div><!-- .leader-image -->
							</div><!-- .leader-info -->
						</li>
					<?php endwhile; ?>
				</ul>
			</div><!-- .about-leaders -->
		</main>
	</div>

<?php get_footer(); ?>
