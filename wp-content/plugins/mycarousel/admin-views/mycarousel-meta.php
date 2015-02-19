<?php

check_my_nggal();

global $nggdb, $myeasings, $myalign, $mydirection, $myeffect, $dbkeys;



if(isset($_REQUEST['post']) && is_numeric($_REQUEST['post'])) {

	$post = (int)$_REQUEST['post'];

	$post = get_post($post);

	

	foreach($dbkeys as $key) {

		$$key = get_post_meta($post->ID, $key, true);

	}

	

}else {

	foreach($dbkeys as $key) {

		$$key = '';

	}

}

$mycarcat = get_terms('mycarousel_category');

?>

<div style="padding: 10px; float: left;">

<label style="float: left; padding: 6px;" for="my_sourceid">Carousel Source</label>

<div style="float: left;">

<select name="my_sourceid" id="my_sourceid" style="width: 350px;">

	<option value="">Select</option>

	<?php

	foreach($nggdb->find_all_galleries() as $alb) {

		?>

	<option <?php echo ($my_sourceid == 'img:'.$alb->gid) ? ' selected="selected"' : ''; ?> value="img:<?php echo $alb->gid; ?>">Image-<?php echo $alb->name; ?></option>

	<?php

	}

	foreach($mycarcat as $row) {

	?>

	<option <?php echo ($my_sourceid == 'cont:'.$row->term_id) ? ' selected="selected"' : ''; ?> value="cont:<?php echo $row->term_id; ?>">Content-<?php echo $row->name; ?></option>

	<?php

	}

	?>

</select>

</div>

</div>

<div class="clear"></div>



<div style="padding: 10px; float: left; background:#F7F8DA; border-bottom: 2px solid #FFF; width:510px;">

<div class="fl">

<?php

echo generate_checkbox('my_circular', '1', $my_circular);

?>

</div>

<label class="lab1 fl" for="my_circular">Circular</label>


<div class="fl">
<?php
echo generate_checkbox('my_auto_height', '1', $my_auto_height);
?>
</div>
<label class="lab1 fl" for="my_auto_height">Auto Height</label>


<div class="fl">
<?php
echo generate_checkbox('my_leftright_but', '1', $my_leftright_but);
?>
</div>
<label class="lab1 fl" for="my_leftright_but">Navigation Button</label>

<div class="fl">
<?php
echo generate_checkbox('my_nav_size', '1', $my_nav_size);
?>
</div>
<label class="lab1 fl" for="my_nav_size">Nav Small Button </label>



<div class="clear"></div>

</div>

<div class="clear"></div>



<div style="padding: 10px; float: left; background:#FFFFDF; border-bottom: 2px solid #FFF; width:510px;">

<div class="fl">

<?php

echo generate_checkbox('my_swipe', '1', $my_swipe);

?>

</div>

<label class="lab1 fl" for="my_swipe">Swipe Touch</label>

<div class="fl">

<?php

echo generate_checkbox('my_mouse_wheel', '1', $my_mouse_wheel);

?>

</div>

<label class="lab1 fl" for="my_mouse_wheel">Mouse Wheel</label>

<div class="fl">

<?php

echo generate_checkbox('my_auto_play', '1', $my_auto_play);

?>

</div>

<label class="lab1 fl" for="my_auto_play">Auto Play</label>



<div class="fl">

<?php

echo generate_checkbox('my_pause_over', '1', $my_pause_over);

?>

</div>

<label class="lab1 fl" for="my_pause_over">Pause Over</label>



<div class="clear"></div>

</div>

<div class="clear"></div>



<div style="padding: 10px; float: left; background:#F7F8DA; border-bottom: 2px solid #FFF; width:510px;">

<div class="fl">

<?php

echo generate_checkbox('my_pagination', '1', $my_pagination);

?>

</div>

<label class="lab1 fl" for="my_pagination">Pagination</label>

<div class="fl">

<?php

echo generate_checkbox('my_pagination_key', '1', $my_pagination_key);

?>

</div>

<label class="lab1 fl" for="my_pagination_key">Pagination Key</label>

<div class="fl">

<?php

echo generate_checkbox('my_random', '1', $my_random);

?>

</div>

<label class="lab1 fl" for="my_random">Show Random Slides</label>



<div class="clear"></div>

</div>

<div class="clear"></div>





<div style="padding: 10px; float: left; background:#FFFFDF; border-bottom: 2px solid #FFF; width:510px;">

<label class="lab2 fl" for="my_direction">Direction</label>

<div class="fl lab1">

<select name="my_direction" id="my_direction">

<option value="">Select</option>

<?php

foreach($mydirection as $row) {

?>

<option value="<?php echo $row; ?>"<?php echo ($row==$my_direction) ? ' selected="selected"' : ''; ?>><?php echo $row; ?></option>

<?php

}

?>

</select>

</div>

<label class="lab2 fl" for="my_timeout">Timeout</label>

<div class="fl lab1">

<?php

echo generate_textbox('my_timeout', $my_timeout, ' class="tb"');

?>

</div>


<label class="lab2 fl" for="my_item_duration">Duration</label>
<div class="fl lab1">
<?php
echo generate_textbox('my_item_duration', $my_item_duration, ' class="tb"');
?>
</div>

<label class="lab2 fl" for="my_slide_margin">Margin</label>
<div class="fl lab1">
<?php
echo generate_textbox('my_slide_margin', $my_slide_margin, ' class="tb"');
?> px
</div>

<div class="clear"></div>

</div>

<div class="clear"></div>



<div style="padding: 10px; float: left; background:#F7F8DA; border-bottom: 2px solid #FFF; width:510px;">

<label class="lab2 fl" for="my_visible">Visible</label>
<div class="fl lab1">
<?php
echo generate_textbox('my_visible', $my_visible, ' class="tb"');
?>
</div>

<strong class="fl lab1">OR</strong>

<label class="lab2 fl" for="my_width">Item Width</label>
<div class="fl lab1">
<?php
echo generate_textbox('my_width', $my_width, ' class="tb"');
?>
</div>

<div class="clear"></div>

</div>

<div class="clear"></div>





<div style="padding: 10px; float:left; background:#FFFFDF; width:510px;">

<label class="lab2 fl" for="my_effect">Effect</label>

<div class="fl lab1">

<select name="my_effect" id="my_effect">

<option value="">Select</option>

<?php

foreach($myeffect as $row) {

?>

<option value="<?php echo $row; ?>"<?php echo ($row==$my_effect) ? ' selected="selected"' : ''; ?>><?php echo $row; ?></option>

<?php

}

?>

</select>

</div>

<label class="lab2 fl" for="my_easing">Easing</label>

<div class="fl lab1">

<select name="my_easing" id="my_easing">

<option value="">Select</option>

<?php

foreach($myeasings as $row) {

?>

<option value="<?php echo $row; ?>"<?php echo ($row==$my_easing) ? ' selected="selected"' : ''; ?>><?php echo $row; ?></option>

<?php

}

?>

</select>

</div>



<div class="clear"></div>

</div>

<div class="clear"></div>