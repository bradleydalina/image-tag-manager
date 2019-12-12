<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
if(!function_exists('itm_filter_activation')){
    function itm_filter_activation() {
        /**
        * The Plugin Activation Hook
        * Initialized Default Values in the First Activation
        */
        /**
        * Initilized Generic Plugin Variables With Default Values
        */
        $deprecated = false;
        $autoload = null;
        /*
        *   On plugin activation, set this options default values as default settings.
        */
        if ( is_multisite() ) {
            /*
            *   Basic Settings
            */
            if ( get_network_option( null, 'itm_image_caption' ) === false ){ add_network_option( null, 'itm_image_caption', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_image_description' ) === false ){ add_network_option( null, 'itm_image_description', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_override_alt' ) === false ){ add_network_option( null, 'itm_override_alt', 0,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_override_title' ) === false ){ add_network_option( null, 'itm_override_title', 0,$deprecated, $autoload );}
            /*
            *   Naming Settings
            */
            if ( get_network_option( null, 'itm_preserved_char' ) === false ){ add_network_option( null, 'itm_preserved_char', 0,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_strip_numbers' ) === false ) { add_network_option( null, 'itm_strip_numbers', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_use_post_title_as_default' ) === false ) { add_network_option( null, 'itm_use_post_title_as_default', 1 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_bar_separator' ) === false ){ add_network_option( null, 'itm_bar_separator', 0,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_add_post_title_to_alt' ) === false ){ add_network_option( null, 'itm_add_post_title_to_alt', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_add_post_title_to_title' ) === false ){ add_network_option( null, 'itm_add_post_title_to_title', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_add_post_category_to_alt' ) === false ){ add_network_option( null, 'itm_add_post_category_to_alt', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_add_post_category_to_title' ) === false ){ add_network_option( null, 'itm_add_post_category_to_title', 0 ,$deprecated, $autoload );}

            if ( get_network_option( null, 'itm_string_trimmer' ) === false ){ add_network_option( null, 'itm_string_trimmer', 0,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_remove_from_alt' ) === false ){ add_network_option( null, 'itm_remove_from_alt', '' ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_remove_from_title' ) === false ){ add_network_option( null, 'itm_remove_from_title', '' ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_string_case' ) === false ){ add_network_option( null, 'itm_string_case', 3,$deprecated, $autoload );}
            /*
            *   Extra Settings
            */
            if ( get_network_option( null, 'itm_add_class' ) === false ) {	add_network_option( null, 'itm_add_class', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_scope_class' ) === false ) {	add_network_option( null, 'itm_scope_class', 0 ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_default_class' ) === false ) {	add_network_option( null, 'itm_default_class', '' ,$deprecated, $autoload );}
            if ( get_network_option( null, 'itm_remove_srcset_sizes' ) === false ) {	add_network_option( null, 'itm_remove_srcset_sizes', 0 ,$deprecated, $autoload );}
            /*
            *   Advance Settings
            */
            if ( get_network_option( null, 'itm_data_saving' ) === false ){ add_network_option( null, 'itm_data_saving', 0 ,$deprecated, $autoload );}
		}
        /*
        *   Basic Settings
        */
        if ( get_option( 'itm_image_caption' ) === false ){ add_option( 'itm_image_caption', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_image_description' ) === false ){ add_option( 'itm_image_description', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_override_alt' ) === false ){ add_option( 'itm_override_alt', 0,$deprecated, $autoload );}
        if ( get_option( 'itm_override_title' ) === false ){ add_option( 'itm_override_title', 0,$deprecated, $autoload );}
        /*
        *   Naming Settings
        */
        if ( get_option( 'itm_preserved_char' ) === false ){ add_option( 'itm_preserved_char', 0,$deprecated, $autoload );}
        if ( get_option( 'itm_strip_numbers' ) === false ) { add_option( 'itm_strip_numbers', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_use_post_title_as_default' ) === false ) { add_option( 'itm_use_post_title_as_default', 1 ,$deprecated, $autoload );}
        if ( get_option( 'itm_bar_separator' ) === false ){ add_option( 'itm_bar_separator', 0,$deprecated, $autoload );}
        if ( get_option( 'itm_add_post_title_to_alt' ) === false ){ add_option( 'itm_add_post_title_to_alt', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_add_post_title_to_title' ) === false ){ add_option( 'itm_add_post_title_to_title', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_add_post_category_to_alt' ) === false ){ add_option( 'itm_add_post_category_to_alt', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_add_post_category_to_title' ) === false ){ add_option( 'itm_add_post_category_to_title', 0 ,$deprecated, $autoload );}

        if ( get_option( 'itm_string_trimmer' ) === false ){ add_option( 'itm_string_trimmer', 0,$deprecated, $autoload );}
        if ( get_option( 'itm_remove_from_alt' ) === false ){ add_option( 'itm_remove_from_alt', '' ,$deprecated, $autoload );}
        if ( get_option( 'itm_remove_from_title' ) === false ){ add_option( 'itm_remove_from_title', '' ,$deprecated, $autoload );}
        if ( get_option( 'itm_string_case' ) === false ){ add_option( 'itm_string_case', 3,$deprecated, $autoload );}
        /*
        *   Extra Settings
        */
        if ( get_option( 'itm_add_class' ) === false ) {	add_option( 'itm_add_class', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_scope_class' ) === false ) {	add_option( 'itm_scope_class', 0 ,$deprecated, $autoload );}
        if ( get_option( 'itm_default_class' ) === false ) {	add_option( 'itm_default_class', '' ,$deprecated, $autoload );}
        if ( get_option( 'itm_remove_srcset_sizes' ) === false ) {	add_option( 'itm_remove_srcset_sizes', 0 ,$deprecated, $autoload );}
        /*
        *   Advance Settings
        */
        if ( get_option( 'itm_data_saving' ) === false ){ add_option( 'itm_data_saving', 0 ,$deprecated, $autoload );}
    }
}
