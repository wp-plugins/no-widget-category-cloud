<?php
/*
Plugin Name: No Widget Category Cloud
Plugin URI: http://sivel.net/wordpress/
Description: Creates a function that can be placed in a wordpress template for a category cloud that exists without the requirement of widgets or a widget ready theme.
Version: 0.2
Author: Matt Martz
Author URI: http://sivel.net

        Copyright (c) 2007 Matt Martz (http://sivel.net)
        No Widget Category Cloud is released under the GNU General Public License (GPL)
	http://www.gnu.org/licenses/gpl-2.0.txt
*/

function nw_catcloud($small=75,$big=200,$unit='%',$align='left',$orderby='name',$order='ASC',$min=1,$hide_empty=1,$title='',$exclude='') {

	$options = array('small' => '', 'big' => '', 'unit' => '', 'align' => '', 'orderby' => '', 'order' => '', 'min' => '', 'hide_empty' => '', 'title' => '', 'exclude' => '');

	foreach ( $options as $key => $value )
                        $options[$key] = $$key;

	// omit title if not specified
	if ($options['title'] != '')
		echo $before_title . $options['title'] . $after_title;

	if ($options['exclude'] != '')
		$exclude = '&exclude=' . $options['exclude'];

	$hide_empty = '&hide_empty=' . $options['hide_empty'];

	// check which version of wp is being used
	if ( function_exists('get_categories') ) {
		// new version of wp (2.1+)
		$cats = get_categories("style=cloud&show_count=1&use_desc_for_title=0$exclude&hierarchical=0$hide_empty");

		foreach ($cats as $cat) {
			$catlink = get_category_link( $cat->cat_ID );
			$catname = $cat->cat_name;
			$count = $cat->category_count;
			if ($count >= $options['min']) {
				$counts{$catname} = $count;
				$catlinks{$catname} = $catlink;
			}
		}

	} else	{
		// old version of wp (pre-2.1)
		$cats = wp_list_cats("list=0&sort_column=name&optioncount=1&use_desc_for_title=0$exclude&recurse=1&hierarchical=0$hide_empty");

		$cats = explode("<br />\n", $cats);
		foreach ($cats as $cat) {
			$regs = array(); // initialise the regs array
			eregi("a href=\"(.+)\" ", $cat, $regs);
			$catlink = $regs[1];
			$cat = trim(strip_tags($cat));
			eregi("(.*) \(([0-9]+)\)$", $cat, $regs);
			$catname = $regs[1];
			$count = $regs[2];
			if ($count >= $options['min']) {
				$counts{$catname} = $count;
				$catlinks{$catname} = $catlink;
			}
		}
	}

	$spread = max($counts) - min($counts);
	if ($spread <= 0) { $spread = 1; };
	$fontspread = $options['big'] - $options['small'];
	$fontstep = $spread / $fontspread;
	if ($fontspread <= 0) { $fontspread = 1; }

	echo '<p class="catcloud" style="text-align:'.$options['align'].';">';

	if ('count' == $options['orderby']) {
		if ('DESC' == $options['order'])
			arsort($counts);
		else
			asort($counts);
	} elseif ('name' == $options['orderby']) {
		if ('DESC' == $options['order'])
			uksort($counts, create_function('$a, $b', 'return -(strnatcasecmp($a, $b));'));
		else
			uksort($counts, 'strnatcasecmp');
	}

	foreach ($counts as $catname => $count) {
		$catlink = $catlinks{$catname};
		echo "\n<a href=\"$catlink\" title=\"$count posts filed under $catname\" style=\"line-height:1.2; font-size:".
			($options['small'] + ceil($count/$fontstep)).$options['unit']."\">$catname</a> ";
	}

	echo '</p>';
}

?>
