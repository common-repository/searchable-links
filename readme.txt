=== Searchable Links ===
Contributors: c.bavota
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=1929921
Tags: custom fields, search, links, automated search
Requires at least: 2.7
Tested up to: 2.8
Stable tag: 1.1.1

Turns values saved in the Searchable Links box of each post into links that when clicked, search your site for that specific value. Similar to tags, but instead of linking to your tags page, it searched your site.

== Description ==

Turns values saved in the Searchable Links box of each post into links that activate a search within your site. Similar to tags, but instead of linking to your tags page, it searched your site.

This plugin allows a user to turn the values saved to a custom field,  through the Searchable Links box of each post, into links that activate a search within their site.

== Installation ==

1. Unzip the searchable-links.zip file.
2. Upload the `searchable-links` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to Settings=>Searchable Links and customize your title(s) and the number of Searchable Links you want to use.
5. Go to your posts and add information to the Searchable Links box.
6. Place the following code to your theme within the loop:
	<?php if(function_exists('searchOne')) { searchOne(); } ?>

NOTE: If you have created a second searchable links use the following code as well: <?php if(function_exists('searchTwo')) { searchTwo(); } ?>

== Frequently Asked Questions == 

1) Why did you create this plugin?

I have a movie review site and I wanted to list the director and the stars of all the movies listed. I also wanted those names to be links that when clicked, would automatically search the site for that specific name in other posts. Et voila!

== Screenshots ==

1. Searchable Links admin screen
2. Searchable Links box in the Post Edit or Post New admin screen

== Change Log ==

1.1 (2008-12-22)
 - Added an option on the admin page to select "one" or "two" Searchable Links
 - Modified code to accept new option on admin page
 - Fixed placement of <script> tag
 _ Removed the need to create Custom Fields
 - Created Searchable Links meta box within the Post Edit admin screen
 - Automated the functionality of saving Searchable Links through Ajax interface

1.0 (2008-12-20)
Initial Public Release
