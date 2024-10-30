<?php error_reporting(0);
/**
 * Plugin Name: J Post Views Counter
 * Plugin URI: http://jssols.com
 * Description: This is very useful plugin that let your users know about post analytics means users can see how many time this post is read/watch.  
 * Version: 1.0
 * Author: Muhammad Jawad Arshad
 * Author URI: http://jssols.com
 * License: GPL2
 */
 
 // Run on plugin activation
 register_activation_hook( __FILE__, 'j_analytics_activation' );
 function j_analytics_activation()
 {
		update_option('j_text' , 'This post has been seen %s times.');
		update_option('j_image' , 'j-col.png');
		update_option('j_position' , 'bottom');
		update_option('j_image_size' , '24');
		update_option('j_font_size' , '12');
		update_option('j_text_color' , '#1e73be');
 }
 
// Load JS and CSS
add_action( 'admin_enqueue_scripts', 'j_analytics_color_picker' );
function j_analytics_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/j-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

 
// Register sub-page in setting tab.
add_action('admin_menu', 'j_analytics_add_menu');
function j_analytics_add_menu()
{
add_submenu_page( 'options-general.php', 'J Post Views Counter', 'J Post Views Counter', 'manage_options' , 'J-Post-Views-Counter_settings' , 'j_analytics_setting');
}

