<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
 /**
 * For reference here the list of the functions used
 * List of functions inside, included/required to run this main function
 * -> itm plugin main function => itm_filter_run
 * -> itm plugin sub function => itm_filter_apply_replace
 * -> itm plugin sub function => itm_filter_after_upload
 * -> itm plugin main function => itm_filter_buffer_start
 * -> itm plugin main function => itm_filter_buffer_end
 *------------------------------------------------------------------------------
 * require_once( itm-filter-helper.php function );
 * -> itm plugin helper function => itm_filter_title
 * -> itm plugin helper function => itm_filter_append
 * -> itm plugin helper function => itm_filter_standardized_filename
 *------------------------------------------------------------------------------
 * -> wordpress function => attachment_url_to_postid
 * -> wordpress function => get_post
 * -> wordpress function => get_post_meta
 * -> wordpress function => get_option
 * -> wordpress function => get_network_option
 * -> wordpress function => add_action
 *------------------------------------------------------------------------------
 * -> php core function => preg_match
 * -> php core function => preg_replace_callback
 * -> php core function => str_replace
 * -> php core function => sprintf
 * -> php core function => stripslashes
 * -> php core function => pathinfo
 * -> php core function => trim
 * -> php core function => empty
 * -> php core function => intval
 * -> php core function => stripos
 * @since		1.3
 */
 /**
  * This functions run and filters the post content before saving into the database.
  * There is a database effect or changes
  */
 add_filter( 'content_save_pre', 'itm_filter_run', 100, 1);
 add_action( 'add_attachment', 'itm_filter_upload_attachment', 100 );
 add_filter( 'wp_handle_upload_prefilter', 'itm_filter_after_upload' , 20 );

 add_filter('the_content', 'itm_filter_entry_post', 120);
 /**
  * This functions run and filters the buffer content before rendering into the users browsers.
  * No database effect or changes
  */
 add_action('wp_head', 'itm_filter_buffer_start', 100);
 add_action('wp_footer', 'itm_filter_buffer_end', 100);

 $itm_remove_srcset_sizes = false;
 if(is_multisite()){
     if(intval(get_network_option(null, 'itm_remove_srcset_sizes'))){
         $itm_remove_srcset_sizes = true;
     }
 }else{
     if(intval(get_option('itm_remove_srcset_sizes'))){
         $itm_remove_srcset_sizes = true;
     }
 }

 if($itm_remove_srcset_sizes){
     add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
     add_filter( 'wp_calculate_image_srcset', '__return_false' );
     add_filter( 'wp_calculate_image_srcset_meta', '__return_empty_array' );
     remove_filter( 'the_content', 'wp_make_content_images_responsive' );
 }

 /**
 * Variable declaration and initialization
 */
 $new_image_alt ='';                     // Declare new alt variable
 $new_image_title ='';                   // Declare new title variable

 /**
 * Get the plugin option settings to be applied in the function
 */

 if(!function_exists('itm_filter_run')){
    function itm_filter_run($content) {

        global $post;
        $post_title = $post->post_title; //Get Post title of the Current Page/Post
         /**
         * This functions Run the filter in every img occurence
         */
         $itm_data_saving = false;
         if(is_multisite()){
             if(intval(get_network_option(null, 'itm_data_saving'))){
                 $itm_data_saving = true;
             }
         }else{
             if(intval(get_option('itm_data_saving'))){
                 $itm_data_saving = true;
             }
         }
         if(is_admin() && !$itm_data_saving) {
             return $content;
         }
         $content = preg_replace_callback("/<img[^>]+>/smiU", 'itm_filter_apply_replace', $content, -1, $count);
         return $content;
    }
 }
 if(!function_exists('itm_filter_apply_replace')){
    function itm_filter_apply_replace($image_row) {
        $itm_override_alt = false;
        $itm_override_title = false;
        $itm_add_class = false;
        $itm_scope_class = false;
        $itm_default_class='';
        if(is_multisite()){
            if(intval(get_network_option(null, 'itm_override_alt'))){
                $itm_override_alt = true;
            }
            if(intval(get_network_option(null, 'itm_override_title'))){
                $itm_override_title = true;
            }
            if(intval(get_network_option(null, 'itm_add_class'))){
                $itm_add_class = true;
            }
            if(intval(get_network_option(null, 'itm_scope_class'))){
                $itm_scope_class = true;
            }
            $itm_default_class= get_network_option(null, 'itm_default_class');
        }
        else{
            if(intval(get_option("itm_override_alt"))){
                $itm_override_alt = true;
            }
            if(intval(get_option("itm_override_title"))){
                $itm_override_title = true;
            }
            if(intval(get_option("itm_add_class"))){
                $itm_add_class = true;
            }
            if(intval(get_option("itm_scope_class"))){
                $itm_scope_class = true;
            }
            $itm_default_class= get_option('itm_default_class');
        }
        //Match with img source attribute to get the filename
        preg_match('/(?<=src=\\")[^\\"].*(?=\\")/ismU', stripslashes($image_row[0]), $image_url);
        // Extract the filename
        $image_filename = pathinfo($image_url[0]);
        if(preg_match('/class="([^"]*wp-image-\d*)"/ims', stripslashes($image_row[0]), $all_class)) {
            $get_id = preg_match('/wp-image-\d+/i', $all_class[0], $filtered_class);
            $image_id = trim(preg_replace('/wp-image-/i', '', $filtered_class[0]));
        }
        // else get the image id using the attachment_url_to_postid
        else{
            $image_id = attachment_url_to_postid($image_url[0]);
            if(!$image_id){
                $image_info =pathinfo($image_url[0]);
                $base_url = $image_info['dirname'];
                $base_filename = $image_info['basename'];
                $base_filename = preg_replace( '%\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?%smiU', ' ',  $base_filename );
                $image_id = attachment_url_to_postid(trailingslashit($base_url).$base_filename);
            }
        }
        // get the image post parent
        $post_parent = get_post( $image_id )->post_parent;
        // get the image post parent title
        $post_title = ($post_parent) ? get_post( $post_parent )->post_title : '';
        $image_own_title = (!empty(get_post( $image_id )->post_title)) ? get_post( $image_id )->post_title : get_post( $image_id )->post_name;
        // Sanitize and Transform into valid title format
        $image_formatted_name = itm_filter_title( $image_own_title, $image_filename['filename'] );
        //Get image own attachment alt
        $image_own_alt = isset(get_post_meta( $image_id )['_wp_attachment_image_alt'][0]) ? get_post_meta( $image_id )['_wp_attachment_image_alt'][0] : '';
        $image_own_alt = (!empty($image_own_alt)) ? $image_own_alt : $image_formatted_name;
        $image_own_alt = itm_filter_title( $image_own_alt, $image_formatted_name );
        if($post_parent) {
            $categories = get_the_category($post_parent);
            $category = (! empty( $categories ) ) ? $categories[0]->name : '';
        }
        else{
            $category='';
        }
        if(is_admin()){
            $new_image_alt = itm_filter_append($image_own_alt, $post_title, $category, "alt");
            $new_image_title = itm_filter_append($image_formatted_name, $post_title, $category, "title");
        }
        else{
            $new_image_alt = itm_filter_trim($image_own_alt, "alt");
            $new_image_title = itm_filter_trim($image_formatted_name, "title");
        }
        //Prepare a variable for new content replace
        $new_content = $image_row[0];
        $new_image_alt = itm_filter_string_case($new_image_alt);
        $new_image_title = itm_filter_string_case($new_image_title);

        /* Check if alt is already present in the image */
        if(stripos($image_row[0], "alt=") === false) {
            // Prepare the new attribute value
            $new_attributes = sprintf( ' alt="%s"', $new_image_alt);
            // Actual insertion of attribute and its value
            $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
        }
        else{
            if(preg_match( '~(alt=\\")(.*?)(\\")~is' ,stripslashes($image_row[0]), $current_alt)) {
                #/title="([^"]*)"/i
                //Remove space for checking valid content
                //Update
                $old_alt = trim($current_alt[2]);
                if(!empty(trim($old_alt))){
                    if($itm_override_alt && stripos(strtolower(trim($new_image_alt)), strtolower(trim($old_alt))==FALSE )){
                        //We are allowed to override and the alt is not equal to plugin recommended alt
                        $new_attributes = sprintf( 'alt="%s"', $new_image_alt);
                        $new_content = str_replace( $current_alt[0], $new_attributes , $new_content);
                    }
                }
                else{
                    //We are allowed to override and the alt is not equal to plugin recommended alt
                    $new_attributes = sprintf( 'alt="%s"', $new_image_alt);
                    $new_content = str_replace( $current_alt[0], $new_attributes , $new_content);
                }
            }
        }
        if(stripos($image_row[0], "title=") === false) {
            // Prepare the new attribute value
            $new_attributes = sprintf( ' title="%s"', $new_image_title);
            // Actual insertion of attribute and its value
            $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
        }
        else {
            if(preg_match('~(title=\\")(.*?)(\\")~is',stripslashes($image_row[0]), $current_title)) {
                //Remove space for checking valid content
                $old_title = trim($current_title[2]);
                if(!empty(trim($old_title))){
                    if($itm_override_title && stripos(strtolower(trim($new_image_title)), strtolower(trim($old_title))==FALSE) ){
                        $new_attributes = sprintf( 'title="%s"', $new_image_title);
                        $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                    }
                }
                else{
                    $new_attributes = sprintf( 'title="%s"', $new_image_title);
                    $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                }
            }
        }
        if( $itm_add_class ) {
            if( $itm_scope_class ) {
                /**
                * Check if above was executed and the content has been modified
                */
                if(stripos($image_row[0], "class=") === false) {
                     // Prepare the new attribute value
                     $new_attributes = sprintf( ' class="%s"', $itm_default_class." wp-image-{$image_id}");
                     // Actual insertion of attribute and its value
                     $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
                }
                else {
                    if(preg_match('~(class=\\")(.*?)(\\")~is',stripslashes($image_row[0]), $current_class)) {
                        //Remove space for checking valid content
                        $old_class = trim($current_class[2]);
                        if(!empty( trim($old_class) )){
                            $class_list = explode(" ", $itm_default_class);
                            for($i=0; $i < count($class_list); $i++){
                                if(!stripos($class_list[$i], $old_class)){
                                    $new_content = str_replace( 'class="', 'class="'.$class_list[$i].' ', $new_content);
                                }
                            }
                        }else{
                            $new_attributes = sprintf( 'class="%s"', $itm_default_class." wp-image-{$image_id}");
                            $new_content = str_replace( $current_class[0], $new_attributes , $new_content);
                        }
                    }
                }
            }
        }
        //return new content with appended and updated tags
        return $new_content;
    }
 }
 if(!function_exists('itm_filter_entry_post')){
    function itm_filter_entry_post($content) {

        global $post;
        $post_title = $post->post_title;        //Get Post title of the Current Page/Post

         /**
         * This functions Run the filter in every img occurence
         */
         $content = preg_replace_callback("/<img[^>]+>/smiU", 'itm_filter_apply_entry_post_replace', $content, -1, $count);
         return $content;
    }
 }
 if(!function_exists('itm_filter_apply_entry_post_replace')){
    function itm_filter_apply_entry_post_replace($image_row) {
        $itm_override_alt = false;
        $itm_override_title = false;
        $itm_add_class = false;
        $itm_scope_class = false;
        $itm_default_class='';
        if(is_multisite()){
            if(intval(get_network_option(null, 'itm_override_alt'))){
                $itm_override_alt = true;
            }
            if(intval(get_network_option(null, 'itm_override_title'))){
                $itm_override_title = true;
            }
            if(intval(get_network_option(null, 'itm_add_class'))){
                $itm_add_class = true;
            }
            if(intval(get_network_option(null, 'itm_scope_class'))){
                $itm_scope_class = true;
            }
            $itm_default_class= get_network_option(null, 'itm_default_class');
        }else{
            if(intval(get_option("itm_override_alt"))){
                $itm_override_alt = true;
            }
            if(intval(get_option("itm_override_title"))){
                $itm_override_title = true;
            }
            if(intval(get_option("itm_add_class"))){
                $itm_add_class = true;
            }
            if(intval(get_option("itm_scope_class"))){
                $itm_scope_class = true;
            }
            $itm_default_class= get_option('itm_default_class');
        }
        //Match with img source attribute to get the filename
        preg_match('/(?<=src=\\")[^\\"].*(?=\\")/ismU', stripslashes($image_row[0]), $image_url);
        // Extract the filename
        $image_filename = pathinfo($image_url[0]);
        if(preg_match('/class="([^"]*wp-image-\d*)"/ims', stripslashes($image_row[0]), $all_class)) {
            $get_id = preg_match('/wp-image-\d+/i', $all_class[0], $filtered_class);
            $image_id = trim(preg_replace('/wp-image-/i', '', $filtered_class[0]));
        }
        // else get the image id using the attachment_url_to_postid
        else{
            $image_id = attachment_url_to_postid($image_url[0]);
            if(!$image_id){
                $image_info =pathinfo($image_url[0]);
                $base_url = $image_info['dirname'];
                $base_filename = $image_info['basename'];
                $base_filename = preg_replace( '%\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?%smiU', ' ',  $base_filename );
                $image_id = attachment_url_to_postid(trailingslashit($base_url).$base_filename);
            }
        }
        //return $image_id;
        // get the image post parent
        $post_parent = get_post( $image_id )->post_parent;
        // get the image post parent title
        $post_title = ($post_parent) ? get_post( $post_parent )->post_title : '';
        $image_own_title = (!empty(get_post( $image_id )->post_title)) ? get_post( $image_id )->post_title : get_post( $image_id )->post_name;
        // Sanitize and Transform into valid title format
        $image_formatted_name = itm_filter_title( $image_own_title, $image_filename['filename'] );
        //Get image own attachment alt
        $image_own_alt = isset(get_post_meta( $image_id )['_wp_attachment_image_alt'][0]) ? get_post_meta( $image_id )['_wp_attachment_image_alt'][0] : '';
        $image_own_alt = (!empty(trim($image_own_alt))) ? $image_own_alt : $image_formatted_name;
        $image_own_alt = itm_filter_title( $image_own_alt, $image_formatted_name );
        if($post_parent) {
            $categories = get_the_category($post_parent);
            $category = (! empty( $categories ) ) ? $categories[0]->name : '';
        }
        else{
            $category='';
        }
        $new_image_alt = itm_filter_append($image_own_alt, $post_title, $category, "alt");
        $new_image_title = itm_filter_append($image_formatted_name, $post_title, $category, "title");
        $new_image_alt = itm_filter_string_case($new_image_alt);
        $new_image_title = itm_filter_string_case($new_image_title);
        //Prepare a variable for new content replace
        $new_content = $image_row[0];
        /* Check if alt is already present in the image */
        if(stripos($image_row[0], "alt=") === false) {
            // Prepare the new attribute value
            $new_attributes = sprintf( ' alt="%s"', $new_image_alt);
            // Actual insertion of attribute and its value
            $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
        }
        else {
            if(preg_match( '~(alt=\\")(.*?)(\\")~is' ,stripslashes($image_row[0]), $current_alt)) {
                #/title="([^"]*)"/i
                //Remove space for checking valid content
                //Update
                $old_alt = trim($current_alt[2]);
                if(!empty(trim($old_alt))){
                    if($itm_override_alt && strtolower((trim($old_alt)) != strtolower(trim($new_image_alt))) ){
                        //We are allowed to override and the alt is not equal to plugin recommended alt
                        $new_attributes = sprintf( 'alt="%s"', $new_image_alt);
                        $new_content = str_replace( $current_alt[0], $new_attributes , $new_content);
                    }
                }
                else{
                    //We are allowed to override and the alt is not equal to plugin recommended alt
                    $new_attributes = sprintf( 'alt="%s"', $new_image_alt);
                    $new_content = str_replace( $current_alt[0], $new_attributes , $new_content);
                }
            }
        }

        if(stripos($image_row[0], "title=") === false) {
            // Prepare the new attribute value
            $new_attributes = sprintf( ' title="%s"', $new_image_title);
            // Actual insertion of attribute and its value
            $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
        }
        else {
            if(preg_match('~(title=\\")(.*?)(\\")~is',stripslashes($image_row[0]), $current_title)) {
                //Remove space for checking valid content
                $old_title = trim($current_title[2]);
                if(!empty(trim($old_title))){
                    if($itm_override_title && strtolower((trim($old_title)) != strtolower(trim($new_image_title))) ){
                        $new_attributes = sprintf( 'title="%s"', $new_image_title);
                        $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                    }
                }
                else{
                    $new_attributes = sprintf( 'title="%s"', $new_image_title);
                    $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                }
            }
        }

        if( $itm_add_class ) {
            if( !$itm_scope_class ) {
                /**
                * Check if above was executed and the content has been modified
                */
                if(stripos($image_row[0], "class=") === false) {
                     // Prepare the new attribute value
                     $new_attributes = sprintf( ' class="%s"', $itm_default_class." wp-image-{$image_id}");
                     // Actual insertion of attribute and its value
                     $new_content = str_replace( "<img", "<img{$new_attributes}", $new_content);
                }
                else {
                    if(preg_match('~(class=\\")(.*?)(\\")~is',stripslashes($image_row[0]), $current_class)) {
                        //Remove space for checking valid content
                        $old_class = trim($current_class[2]);
                        if(!empty( trim($old_class) )){
                            $class_list = explode(" ", $itm_default_class);
                            for($i=0; $i < count($class_list); $i++){
                                if(!stripos($class_list[$i], $old_class)){
                                    $new_content = str_replace( 'class="', 'class="'.$class_list[$i].' ', $new_content);
                                }
                            }
                        }else{
                            $new_attributes = sprintf( 'class="%s"', $itm_default_class." wp-image-{$image_id}");
                            $new_content = str_replace( $current_class[0], $new_attributes , $new_content);
                        }
                    }
                }
            }
        }
        //return new content with appended and updated tags
        return $new_content;
    }
 }
 if(!function_exists('itm_filter_upload_attachment')){
    function itm_filter_upload_attachment( $post_id ) {
        /**
        * This functions Run the filter on upload, it sets the Alt, Title by deafult and Caption and desctio  if set true in the settings
        */
        //get the uploaded file title
        $file_title = get_post( $post_id )->post_title;
        $post_title='';
        //get the uploaded file parent attachment
        $post_parent = get_post( $post_id )->post_parent;
        //check if it has a parent
        if($post_parent) {
            $post_title = esc_attr(get_post( $post_parent )->post_title);
            $categories = get_the_category($post_parent);
            $category = (! empty( $categories ) ) ? esc_attr($categories[0]->name) : '';
        }
        else{
            $category='';
        }
        //check if file title was empty
        if(empty(trim($file_title))) {
            //use filename as fallback
            $file_title = itm_filter_title(pathinfo(get_permalink($post_ID))['filename'], $post_title);
        }
        else {
            $file_title = itm_filter_title( $file_title, $post_title);
        }

        $itm_image_caption = false;
        $itm_image_description = false;
        if(is_multisite()){
            if(intval(get_network_option(null, 'itm_image_caption'))){
                $itm_image_caption = true;
            }
            if(intval(get_network_option(null, 'itm_image_description'))){
                $itm_image_description = true;
            }
        }else{
            if(intval(get_option("itm_image_caption"))){
                $itm_image_caption = true;
            }
            if(intval(get_option("itm_image_description"))){
                $itm_image_description = true;
            }
        }
        $caption = ($itm_image_caption) ? itm_filter_string_case($file_title) : '';
        $description = ($itm_image_description) ? itm_filter_string_case($file_title) : '';

        $meta = /* Create an array with the file meta (Title, Caption, Description) to be updated */
        array(
            // Specify the file post (ID)
            'ID' => $post_id,
            // Set image Title
            'post_title' => itm_filter_string_case(itm_filter_append($file_title, "", "", "title")),
            // Set image Caption
            'post_excerpt' => $caption,
            // Set image Description
            'post_content' => $description
        );
        // Set the image meta (e.g. Title, Excerpt, Content)
        wp_update_post( $meta );

        /* Run only if uploaded file type is image becuase other file type does not have an alternative text attribute*/
        if ( wp_attachment_is_image( $post_id ) ) {
            // Set the image Alt-Text
            update_post_meta( $post_id, '_wp_attachment_image_alt', itm_filter_string_case(itm_filter_append($file_title, "", "", "alt")) );
        }
    }
 }
 if(!function_exists('itm_filter_after_upload')){
     function itm_filter_after_upload( $file ) {
         /**
         * This functions Run the filter on upload, it sets the Alt, Title by default and Caption and description  if set true in the settings
         */
         /* Run if uploaded file type is image */
         if ( isset( $_REQUEST['post_id'] ) ) {
             // get the ID
             $post_id  = absint( $_REQUEST['post_id'] );
             // get the post OBJECT
             $post_obj  = get_post( $post_id );
             // get the post title
             $post_title = sanitize_title($post_obj->post_title);
             if(empty($post_title)){
                 // get the post slug
                 $post_title = sanitize_title($post_obj->post_name);
             }
             $file['name'] = itm_filter_standardized_filename($file['name'], $post_title);
         }
         else {
             $file['name'] = itm_filter_standardized_filename($file['name']);
         }
         return $file;
     }
 }
 if(!function_exists('itm_filter_buffer_start')){
    function itm_filter_buffer_start() {
        ob_start("itm_filter_run");
    }
 }
 if(!function_exists('itm_filter_buffer_end')){
    function itm_filter_buffer_end() {
        ob_end_flush();
    }
 }
