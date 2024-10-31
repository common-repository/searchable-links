<?php
	$default_title_one = get_option('title_one');
	$default_title_two = get_option('title_two');
	global $post;
	$the_post_ID = $post->ID;	
	$links1 = get_post_meta($post->ID, 'searchables_one', true);
	$links2 = get_post_meta($post->ID, 'searchables_two', true);
	$number = get_option('SL_number');
	?>
	<!-- Searchable Links box begin-->
	<div id="postcustomstuff">
    <div id="SL Settings" class="inside" style="padding:5px 0;">
   <div id="loading_message"></div>
   <table id="SL_meta">
	<tbody>
	<tr valign="top">
	<td id="SL_meta_left" class="left">
	<input type="hidden" id="the_post_ID" name="the_post_ID" tabindex="7" value="<?=$the_post_ID?>" />
	<input type="text" value="<?=$default_title_one?>" readonly />
	</td>
	<td>
    <textarea id="SL_values" class="excerpt" name="SL_values" rows="2" cols="60" tabindex="8"><?=$links1?></textarea></td>
	</tr>
    <?php if($number == 'two') { ?>
	<tr valign="top">
	<td id="SL_meta_left" class="left">
	<input type="text" value="<?=$default_title_two?>" readonly />
	</td>
	<td>
    <textarea id="SL_values2" class="excerpt" name="SL_values2" rows="2" cols="60" tabindex="8"><?=$links2?></textarea></td>
	</tr>    
    <?php } ?>
    </tbody>
	</table>
    <br />
	<p><a href="#" id="save_settings" class="button button-highlighted">Save Settings</a></p>
</div>
	</div>
	<!-- Searchable Links box end-->   