// Seeting Page
function j_analytics_setting()
{
	?>
<div class="wrap">
	<h2>J Post Views Counter Settings</h2>
    <small>When plugin is activate you can see analytics on each single post.</small>
    <?php
	if(@$_POST['submit']!="")
	{
		update_option('j_text' , $_POST['j_text']);
		update_option('j_image' , $_POST['j_image']);
		update_option('j_position' , $_POST['j_position']);
		update_option('j_image_size' , $_POST['j_image_size']);
		update_option('j_font_size' , $_POST['j_font_size']);
		update_option('j_text_color' , $_POST['j_text_color']);

	?>
    <div class="updated settings-error" id="setting-error-settings_updated"> 
    <p><strong>Settings saved.</strong></p></div>
    <?php
	}
	?>
    <form method="post" name="jform">
    <p>
    Text for analytics :
    <br />
       <input type="text" class="regular-text" value="<?php echo(esc_attr(get_option('j_text'))); ?>"
        id="j_text" name="j_text">
		<br />        
         <small style="color:#06F;">Don't change %s .If you want to change message than no problem but use %s in it  that will translate into totle post visit counter.Like '<strong>seen by %s visitors</strong>'</small>
    </p>
    
    <p>
    Text color :
    <br />
       <input type="text" value="<?php echo(esc_attr(get_option('j_text_color'))); ?>"
        id="j_text_color" name="j_text_color"  data-default-color="<?php echo(esc_attr(get_option('j_text_color'))); ?>" />
    </p>
    
    <p>
    	Position :
    <br />
       <select name="j_position">
       		<option value="top" <?php if(esc_attr(get_option('j_position')) == 'top') echo("selected"); ?>>
            	Above the post contents
            </option>
       		<option value="bottom" <?php if(esc_attr(get_option('j_position')) == 'bottom') echo("selected"); ?>>
            	Below the post contents
            </option>
       </select>
    </p>

    <p>
    	Font size :
    <br />
       <select name="j_font_size">
       		<option value="">Default</option>
       		<option value="10" <?php if(esc_attr(get_option('j_font_size')) == '10') echo("selected"); ?>>
            	Smaller Size
            </option>
       		<option value="12" <?php if(esc_attr(get_option('j_font_size')) == '12') echo("selected"); ?>>
            	Small Size
            </option>
       		<option value="15" <?php if(esc_attr(get_option('j_font_size')) == '15') echo("selected"); ?>>
            	Medium Size
            </option>
       		<option value="18" <?php if(esc_attr(get_option('j_font_size')) == '18') echo("selected"); ?>>
            	Large Size
            </option>
       </select>
    </p>

    <p>
    	Icon size :
    <br />
       <select name="j_image_size">
       		<option value="16" <?php if(esc_attr(get_option('j_image_size')) == '16') echo("selected"); ?>>
            	16 X 16
            </option>
       		<option value="20" <?php if(esc_attr(get_option('j_image_size')) == '20') echo("selected"); ?>>
            	20 X 20
            </option>
       		<option value="24" <?php if(esc_attr(get_option('j_image_size')) == '24') echo("selected"); ?>>
            	24 X 24
            </option>
       		<option value="32" <?php if(esc_attr(get_option('j_image_size')) == '32') echo("selected"); ?>>
            	32 X 32
            </option>
       </select>
    </p>
    
    <p>
    <br />
    Select icon :
    <br /><br />
       <input type="radio" name="j_image" value="j-blue.png" <?php  if(esc_attr(get_option('j_image')) == 'j-blue.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-blue.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-yellow.png" <?php  if(esc_attr(get_option('j_image')) == 'j-yellow.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-yellow.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-green.png" <?php  if(esc_attr(get_option('j_image')) == 'j-green.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-green.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-grey.png" <?php  if(esc_attr(get_option('j_image')) == 'j-grey.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-grey.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-red.png" <?php  if(esc_attr(get_option('j_image')) == 'j-red.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-red.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-col.png" <?php  if(esc_attr(get_option('j_image')) == 'j-col.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-col.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       <input type="radio" name="j_image" value="j-tilted.png" <?php  if(esc_attr(get_option('j_image')) == 'j-tilted.png') echo("checked") ?> /> 
       <img src="<?php echo plugins_url('images/j-tilted.png', __FILE__); ?>" width="24" height="24" />
       &nbsp;
       
    </p>
    
        <p class="submit">
            <input type="submit" value="Update Changes" class="button button-primary" id="submit" name="submit">
      	</p>
  </form>
</div>
    <?php		
}
 

// The "the_content" filter is used to filter the content of the post after it is retrieved from the database and before it is printed to the screen.
add_filter( 'the_content', 'j_analytics_contents_display' );
function j_analytics_contents_display($content)
{
	global $wpdb;
	global $post;
	if(is_single())
	{
		$table	=	$wpdb->postmeta;
		$postID = $post->ID;
		$post_meta	=	$wpdb->get_row( "SELECT * FROM $table WHERE post_id='$postID' AND meta_key='janalytics_counter'" );
		if(isset($post_meta->meta_id))
		{
			$wpdb->update
			( 
				$table, 
				array( 
					'meta_value' => $post_meta->meta_value + 1	// integer (number) 
				), 
				array( 'meta_id' => $post_meta->meta_id ), 
				array( 
					'%d'	// value2
				), 
				array( '%d' ) 
			);
		}
		else
		{
			$wpdb->insert
			( 
				$table, 
				array( 
					'meta_key' => 'janalytics_counter', 
					'meta_value' => 1 ,
					'post_id' => $postID 
				), 
				array( 
					'%s', 
					'%d',
					'%d' 
				) 
			);
		}
		$count	=	$wpdb->get_row( "SELECT * FROM $table WHERE post_id='$postID' AND meta_key='janalytics_counter'" );
		$jimage		=	esc_attr(get_option('j_image'));
		$jtext		=	esc_attr(get_option('j_text'));
		$jposition	=	esc_attr(get_option('j_position'));
		$jfont		=	esc_attr(get_option('j_font_size'));
		$jcolor		=	esc_attr(get_option('j_text_color'));
		$jtext		=	sprintf($jtext, $count->meta_value);
		if($jimage!="")
		{
			$j_size	=	esc_attr(get_option('j_image_size'));
			$j_img	=		'<img src="' .  plugins_url('images/' . $jimage , __FILE__) . '" width="'.$j_size.'" height="'.$j_size.'" /> ';
		}
		if($jposition=='top')
		{
			$j_postion	=	'<span style="font-size:'.$jfont.'px;color:'.$jcolor.'">' . $j_img . $jtext . '</span><br /><br />' . $content;
		}
		else
		{
			$j_postion	=	$content . '<br /><br /><span style="font-size:'.$jfont.'px;color:'.$jcolor.'">' . $j_img . $jtext . '</span>';	
		}
		$update_contents	= 	$j_postion;
		return $update_contents;
		
	}
	else
	{
		return $content;
	}	
}


// Admin dashboard widget function
add_action( 'wp_dashboard_setup', 'j_analytics_dashboard_widget' );
function j_analytics_dashboard_widget() {

	wp_add_dashboard_widget(
                 'J-Post Views Counter Summary',         // Widget slug.
                 'J Post Views Counter',         // Title.
                 'j_analytics_dashboard_widget_function' // Display function.
        );	
}
function j_analytics_dashboard_widget_function()
{
	global $wpdb;
	
$fivesposts = $wpdb->get_results( "SELECT *	FROM $wpdb->postmeta
 								WHERE meta_key='janalytics_counter' ORDER BY meta_value DESC LIMIT 5");
?>
	<h4>Most Viewed Posts</h4>
    <ul>
<?php
foreach ( $fivesposts as $ppost ) 
{
	$one_rows = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = $ppost->post_id");
	?>
    	<li>
        	<a href="<?php echo admin_url() ?>post.php?post=<?php  echo $ppost->post_id ?>&action=edit">
				<?php echo($one_rows->post_title); ?>
            </a>
            <span style="margin-left:50px;"><?php echo($ppost->meta_value);  ?></span>
        </li>
    <?php	
}
?>
</ul>
<?php
}


//Run on plugin Deactivation
 register_deactivation_hook( __FILE__, 'j_analytics_deactivation' );
 function j_analytics_deactivation()
 {
		delete_option('j_text');
		delete_option('j_image');
		delete_option('j_position');
		delete_option('j_image_size');
		delete_option('j_font_size');
		delete_option('j_text_color');
 }

 
 ?>