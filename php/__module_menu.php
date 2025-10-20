<?php
namespace SIM\MAINTENANCE;
use SIM;

const MODULE_VERSION		= '8.0.5';
//module slug is the same as grandparent folder name
DEFINE(__NAMESPACE__.'\MODULE_SLUG', strtolower(basename(dirname(__DIR__))));

DEFINE(__NAMESPACE__.'\MODULE_PATH', plugin_dir_path(__DIR__));

add_filter('sim_submenu_maintenance_options', __NAMESPACE__.'\moduleOptions', 10, 2);
function moduleOptions($optionsHtml, $settings){
	ob_start();

	?>
	<label>
		<h4>Message title</h4>
		<input type='text' name='title' value='<?php echo $settings['title'];?>' style='width:100%;'>
	</label>

	<h4>Picture for maintenance mode message</h4>
	<?php
	SIM\pictureSelector('image', 'Image', $settings);
	?>
	<br>
	<label>
		<h4>Maintenance mode message</h4>
		<?php
		if(!isset($settings["message"]) || empty($settings["message"])){
			$message	= 'This website is currently unavailable, but will be available again soon';
		}else{
			$message	= $settings["message"];
		}
		
		$tinyMceSettings = array(
			'wpautop' 					=> false,
			'media_buttons' 			=> false,
			'forced_root_block' 		=> true,
			'convert_newlines_to_brs'	=> true,
			'textarea_name' 			=> "message",
			'textarea_rows' 			=> 10
		);

		echo wp_editor(
			$message,
			"message",
			$tinyMceSettings
		);
		?>
	</label>
	<?php

	return $optionsHtml.ob_get_clean();
}