<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
check_my_nggal();
global $wpdb, $nggdb, $dbkeys;

foreach($dbkeys as $key) {
	$$key = get_post_meta($post->ID, $key, true);
}

$rand = rand(111111, 999999);

$my_sourceid = explode(':', $my_sourceid);

$cardata = array();
if($my_sourceid[0]=='cont') {
	$args = array(
	'post_type' => 'contentslides',
	'posts_per_page'=> -1,
    'tax_query' => array( 
	        array( 
	            'taxonomy' => 'mycarousel_category', 
	            'terms' => array( 
	                $my_sourceid[1] 
	            ), 
	        )
	    )
	);
	
	if($my_random=='1') {
		$args['orderby']='rand';
	}else {
		$args['orderby']='menu_order';
		$args['order'] = 'DESC';
	}
	
	wp_reset_query();
	$loop = new WP_Query( $args );

	foreach($loop->posts as $row) {
		$cardata[] = $row->post_content;
	}
}else if($my_sourceid[0]=='img') {
	$tempdata = $nggdb->get_gallery($my_sourceid[1]);
	
	foreach($tempdata as $row) {
		$slidedata = '';
		if($row->description!='') {
			$slidedata .= '<div class="mycaption">' . $row->description . '</div>';
		}
		$slidedata .= '<img src="'.$row->imageURL.'" />';
		$cardata[] = $slidedata;
	}
	if($my_random=='1') {
		shuffle($cardata);
	}
}

?>
<script>
jQuery(document).ready(function() {
	var opt = {};
	<?php
	if($my_circular=='1') {
		echo "opt['circular'] = true;";
	}else {
		echo "opt['circular'] = false;";
	}
	
	if($my_leftright_but=='1') {
		echo "opt['next'] = '#next".$rand."';";
		echo "opt['prev'] = '#prev".$rand."';";
	}else {
		echo "jQuery('#next".$rand."').hide();";
		echo "jQuery('#prev".$rand."').hide();";
	}
	
	if($my_swipe=='1') {
		echo "opt['swipe'] = true;";
	}
	
	if($my_auto_height=='1') {
		echo "opt['autoHeight'] = true;";
	}

	if($my_mouse_wheel=='1') {
		echo "opt['mouseWheel'] = true;";
	}
	
	if($my_auto_play=='1') {
		echo "opt['auto'] = true;";
	}
	
	if($my_pagination=='1') {
		echo "opt['paging'] = '#pag".$rand."';";
	}
	if($my_pagination_key=='1') {
		echo "opt['keys'] = true;";
	}

	if($my_pause_over=='1') {
		echo "opt['pauseOver'] = true;";
	}

	if($my_direction!='') {
		echo "opt['direction'] = '".$my_direction."';";
	}
	
	if($my_width!='') {
		echo "opt['itemWidth'] = $my_width;";
	}
	
	if($my_item_duration!='') {
		echo "opt['easingTime'] = $my_item_duration;";
	}
	
	if($my_effect!='') {
		echo "opt['effect'] = '$my_effect';";
	}
	
	if($my_easing!='') {
		echo "opt['easing'] = '$my_easing';";
	}
	
	if($my_timeout!='') {
		echo "opt['pauseTime'] = $my_timeout;";
	}
	
	if($my_visible!='') {
		echo "opt['visible'] = $my_visible;";
	}
	
	if($my_slide_margin!='') {
		echo "opt['slideMargin'] = $my_slide_margin;";
	}
	?>
	jQuery("#mycarousel<?php echo $rand; ?>").mycarousel(opt);
});
</script><div class="mycrsl<?php echo ($my_direction=='up' or $my_direction=='down') ? ' updown' : ''; ?>">
<div class="mycarousel" id="mycarousel<?php echo $rand; ?>">
<?php
foreach($cardata as $row) {
?>
<div>
<?php echo $row; ?>
</div>
<?php
}
?>
</div><div class="clear"></div><a class="prev<?php echo ($my_nav_size=='1') ? '_small' : ''; ?>" id="prev<?php echo $rand; ?>" href="#"><span>prev</span></a><a class="next<?php echo ($my_nav_size=='1') ? '_small' : ''; ?>" id="next<?php echo $rand; ?>" href="#"><span>next</span></a>
<div class="pagination" id="pag<?php echo $rand; ?>"></div></div>