<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
 * This functions are helper functions and being called by other main functions
 */

 /**
 * For reference here the list of the functions that relies in file
 *------------------------------------------------------------------------------
 * itm-filter-buffer.php
 * itm-filter-save.php
 *------------------------------------------------------------------------------
 * List of functions inside, included/required to run this main function
 *------------------------------------------------------------------------------
 * -> itm plugin helper function => itm_filter_title
 * -> itm plugin helper function => itm_filter_sanitized
 * -> itm plugin helper function => itm_filter_append
 * -> itm plugin helper function => itm_filter_standardized_filename
 *------------------------------------------------------------------------------
 * -> wordpress function => attachment_url_to_postid
 * -> wordpress function => get_post
 * -> wordpress function => get_post_meta
 * -> wordpress function => get_option
 * -> wordpress function => get_network_option
 * -> wordpress function => get_bloginfo
 * -> wordpress function => esc_attr
 * -> wordpress function => wp_upload_dir
 * -> wordpress function => wp_unique_filename
 *------------------------------------------------------------------------------
 * -> php core function => preg_match
 * -> php core function => preg_match_all
 * -> php core function => str_replace
 * -> php core function => strireplace
 * -> php core function => substr_replace
 * -> php core function => stripos
 * -> php core function => substr
 * -> php core function => sprintf
 * -> php core function => stripslashes
 * -> php core function => foreach
 * -> php core function => pathinfo
 * -> php core function => strtolower
 * -> php core function => strtoupper
 * -> php core function => ucwords
 * -> php core function => strtolower
 * -> php core function => trim
 * -> php core function => isset
 * -> php core function => empty
 * -> php core function => intval
 * -> php core function => intval
 * -> php core function => count
 * -> php core function => explode
 * @since		1.3
 */

 //Naming settings

 if(!function_exists('itm_filter_title')){
     function itm_filter_title( $image_title, $post_title = '' ) {
         /**
         * This functions Transform the title into a valid and more decent Title
         * It remove unwanted characters
         */
         $image_title = itm_filter_sanitized( $image_title);
         //Falback
         $post_title = esc_attr( $post_title );
         //Falback
         $blog_title = esc_attr( get_bloginfo('name') );
         /**
         * This functions Check the validity fo the filename to be used as Title and Alt Tags
         * 3 or more letters is valid as title
         */
         $itm_preserved_char = 0;
         $itm_use_post_title_as_default = false;
         if(is_multisite()){
             $itm_preserved_char = intval(get_network_option(null, "itm_preserved_char"));
             if(intval(get_network_option(null, 'itm_use_post_title_as_default'))){
                 $itm_use_post_title_as_default = true;
             }
         }else{
             $itm_preserved_char = intval(get_option("itm_preserved_char"));
             if(intval(get_option('itm_use_post_title_as_default'))){
                 $itm_use_post_title_as_default = true;
             }
         }
         //Transform if preserved_char is set to false
         if($itm_preserved_char!=1 && $itm_preserved_char!=2) {
             /* Count the letters of the title if still valid to set as title*/
             $count = preg_match_all('/[a-zA-Z]/smiU', $image_title, $result_match);
             if($count < 3) {
                 if($itm_use_post_title_as_default) {
                     if(empty(trim($post_title))) {
                         $image_title = $blog_title;
                     }else{
                         $image_title = $post_title;
                     }
                 }
             }
         }
         return $image_title;
     }
 }
 if(!function_exists('itm_filter_string_case')){
    function itm_filter_string_case($image_title){
        /* Convert to proper case base on the settings provided */
        $itm_string_case = 0;
        if(is_multisite()){
            $itm_string_case = intval(get_network_option(null, "itm_string_case"));
        }else{
            $itm_string_case = intval(get_option("itm_string_case"));
        }
        $image_title = trim($image_title);
        switch($itm_string_case){
            case 1:
                $image_title = strtolower( $image_title );
            break;
            case 2:
                $image_title = strtoupper( $image_title );
            break;
            case 3:
                $image_title = ucwords( strtolower( $image_title ) );
            break;
            case 4:
                $image_title=substr_replace(strtolower($image_title), strtoupper(substr(strtolower($image_title), 0, 1)), 0, 1);
            break;
        }
        return $image_title;
    }
 }
 if(!function_exists('itm_filter_sanitized')){
    function itm_filter_sanitized($string, $is_file = false) {
        /**
        * This functions Transform the title into a valid and more decent Title
        * It remove unwanted characters
        */
        $string = esc_attr($string);
        $itm_strip_numbers = false;
        $itm_preserved_char =0;
        if(is_multisite()){
            $itm_preserved_char = intval(get_network_option(null, "itm_preserved_char"));
            if(intval(get_network_option(null, 'itm_strip_numbers'))){
                $itm_strip_numbers = true;
            }
        }else{
            $itm_preserved_char = intval(get_option("itm_preserved_char"));
            if(intval(get_option('itm_strip_numbers'))){
                $itm_strip_numbers = true;
            }
        }
        //Transform if preserved_char is set to 0 it means clean all
        if($itm_preserved_char==0 || intval($is_file)) {
            /* Remove any non-word chacacter accepts [a-zA-Z0-9]*/
            $string = preg_replace( '%[^\w]%', ' ', $string );//,!?
        }
        //Transform if preserved_char is set to 0 or 1 it means allow number stripping
        if($itm_preserved_char!=1 || intval($is_file)) {
            if($itm_strip_numbers) {
                /* Remove/Strip first dimensional resolution if present in the filename like "Bradley Dalina 1024x768.jpg" */
                $string = preg_replace( '%\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?%smiU', ' ',  $string );
                // Remove all numbers
                $string = preg_replace('/[0-9]/smiU', '', $string);
            }
        }
        /* Remove multiple underscore & hypens */
        $string = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $string );
        /* Remove multiple spaces & tabs */
        $string = preg_replace( '%\s\s+%', ' ', $string );
        /* Trim spaces in the start and end of string */
        return trim( $string );
    }
 }
 if(!function_exists('itm_filter_trim')){
    function itm_filter_trim($image_title, $attribute="alt"){
        if(!empty($attribute)){
            /* Run if plugin option for to add blog post title is set to true */
            $itm_string_trimmer = false;
            $trim_from_attribute = array();
            if(is_multisite()){
                if(intval(get_network_option(null, 'itm_string_trimmer'))){
                    $itm_string_trimmer = true;
                }
                $trim_from_attribute = explode(",", get_network_option(null, "itm_remove_from_".$attribute));
            }else{
                if(intval(get_option('itm_string_trimmer'))){
                    $itm_string_trimmer = true;
                }
                $trim_from_attribute = explode(",", get_option("itm_remove_from_".$attribute));
            }
            if($itm_string_trimmer) {
                if(count($trim_from_attribute) > 0) {
                    for($i=0; $i < count($trim_from_attribute); $i++){
                        $image_title=preg_replace("%(?<![\w\d])".trim($trim_from_attribute[$i])."(?![\w\d])%i", "", $image_title);
                    }
                    $image_title = trim(preg_replace( '%\s\s+%', ' ', $image_title ));
                }
            }
        }
        return $image_title;
    }
 }
 if(!function_exists('itm_filter_append')){
      function itm_filter_append($image_title,$post_title, $post_category, $attribute="alt"){
          $post_title = esc_attr($post_title);
          $post_category = esc_attr($post_category);
          /* Check the separator*/

          $separator = ' - ';
          $itm_string_trimmer = false;
          $trim_from_attribute = array();
          $itm_add_post_title_to_attribute =false;
          $itm_add_post_category_to_attribute =false;
          if(is_multisite()){
              if(intval(get_network_option(null, 'itm_bar_separator'))){
                  $separator = ' | ';
              }
              if(intval(get_network_option(null, 'itm_string_trimmer'))){
                  $itm_string_trimmer = true;
              }
              $trim_from_attribute = explode(",", get_network_option(null, "itm_remove_from_".$attribute));
              if(intval(get_network_option(null, "itm_add_post_title_to_".$attribute))){
                  $itm_add_post_title_to_attribute = true;
              }
              if(intval(get_network_option(null, "itm_add_post_category_to_".$attribute))){
                  $itm_add_post_category_to_attribute = true;
              }
          }
          else{
              if(intval(get_option('itm_bar_separator'))) {
                  $separator = ' | ';
              }
              if(intval(get_option('itm_string_trimmer'))) {
                  $itm_string_trimmer = true;
              }
              $trim_from_attribute = explode(",", get_option("itm_remove_from_".$attribute));
              if(intval(get_option("itm_add_post_title_to_".$attribute))){
                  $itm_add_post_title_to_attribute = true;
              }
              if(intval(get_option("itm_add_post_category_to_".$attribute))){
                  $itm_add_post_category_to_attribute = true;
              }
          }

          if(!empty($attribute)){
              /* Run if plugin option for to add blog post title is set to true */
              if($itm_string_trimmer) {
                  if(count($trim_from_attribute) > 0) {
                      for($i=0; $i < count($trim_from_attribute); $i++){
                          $image_title=preg_replace("%(?<![\w\d])".trim($trim_from_attribute[$i])."(?![\w\d])%i", "", $image_title);
                      }
                      $image_title = trim(preg_replace( '%\s\s+%', ' ', $image_title ));
                  }
              }

              if($itm_add_post_title_to_attribute && !empty($post_title)) {
                  /* Check if Post title is already present in the alt or title */
                  if(stripos($image_title, itm_filter_sanitized($post_title)) === false) {
                      $image_title .= (!empty(trim($post_title))) ? $separator.$post_title : '';
                  }
              }
              if($itm_add_post_category_to_attribute && !empty($post_category)) {
                  /* Check if Post title is already present in the alt or title */
                  if(stripos($image_title, itm_filter_sanitized($post_category)) === false) {
                      if(strtolower($post_category)!='uncategorized'){
                          $image_title .= (!empty(trim($post_category))) ? $separator.$post_category : '';
                      }
                  }
              }
          }
          return $image_title;
      }
 }
 if(!function_exists('itm_filter_standardized_filename')){
    function itm_filter_standardized_filename($image_filename, $post_title='') {
        /*
        * This function standadized the filename of an image
        */
        $image_ext = pathinfo( $image_filename, PATHINFO_EXTENSION );
        $image_name = pathinfo( $image_filename, PATHINFO_FILENAME );

        $image_name = itm_filter_sanitized( $image_name, true );
        $blog_title = itm_filter_sanitized( get_bloginfo('name'), true);
        $post_title = itm_filter_sanitized( $post_title, true);

        $uploads_dir = wp_upload_dir()['path'];

        //Check if Multisite
        $itm_strip_numbers = false;
        $itm_use_post_title_as_default = false;

        if(is_multisite()){
            if(intval(get_network_option(null, 'itm_strip_numbers'))){
                $itm_strip_numbers = true;
            }
            if(intval(get_network_option(null, 'itm_use_post_title_as_default'))){
                $itm_use_post_title_as_default = true;
            }
        }
        else{
            if(intval(get_option('itm_strip_numbers'))) {
                $itm_strip_numbers = true;
            }
            if(intval(get_option('itm_use_post_title_as_default'))) {
                $itm_use_post_title_as_default = true;
            }
        }

        if($itm_strip_numbers) {
            /* Count the letters of the title if still valid to set as title*/
            $count = preg_match_all('/[a-zA-Z]/smiU', $image_name, $result_match);

            if($count >= 3) {
                /* Return if Morethan 3 letters */
                return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
            }

            if($itm_use_post_title_as_default){
                if(empty(trim($post_title))) {
                    return wp_unique_filename( $uploads_dir, strtolower($blog_title.'.'.$image_ext) );
                }
                return wp_unique_filename( $uploads_dir, strtolower($post_title.'.'.$image_ext) );
            }

            return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
        }
        return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
    }
 }
