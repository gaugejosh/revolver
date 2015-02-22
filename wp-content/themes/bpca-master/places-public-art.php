<?php

/**
* Template Name: Places - Public Art
* 
*/

// wordpress header hook. do not remove or bearshark will find you
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

				// create loop array
				$args = array( 'post_type' => 'places',
				               'posts_per_page' => -1,
				               'tax_query' => array(
					               array(
						               'taxonomy' => 'places_categories',
						               'field'    => 'slug',
						               'terms'    => 'public-art',
					               ),
				               ),
				               'meta_key' => 'places_page_order',
				               'orderby' => 'meta_value_num',
				               'order' => 'ASC'
				);

				// instantiate new WP_Query object
				$loop = new WP_Query($args);

				// create iterator for expanded content
				$i = 1;

				// start ze loop!
				while ($loop->have_posts()) : $loop->the_post();
					?>

					<li class="grid places">
						<div class="grid-content">
							<div class="grid-info">
								<ul class="grid-info-list">
									<li><h2><?php the_title() ?></h2></li>
									<li><?php the_field('places_box_address') ?></li>
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
							<div class="grid-description-images">
								<ul>
									<li><?php the_post_thumbnail() ?></li>
									<li><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d12096.398901652281!2d-74.01518539999995!3d40.7158211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sCorner+Vesey+St.+%26+North+End+Ave%2C++New+York%2C+NY+10004!5e0!3m2!1sen!2sus!4v1424561525368" width="400" height="350" frameborder="0" style="border:0"></iframe></li>
								</ul>
							</div><!-- .grid-description-images -->

							<div class="grid-description-content places">
								<div class="left-col places">
									<?php the_content() ?>
								</div>
								<div class="right-col places">
									<?php the_field('places_descr_tag') ?>
								</div>
							</div>

						</div>
						<!-- .grid-description -->
					</li>

					<?php // insert the description container in the correct place ?>
					<?php if ($i % 3 === 0): ?>
						<li class="grid-alt places">
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

<script>

	// wait for document to load before running script
	$(document).ready(function () {

		// cache some variables
		var $grid = $('.grid');

		// setup click action on .grid-button element
		$grid.on('click', function () {
			// define some variables
			var $target = $(this).find('.grid-description').parent().nextAll('.grid-alt:first');

			// toggle the active class on current element
			$(this).toggleClass('active');

			// close any open description containers
			if ($('.grid').not($(this)).hasClass('active')) {
				$('.grid').removeClass('active');
			}

			// copy description and append it to container
			var $content = $(this).find('.grid-description').html();

			// display content
			$target.html($content).slideToggle();

		});

	});

</script>

<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
