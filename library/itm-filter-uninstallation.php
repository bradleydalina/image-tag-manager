<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
if(!function_exists('itm_filter_uninstallation')){
    function itm_filter_uninstallation() {
        /*
        *   On plugin uninstall, delete this options in the database.
        */
        if ( is_multisite() ) {
            //Basic settings
            delete_network_option( null, 'itm_image_caption' );
            delete_network_option( null, 'itm_image_description' );
            delete_network_option( null, 'itm_override_alt' );
            delete_network_option( null, 'itm_override_title' );
            //Naming settings
            delete_network_option( null, 'itm_preserved_char' );
            delete_network_option( null, 'itm_strip_numbers' );
            delete_network_option( null, 'itm_use_post_title_as_default' );
            delete_network_option( null, 'itm_bar_separator' );
            delete_network_option( null, 'itm_add_post_title_to_alt' );
            delete_network_option( null, 'itm_add_post_title_to_title' );
            delete_network_option( null, 'itm_add_post_category_to_alt' );
            delete_network_option( null, 'itm_add_post_category_to_title' );
            delete_network_option( null, 'itm_string_trimmer' );
            delete_network_option( null, 'itm_remove_from_alt' );
            delete_network_option( null, 'itm_remove_from_title' );
            delete_network_option( null, 'itm_string_case' );
            //Extra settings
            delete_network_option( null, 'itm_add_class' );
            delete_network_option( null, 'itm_scope_class' );
            delete_network_option( null, 'itm_default_class' );
            delete_network_option( null, 'itm_remove_srcset_sizes' );
            //Advance Settings
            delete_network_option( null, 'itm_data_saving' );
		}
        /**
        * Delete database entries
        *
        * @since		1.0
        */
        //Basic settings
        delete_option( 'itm_image_caption' );
        delete_option( 'itm_image_description' );
        delete_option( 'itm_override_alt' );
        delete_option( 'itm_override_title' );
        //Naming settings
        delete_option( 'itm_preserved_char' );
        delete_option( 'itm_strip_numbers' );
        delete_option( 'itm_use_post_title_as_default' );
        delete_option( 'itm_bar_separator' );
        delete_option( 'itm_add_post_title_to_alt' );
        delete_option( 'itm_add_post_title_to_title' );
        delete_option( 'itm_add_post_category_to_alt' );
        delete_option( 'itm_add_post_category_to_title' );
        delete_option( 'itm_string_trimmer' );
        delete_option( 'itm_remove_from_alt' );
        delete_option( 'itm_remove_from_title' );
        delete_option( 'itm_string_case' );
        //Extra settings
        delete_option( 'itm_add_class' );
        delete_option( 'itm_scope_class' );
        delete_option( 'itm_default_class' );
        delete_option( 'itm_remove_srcset_sizes' );
        //Advance Settings
        delete_option( 'itm_data_saving' );
    }
}
