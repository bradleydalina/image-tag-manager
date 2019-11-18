<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'The wrong way access...' );
/**
* Plugin Constants
*/
define('ITM_PLUGIN','image-tag-manager');
/**
* Define Constant Directory Paths
*/
define("ITM_RELPATH", trailingslashit(realpath(plugin_dir_path(__DIR__))) );
define("ITM_ABSPATH", trailingslashit(plugin_dir_url(__DIR__)));
/**
* Plugin Info
*/
define("ITM_PLUGNAME", get_plugin_data( realpath(ITM_RELPATH)."/".ITM_PLUGIN.".php" )['Name']);
define("ITM_URI", get_plugin_data( realpath(ITM_RELPATH)."/".ITM_PLUGIN.".php" )['PluginURI']);
define('ITM_VERSION', get_plugin_data( realpath(ITM_RELPATH)."/".ITM_PLUGIN.".php" )['Version']);
define('ITM_DESCRIPTION', get_plugin_data( realpath(ITM_RELPATH)."/".ITM_PLUGIN.".php" )['Description']);
