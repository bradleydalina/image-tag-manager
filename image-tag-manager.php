<?php
/**
 * Plugin Name:       Image Tag Manager
 * Plugin URI:        http://wordpress.org/plugins/image-tag-manager/
 * Description:       This plugin allows you to dynamically generates (alt, title, caption and description) in any images of your site for SEO enhancement.
 * Version:           1.4
 * Requires at least: 4.6
 * Tested up to:      5.3
 * Stable tag:        1.4
 * Requires PHP:      5.2.4
 * Author:            Bradley B. Dalina
 * Author URI:        https://www.bradley-dalina.tk/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       image-tag-manager
 */

 /**
  * Coding Standard Guide
  * Constants & Defined - Uppercase
  * Variables - Lowercase separated with underscore
  * Function - Camel Case
  */

/**
 * Restrict Direct Access
 */
 defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
 * Inlcudes Required Files
 */
 if(!function_exists('get_plugin_data')) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 require_once( ABSPATH . "wp-includes/pluggable.php" );
 require_once( trailingslashit(realpath(plugin_dir_path(__FILE__)))."admin/define.php" );
 require_once ITM_RELPATH. 'library/itm-filter-activation.php';
 require_once ITM_RELPATH. 'library/itm-filter-uninstallation.php';
 require_once ITM_RELPATH. 'library/itm-filter-helper.php';
 require_once ITM_RELPATH. 'library/itm-filter-attributes.php';
 require_once ITM_RELPATH. 'admin/core.php';
