<?php
/*
Plugin Name: Searchable Links
Plugin URI: http://bavotasan.com/wordpress/free-wordpress-plugins/searchable-links-plugin-for-wordpress/
Description: Turns values saved in the Searchable Links box of each post into links that when clicked, search your site for that specific value.
Author: c.bavota
Version: 1.1.1
Author URI: http://bavotasan.com
*/

if (!class_exists("SL")) {
	class SL {
		function __construct()
		{
			$this->site_url = get_option('siteurl');

			add_action('admin_menu', array(&$this, 'SL_add_pages'));

			//manage clips ajaxically
			add_action('wp_ajax_SL_save_settings', array(&$this, 'SL_save_settings'), 10);
		}

		function SL_add_pages()
		{
			//add an SL submenu under Settings:
			add_meta_box('searchables', 'Searchable Links',  array(&$this, 'SL_settings_page'), 'post', 'advanced');
			add_action("admin_print_scripts", array(&$this, 'load_js_admin_head'));
		}

		function load_js_admin_head() {
			wp_enqueue_script('js-SL', '/wp-content/plugins/searchable-links/js-SL.php');
		}

		function SL_settings_page()
		{
			include('searchable-links-settings.php');
		}

		function SL_save_settings()
		{
		    $name1 = 'searchables_one';
		    $name2 = 'searchables_two';
			$value1 = $_POST['SL_values'];
			$value2 = $_POST['SL_values2'];
			$the_post = $_POST['SL_post_ID'];
			$number = get_option('SL_number');
			
			if ($value1 == "") {
				$message_result = array(
					'message' => 'Please enter your Searchable Links!',
					'success' => FALSE
	        	);	
			} else {
				delete_post_meta($the_post, $name1);
				delete_post_meta($the_post, $name2);
				if($value1 != "") {
				add_post_meta($the_post, $name1, $value1);
				}
				if($value2 != "" && $number == 'two') {
				add_post_meta($the_post, $name2, $value2);
				}
				$message_result = array(
					'message' => 'Searchable Links Saved!',
					'success' => TRUE
				);
			}
			echo json_encode($message_result);
			exit;
		}

	} //end class SL
}

if (class_exists("SL")) {
	$a4wp = new SL();
}

//Initialization to add the box to the post page
add_action('admin_menu', 'searchables_init');
function searchables_init() {
	add_options_page('Searchable Links', 'Searchable Links', 10, __FILE__, 'my_plugin_options');
}

function save_post_meta() {
	if($_REQUEST['searchables_value']) {
	$value = $_REQUEST['searchables_value'];
	}
	global $post;
	$the_post = $post->ID;
	add_post_meta($the_post,'searchables_one',$value);
}

add_action('wp_footer', 'add_search_script');

function add_search_script() {
	echo '<!-- Searchable Links script begin-->';
    echo '<script type="text/javascript" src="'  . get_settings('siteurl') . '/wp-content/plugins/searchable-links/search.js"></script>'."\n";
	echo '<!-- Searchable Links script end-->';
}

function searchOne() {
	global $post;
	$titleOne = get_option('title_one');
	$links = get_post_meta($post->ID, 'searchables_one', true);
	if (!empty($links)) {
	echo $titleOne . ':&nbsp;<span class="searchOne">' . $links . '</span><br />';
	}
}

function searchTwo() {
	global $post;
	$titleTwo = get_option('title_two');
	$links = get_post_meta($post->ID, 'searchables_two', true);
	if (!empty($links)) {
	echo $titleTwo . ':&nbsp;<span class="searchTwo">' . $links . '</span><br />';
	}
}

function set_SL_options() {	
	add_option('title_one','Director','Title for first searchable links');
	add_option('title_two','Starring','Title for second searchable links');	
	add_option('SL_number','two','Number of Searchable Links used');	
}

function unset_SL_options() {
	delete_option('title_one');
	delete_option('title_two');
	delete_option('SL_number');
}

register_activation_hook(__FILE__,'set_SL_options');
register_deactivation_hook(__FILE__,'unset_SL_options');

function my_plugin_options() {
?>
  <div class="wrap">
  <h2>Searchable Links</h2>
  <?php
	if($_REQUEST['submit']) {
	update_SL_options();
	}
	print_SL_form();
	?>
 </div>
<?php
}

function update_SL_options() {
	$ok = false;
	
	if($_REQUEST['title_one']) {
		update_option('title_one',$_REQUEST['title_one']);
		$ok = true;
	}
	
	if($_REQUEST['title_two']) {
		update_option('title_two',$_REQUEST['title_two']);
		$ok = true;
	}
	
	if($_REQUEST['SL_number']) {
		update_option('SL_number',$_REQUEST['SL_number']);
		$ok = true;
	}	
	
	if($ok) {
		echo'<div id="message" class="updated fade">';
		echo '<p>Options saved.</p>';
		echo '</div>';
	} else {
		echo'<div id="message" class="error fade">';
		echo '<p>Failed to save options.</p>';
		echo '</div>';	
	}
}

function print_SL_form() {
	$default_title_one = get_option('title_one');
	$default_title_two = get_option('title_two');
	$number = get_option('SL_number');
	?>
    <!-- Searchable Links admin box begin-->
	<form method="post">
    <table class ="form-table">
    <tr valign="top">
	<th scope="row">
    	<label for="title_one">First searchable links title:</label>
	</th>
    <td>
    	<input type="text" name="title_one" value="<?=$default_title_one?>" />
    </td>
     </tr>   
     <?php if($number == 'two') { ?>
    <tr valign="top">
	<th scope="row">
    	<label for="title_two">Second searchable links title: </label>
    </th>
    <td>
       	<input type="text" name="title_two" value="<?=$default_title_two?>" />
    </td>
    </tr>
    <?php } ?>
    <tr valign="top">
	<th scope="row">
    	<label for="title_two">How many Searchable Links would you like to use? </label>
    </th>
    <td>
    	<select id="SL_number" name="SL_number" style="width:50px;">
	    <?php if($number == 'one') { ?>
        <option value="one" selected="yes"> 1 </option>
        <?php } else { ?>
        <option value="one"> 1 </option>
        <?php } ?>
	    <?php if($number == 'two') { ?>
        <option value="two" selected="yes"> 2 </option>
        <?php } else { ?>
        <option value="two"> 2 </option>
        <?php } ?>
        </select>
        <em>(default is 2)</em>
    </td>
    </tr>
    </table>   
	<p class="submit">
	<input type="submit" name="submit" class="button-primary" value="Save Changes" />
	</p>
    </form>
	<p>Place the following codes within the loop in your theme to add searchable links.</p>
	<p><strong>First searchable links code</strong>: <code>&lt;?php if(function_exists('searchOne')) { searchOne(); } ?&gt;</code></p>
	<?php if($number == 'two') { ?>
    	<p><strong>Second searchable links code</strong>: <code>&lt;?php if(function_exists('searchTwo')) { searchTwo(); } ?&gt;</code></p>
    <?php } ?>
    <!-- Searchable Links admin box end-->

<?php 
}
?>