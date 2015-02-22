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

				// create iterator for expanded content
				$i = 1;

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
							</div>
							<!-- .leader-info -->

							<div class="leader-image">
								<?php the_post_thumbnail() ?>
							</div>
							<!-- .leader-image -->

							<div class="leader-button"></div>
						</div>
						<!-- .leader-content -->

						<div class="leader-description">
							<div class="left-col">
								<p><?php the_field('bio_column_1') ?></p>
							</div>
							<!-- .left-col -->
							<div class="right-col">
								<p><?php the_field('bio_column_2') ?></p>
							</div>
							<!-- .right-col -->
						</div>
						<!-- .leader-description -->
					</li>

					<?php // insert the description container in the correct place ?>
					<?php if ($i % 3 === 0): ?>
						<li class="leader-alt">
						</li>
					<?php endif; ?>

					<?php // increment the iterator ?>
					<?php $i ++; ?>

				<?php endwhile; ?>
			</ul>
		</div>
		<!-- .about-leaders -->
	</main>
</div><!-- #primary -->

<script>

	// wait for document to load before running script
	$(document).ready(function () {

		// cache some variables
		var $leader = $('.leader');

		// setup click action on .leader-button element
		$leader.on('click', function () {
			// define some variables
			var $target = $(this).find('.leader-description').parent().nextAll('.leader-alt:first');

			// toggle the active class on current element
			$(this).toggleClass('active');

			// close any open description containers
			if ($('.leader').not($(this)).hasClass('active')) {
				$('.leader').removeClass('active');
			}

			// copy description and append it to container
			var $content = $(this).find('.leader-description').html();

			// display content
			$target.html($content).slideToggle();

		});

	});

</script>

<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
