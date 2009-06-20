=== Plugin Name ===
Contributors: sivel
Tags: formatting, links, post, posts, categories, cloud, tags
Requires at least: 2.0
Tested up to: 2.5
Stable tag: 0.2

Creates a function that can be placed in a wordpress template for a category cloud that exists without the requirement of widgets or a widget ready theme.

== Description ==

Creates a function that can be placed in a wordpress template for a category cloud that exists without the requirement of widgets or a widget ready theme.

I created this plugin after I started using a single column theme that is not widget ready.  I found that there were multiple plugin widgets available, but no plugin that would allow me to just place a php function into my theme to display a category cloud.

Some ideas for oter uses of this plugin:

1. Install WP-Sticky and Exec-PHP.  Create a Sticky post which will stay at the top of your page and type the php code for this plugin in the post.  Now you have a Category Cloud that stays at the top of your page.

== Installation ==

1. Upload the `no-widget-category-cloud` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

NOTE: See "Other Notes" for Upgrade and Usage Instructions as well as other pertinent topics.

== Screenshots ==

1. Screenshot of end product.

== Requirements ==

1. Wordpress 2.x
1. Web server that supports PHP

== Upgrade ==

1. Deactivate the plugin through the 'Plugins' menu in WordPress
1. Delete the previous `no-widget-category-cloud` folder from the `/wp-content/plugins/` directory
1. Upload the new `no-widget-category-cloud` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Usage ==

`<?php nw_catcloud(small_size,big_size,size_unit,align,orderby,order,min_posts,hide_empty,title); ?>`

`small_size = font size, integer (default 75)
big_size = font size, integer (default 200)
size_unit = %, px, pt (default %)
align = left, right, center, justify (default left)
orderby = count, name (default name)
order = asc, desc (default asc)
min_posts = minimum number of posts, integer (default 1)
hide_empty = 0,1 (default 1, 1=yes,0=no)
title = string (This can contain HTML to format the title)` 

1. Open the theme files, in your favorite editor, that you wish to add the category cloud to (index.php, single.php, page.php, etc...).
1. Add a line that looks like above.  You can also use the defaults by not specifiying anything between the parentheses. See example 2 below.
1. Enjoy.
1. As I mentioned in the description you can also use this plugin with Exec-PHP and it would make a nice combo with WP-Sticky.

= Examples =

1. `<?php nw_catcloud(75,200,'%','left','name','asc',1,1,'<h2 class="posttitle" style="margin-bottom:0px;">Categories</h2>'); ?>`
1. `<?php nw_catcloud(); ?>`

== Changelog ==

= 0.2 (2007-10-22): =
* Initial Public Release

== To Do ==

1. I am open to suggestions.
1. I am sure I will think of something.

== Credit ==

I've got to give credit where credit is due.  And that credit goes to Lee Kelleher and his Category Cloud Widget.  I used a lot of his code in this plugin modifying it where needed to make it work the way I wanted.
