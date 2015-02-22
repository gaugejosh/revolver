<?php

/**
 * Template Name: About - Who We Are
 *
 */
if (array_key_exists('downlink', $_POST))
{
	// simply send the file
	$file = $_POST['downlink'];
	header("Content-Type: application/octet-stream");
	$filename = explode("/", $file);
// last index is the file name
	$thisname = $filename[ sizeof($filename) - 1 ];
	header("Content-Disposition: attachment; filename=" . urlencode($thisname));
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Description: File Transfer");
	header("Content-Length: " . filesize($file));
	flush(); // this doesn't really matter.
	$fp = fopen($file, "r");
	while ( ! feof($fp))
	{
		echo fread($fp, 65536);
		flush(); // this is essential for large downloads
	}
	fclose($fp);
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="breadcrumbs">
				<?php if (function_exists('bcn_display') && ! is_home())
				{
					bcn_display();
				} ?>
			</div>
			<?php
			// what is the background and text color of the quotation box?
			switch (get_field('quote_bg')) {
			case 1:
			// blue with white text
			?>
			<div id="page-quote-blue">
				<?php
				break;
				case 2:
				// yellow with black text
				?>
				<div id="page-quote-yellow">
					<?php
					break;
					}
					?>
					<div class="head-quote-text">
						&quot;<?=the_field('quote_box');?>&quot;
					</div>
					<div class="head-quote-attrib">
						<?=strtoupper(get_field('quote_attrib'));?><br/>
						<?=get_field('quote_title');?>
					</div>
				</div>
				<div class="page-head-img">
					<?=the_post_thumbnail();?>
				</div>
				<?php
				// count the number of words in the description text and split the text in half
				$page_data     = get_page(get_the_ID());
				$fulldescrtext = apply_filters('the_content', $page_data->post_content);
				?>
				<?php if ( ! is_mobile()): ?>
					<div class="section-title">
						<?=strtoupper(get_field('section_title_1'));?>
					</div>

					<div class="diagram">
						<img src="<?=the_field('diagram_1');?>" border="0"/>
					</div>
				<?php endif; ?>
				<?php

				$sectiontitle2 = get_field('section_title_2');

				// show the timeline?
				if (get_field('has_timeline') == 'true')
				{

					// grab the information for the sliders
					$slideryears   = array();
					$mainimageinfo = array();

					$timelineinfo = array(); // for constructing the tabs

					// get all of the timeline posts, ordering by the sequence
					$args       = array(
						'post_type'      => 'timeline',
						'posts_per_page' => - 1,
						'meta_key'       => 'timeline_order',
						'orderby'        => 'meta_value_num',
						'order'          => 'ASC'
					);
					$loop       = new WP_Query($args);
					$firstentry = true;
					while ($loop->have_posts()) : $loop->the_post();
						// save the year
						array_push($slideryears, get_field('timeline_year'));
						// save the image information
						$imgobj          = new stdClass();
						$imgobj->img     = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
						$imgobj->imghead = get_the_title();
						$imgobj->imgtext = get_the_content();
						array_push($mainimageinfo, $imgobj);
					endwhile;

					?>
					<div class="section-title">
						TIMELINE
					</div>
					<div id="carousel" class="flexslider">
						<ul class="slides">
							<?php
							// create the timeline year controller strip
							foreach ($slideryears as $year): ?>
								<li>
									<div class="timeline">
										<div class="timeline-year off">
											<?php echo $year; ?>
										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div id="slider" class="flexslider">
						<ul class="slides">
							<?php
							// place the images in the main image slider
							foreach ($mainimageinfo as $imginfo)
							{
								echo '<li>';
								?>
								<div class="timeline-container">
									<div class="timeline-photo">
										<img src="<?=$imginfo->img[0];?>"/>
									</div>
									<div class="timeline-info-container">
										<div class="time-descr-box">
											<div class="timeline-header-text">
												<?=$imginfo->imghead;?>
											</div>
											<div class="timeline-descr">
												<?=$imginfo->imgtext;?>
											</div>
										</div>
									</div>
								</div>
								<?php
								echo '</li>';
							}
							?>
							<!-- items mirrored twice, total of 12 -->
						</ul>
						<iframe id="downframe" style="display:none"></iframe>
						<iframe id="downframe" style="display:none"></iframe>
					</div>
				<?php
				}
				?>
				<?php
				// does the page have a diagram
				if ($sectiontitle2 != "")
				{

					?>
					<div class="section-title">
						<?=strtoupper($sectiontitle2);?>
					</div>
				<?php
				}
				?>
				<div class="page-descr-container" id="nobottom">
					<div class="page-descr-text">
						<?=$fulldescrtext;?>
					</div>
				</div>
				<?php
				// does the page have a second diagram
				if (get_field('diagram_2') != "")
				{

					?>
					<div class="diagram">
						<img src="<?=the_field('diagram_2');?>" border="0"/>
					</div>
				<?php
				}
				// which teaser box needs to be displayed?
				switch (get_field('teaser_box'))
				{
					case 1:
						if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar('Teasers Set 1')) :
						endif;
						break;
					case 2:
						if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar('Teasers Set 2')) :
						endif;
						break;
					case 3:
						if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar('Teasers Set 3')) :
						endif;
						break;
				}
				?>
		</main>
	</div>
	<script type="text/javascript">
		function downloadfile(path) {
			var ifrm = document.getElementById('downframe');
			ifrm.src = "<?php echo get_template_directory_uri(); ?>/download.php?path=" + path;
		}

		$(window).load(function () {

			// The slider being synced must be initialized first
			jQuery('#carousel').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 300,
				itemMargin: 0,
				move: 4,
				startAt: 0,
				prevText: '',
				nextText: '',
				asNavFor: "#slider",
				minItems: 1,
				maxItems: 4
			});

			jQuery('#slider').flexslider({
				animation: "slide",
				controlNav: false,
				directionNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 1200,
				itemMargin: 0,
				sync: "#carousel",
				minItems: 1,
				maxItems: 1
			});

			fixFlexsliderHeight();
		});

		// click event for checkboxes
		$('.checker span').click(function () {
			if ($(this).hasClass('checked')) {
				$(this).removeClass('checked');
				$(':checkbox', this).prop('checked', false);
			} else {
				$(this).addClass('checked');
				$(':checkbox', this).prop('checked', true);
			}
		});
		// function to initiate multiple downloads
		function makeFrame(url) {
			ifrm = document.createElement("IFRAME");
			ifrm.setAttribute("style", "display:none;");
			ifrm.setAttribute("src", url);
			ifrm.style.width = 0 + "px";
			ifrm.style.height = 0 + "px";
			document.body.appendChild(ifrm);
		}

		// force download of selected pdf files
		function downloadChecked() {
			for (i = 0; i < document.downloadform.elements.length; i++) {
				foo = document.downloadform.elements[i];
				if (foo.type == "checkbox" && foo.checked == true) {
					console.log(foo.value);
					makeFrame(foo.value);
				}
			}
		}

		function fixFlexsliderHeight() {
			// Set fixed height based on the tallest slide
			jQuery('.flexslider').each(function () {
				var sliderHeight = 0;
				$(this).find('.slides > li').each(function () {
					slideHeight = $(this).height();
					if (sliderHeight < slideHeight) {
						sliderHeight = slideHeight;
					}
				});
				$(this).find('ul.slides').css({'height': sliderHeight});
			});
		}

		// year hover effects
		$('.timeline-year').click(function () {
			if ($('.timeline-year').hasClass('off')) {
				$('.timeline-year').removeClass('on'); // remove previous on link
				$(this).removeClass('off');
				$(this).addClass('on');
			}
		});
	</script>
<?php
// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
	$arr = preg_split("/[\s]+/", $str, $words + 1);
	$arr = array_slice($arr, $startat, $words);

	return join(' ', $arr);
}

get_footer(); ?>