<?php
/*
Plugin Name: Live2Support - Live Chat Plugin for WordPress
Plugin URI: http://www.live2support.com
Description: Live2support is most advanced live chat plugin for wordpress to support customers in real time. Live2Support live chat is a simple plug and play live chat service and does not require any software installation or IT expertise. 
Author: Live2Support
Author URI: http://www.live2support.com
Version: 2.5
*/
//
// Admin panel
//

/**
 * Loads CSS styles for admin panel styling
 */

define ('LIVECHAT_PLUGIN_URL', WP_PLUGIN_URL . str_replace('\\', '/', strrchr(dirname(__FILE__), DIRECTORY_SEPARATOR)) . '/plugin_l2s');
define ('LIVECHAT_SITEID_INSTALLED', (bool)(strlen(get_option('livechat_site_id') > 0)));

function l2s_admin_head()
{
	echo '<style type="text/css">';
	echo '@import url('.LIVECHAT_PLUGIN_URL.'/styles.css);';
	echo '</style>';
}

/**
 * Loads jQuery scripts in admin panel
 */
function l2s_admin_footer()
{
	echo '<script type="text/javascript" src="'.LIVECHAT_PLUGIN_URL.'/js/scripts.js?v=2011-05-13"></script>';
	/* '<script type="text/javascript" src="'.LIVECHAT_PLUGIN_URL.'/js/signup.js?v=2010-06-23"></script>';*/
}

/**
 * Creates new admin menu
 */
function l2s_settings_link($links)
{
	$settings_link = sprintf( '<a href="admin.php?page=l2s_settings">%s</a>', __('Settings'));
	array_unshift ($links, $settings_link); 
	return $links;
}

function l2s_admin_menu()
{
	global $wp_registered_sidebars;
	define('LIVECHAT_WIDGETS_ENABLED', (bool)(sizeof($wp_registered_sidebars) > 0));


	add_menu_page ('Live chat settings', 'Live chat', 'administrator', 'l2s_settings', 'l2s_settings', '');
	add_submenu_page ('l2s_settings', 'Live chat settings', 'Settings', 'administrator', 'l2s_settings', 'l2s_settings');
	//if (LIVECHAT_SITEID_INSTALLED && LIVECHAT_WIDGETS_ENABLED == false) add_submenu_page ('l2s_settings', 'Chat button', 'Chat button', 'administrator', 'l2s_code', 'l2s_code');
	add_submenu_page ('l2s_settings', 'Control Panel', 'Control Panel', 'administrator', 'l2s_control_panel', 'l2s_control_panel');

	// Settings link
	$plugin = plugin_basename(__FILE__);
	add_filter( 'plugin_action_links_'.$plugin, 'l2s_settings_link');
}

add_action ('admin_head', 'l2s_admin_head');
add_action ('admin_footer', 'l2s_admin_footer');
add_action ('admin_menu', 'l2s_admin_menu');
//add_action ('admin_init', 'l2s_admin_register_settings');

//
// Main settings page
//

function l2s_settings()
{
	require_once (dirname(__FILE__).'/settings.php');

	_livechat_settings();
}

//
// Control panel page
//

function l2s_control_panel()
{
   echo '<iframe id="control_panel" src="https://live2support.com/cpn/login.php" frameborder="0"></iframe>';
   echo '<p>Optionally, open the Control Panel in <a href="https://live2support.com/cpn/login.php" target="_blank">external window</a>.</p>';
}

function l2s_code_widget()
{
	//require_once (dirname(__FILE__).'/l2scode.php');

	//list ($site_id, $lang, $groups, $params) = l2s_read_options();

	//_livechat_chat_button_widget ();
			$path = dirname(__FILE__) . '/l2scode.txt';
		
		if (!file_exists($path)) return;
	
		$l2scode = file_get_contents($path);
		

		// Return Live2Support code
		
		echo $l2scode;

}



wp_register_sidebar_widget ('l2s_widget', 'Live chat for Wordpress', 'l2s_code_widget');
