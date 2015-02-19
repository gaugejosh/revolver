=== Plugin Name ===
Contributors: Nishant Patil, Taraprasad Swain
Tags: carousel, image carousel, content carousel
Requires at least: 3.0.1
Tested up to: 3.5

My Carousel is a responsive wordpress carousel plugin

== Description ==

My Carousel is a responsive wordpress carousel plugin. nextgen-gallery plugin is used to manage and upload images. jQuery.carouFredSel is used in frontend. nextgen-gallery is a required plugin.


How to install?

Upload it to wp-content/plugins/ directory or can be uploaded the archive file from wordpress backed.

Activate the plugin through the 'Plugins' menu in WordPress.

Download nextgen-gallery plugin and install from http://wordpress.org/extend/plugins/nextgen-gallery/

Activate the nextgen-gallery plugin through the 'Plugins' menu in WordPress.

If the plugin is successfully installed you will see "Carousel" and "Content Carousel" menu in backend.


Well there are two types of carousels i.e Image carousel and Content carousel

How to create an image carousel?

To create an image carousel first you will need to create an image gallery nextgen-gallery. You can create as many galleries as you want. And can upload N number of image to a gallery.

Goto carousel and click on Add New. Give your carousel a name for your reference.

The list of gallery names are available in the "Carousel Source" dropdown list.

Now select carousel source from drop down "Image-[Gallery Name]" and save.

Now click on the Carousel menu and copy the short code generated from short code column.

Now your responsive image carousel is ready to serve. You can paste the short code on any post or any page. wherever you want.


How to create a content carousel?

To create a content carousel you will need to create some some content slides

Goto "Content Carousel" click on Category. You can create as many categories as you want. Here categories are just group of content slides.

Now goto "Content Carousel" click on "Add New". You can create N number of content slides, just do not forget to select the category they belong. A single slide can belong to multiple categories. You will just have to check multiple checkboxes in the category box.

Now goto "Carousel" and click on "Add New". And give your carousel a name for your reference.

Now the list of categories are available in "Carousel Source" dropdown.

Select the carousel source from dropdown "Content-[Category Name]" and save. Your content carousel is ready now. Short code is generated in the same way as the image carousel.


How to configure?

The "Circular" checkbox determines whether the carousel should be circular.

The "Left/Right Button" checkbox determines whether to show the left right navigation button or not.

The "Swipe Touch" checkbox determines whether it should swipe in a touch enabled device or not.

The "Mouse Wheel" checkbox determines whether to enable the mouse wheel or not.

The "Auto Play" checkbox determines whether it should start playing automatically or not.

The "Pagination" checkbox determines whether to show the pagination or not.

The "Pagination Key" checkbox determines whether the pagination should work with keyboard number keys or not.

The "Pause Over" checkbox determines whether it should pause when mouseover.

The "Direction" select box determines the auto play scroll direction.

The "Item Width" text box determines the width of each slide.

The "Duration" text box determines the duration of the transition in milliseconds. If less than 10, the number is interpreted as a speed (pixels/millisecond). This is probably desirable when scrolling items with variable sizes.

The "Effect" select box indicates which effect to use for the transition.

The "Easing" select box indicates which easing function to use for the transition.

The "Timeout" text box indicates the amount of milliseconds the carousel will pause. If auto.duration is less then 10 -to use a speed (in pixels/milliseconds) instead of a duration-, the default value is 2500.