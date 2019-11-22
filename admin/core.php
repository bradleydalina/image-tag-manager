<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
if ( !class_exists( 'ITMPlugin' ) ) {
    /**
    * Plugin Main Class
    */
    class ITMPlugin{
        /**
        * Declare Private Variables For This Plugin Use Only
        * Settings
        */
        private $data_saving,$override_alt, $override_title;
        /**
        * Basic Plugin Options Variables
        */
        private $image_caption,$image_description;
        /**
        * Naming Plugin Options Variables
        */
        private $strip_numbers,$use_post_title_as_default, $add_post_title_to_alt, $add_post_title_to_title, $string_trimmer, $remove_from_alt, $remove_from_title;
        /**
        * Extra Plugin Options Variables
        */
        private $add_class,$default_class,$remove_srcset_sizes;
        private $deprecated,$autoload;

        public function __construct(){
            /**
            * Activation, Deactivation And Uninstall Hooks
            */
            $this->Initilized();
            $this->Uninstall();
        }
        public function Initilized(){
            /**
            * Initilized Generic Plugin Variables With Default Values
            */
            $this->deprecated = false;
            $this->autoload = null;

            $this->data_saving=get_option("data_saving");
            $this->override_alt=get_option("override_alt");
            $this->override_title=get_option("override_title");
            $this->add_post_title_to_alt=get_option("add_post_title_to_alt");
            $this->add_post_title_to_title=get_option("add_post_title_to_title");

            $this->string_trimmer=get_option("string_trimmer");
            $this->remove_from_alt=get_option("remove_from_alt");
            $this->remove_from_title=get_option("remove_from_title");

            /**
            * Get Plugin Option Values From Database
            */
            $this->image_caption= get_option('image_caption');
            $this->image_description= get_option('image_description');

            $this->strip_numbers= get_option('strip_numbers');
            $this->use_post_title_as_default= get_option('use_post_title_as_default');

            // $this->add_post_title= get_option('add_post_title');
            // $this->add_blog_name= get_option('add_blog_name');

            $this->add_class= get_option('add_class');
            $this->default_class= get_option('default_class');
            $this->remove_srcset_sizes= get_option('remove_srcset_sizes');

            /**
            * Plugin Menu & Scripts and Css Styles Registration
            */
            add_action( "admin_menu", array($this,"RegisterMenu") );
            add_action( 'admin_enqueue_scripts', array($this,"Scripts") );
            add_action( 'wp_enqueue_scripts', array($this,"FrontScripts") );
            /* Triggers before the actual saving of content post */
            add_filter( 'content_save_pre', array($this,'Filter'), 100, 1);

            /* Trigger once you upload an image */
             add_action( 'add_attachment', array($this, 'Upload'), 100 );
             add_filter( 'wp_handle_upload_prefilter', array($this, 'BeforeUpload') , 20 );
            /**
            * Run Output Filter to Add Titles and Alt Tags Attributes to the Images Element
            */
            add_filter('the_content', array($this,'Render'), 100);
            /**
            * Call only once on every activation of the plugin only
            */
            register_activation_hook( __FILE__, array( $this , 'Activate' ) );
        }
        public function Uninstall() {
            /**
            * The Plugin Uninstall Hook
            * Delete Plugin Options in the Database
            */
            /**
            * Call only once on uninstall of the plugin only
            */
            register_uninstall_hook(  __FILE__, array( $this , 'Erase' ) );
        }
        public static function Authorize(){
            /**
            * Check User Capability
            */
            if ( ! is_user_logged_in() ) {
                add_action( 'admin_menu', array($this,'RemoveMenu') );
                wp_die( ( 'You do not have sufficient permissions to access this page.' ) );
            }
            if ( !current_user_can( 'manage_options' ) ) {
                add_action( 'admin_menu', array($this,'RemoveMenu') );
                wp_die( ( 'You do not have sufficient permissions to access this page.' ) );
            }
            if ( ! is_admin() ) {
                add_action( 'admin_menu', array($this,'RemoveMenu') );
                wp_die( ( 'You do not have sufficient permissions to access this page. Please contact your administrator.' ) );
            }
        }
        public static function Activate() {
            /**
            * The Plugin Activation Hook
            * Initialized Default Values in the First Activation
            */
            /*
            *   On plugin activation, set this options default values as default settings.
            */
            if ( get_option( 'data_saving' ) === false ){ add_option( 'data_saving', 0 , $this->deprecated, $this->autoload );}
            if ( get_option( 'override_alt' ) === false ){ add_option( 'override_alt', 0, $this->deprecated, $this->autoload );}
            if ( get_option( 'override_title' ) === false ){ add_option( 'override_title', 0, $this->deprecated, $this->autoload );}
            if ( get_option( 'add_post_title_to_alt' ) === false ){ add_option( 'add_post_title_to_alt', 0 , $this->deprecated, $this->autoload );}
            if ( get_option( 'add_post_title_to_title' ) === false ){ add_option( 'add_post_title_to_title', 0 , $this->deprecated, $this->autoload );}

            if ( get_option( 'string_trimmer' ) === false ){ add_option( 'string_trimmer', 0, $this->deprecated, $this->autoload );}
            if ( get_option( 'remove_from_alt' ) === false ){ add_option( 'remove_from_alt', '' , $this->deprecated, $this->autoload );}
            if ( get_option( 'remove_from_title' ) === false ){ add_option( 'remove_from_title', '' , $this->deprecated, $this->autoload );}

            if ( get_option( 'image_caption' ) === false ){ add_option( 'image_caption', 0 , $this->deprecated, $this->autoload );}
            if ( get_option( 'image_description' ) === false ){ add_option( 'image_description', 0 , $this->deprecated, $this->autoload );}
            /*
            *   Naming Settings
            */
            if ( get_option( 'strip_numbers' ) === false ) { add_option( 'strip_numbers', 0 , $this->deprecated, $this->autoload );}
            if ( get_option( 'use_post_title_as_default' ) === false ) { add_option( 'use_post_title_as_default', 1 , $this->deprecated, $this->autoload );}
            // if ( get_option( 'add_post_title' ) === false ) { add_option( 'add_post_title', 0 , $this->deprecated, $this->autoload );}
            // if ( get_option( 'add_blog_name' ) === false ) {	add_option( 'add_blog_name', 0 , $this->deprecated, $this->autoload );}
            /*
            *   Extra Settings
            */
            if ( get_option( 'add_class' ) === false ) {	add_option( 'add_class', 0 , $this->deprecated, $this->autoload );}
            if ( get_option( 'default_class' ) === false ) {	add_option( 'default_class', '' , $this->deprecated, $this->autoload );}
            if ( get_option( 'remove_srcset_sizes' ) === false ) {	add_option( 'remove_srcset_sizes', 0 , $this->deprecated, $this->autoload );}
        }
        public static function Erase(){
            /*
            *   On plugin uninstall, delete this options in the database.
            */
            if ( !defined('WP_UNINSTALL_PLUGIN') ) die;
            /**
            * Delete database entries
            *
            * @since		1.0
            */

            delete_option( 'data_saving' );
            delete_option( 'override_alt' );
            delete_option( 'override_title' );
            delete_option( 'add_post_title_to_alt' );
            delete_option( 'add_post_title_to_title' );

            delete_option( 'string_trimmer' );
            delete_option( 'remove_from_alt' );
            delete_option( 'remove_from_title' );

            delete_option( 'image_caption' );
            delete_option( 'image_description' );

            delete_option( 'strip_numbers' );
            delete_option( 'use_post_title_as_default' );
            // delete_option( 'add_blog_name' );
            // delete_option( 'add_post_title' );

            delete_option( 'add_class' );
            delete_option( 'default_class' );
            delete_option( 'remove_srcset_sizes' );
        }
        public function RegisterMenu() {
            /**
            * The Plugin Register Menu under Media Files
            */
            //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
            add_submenu_page(
                "upload.php",
                __("Image Tag Manager", ITM_PLUGIN),
                __("Image Tag Manager", ITM_PLUGIN),
                "manage_options",
                ITM_PLUGIN,
                array($this,"Display")
            );
        }
        public function RemoveMenu() {
            /**
            * The Plugin Unregister Menu
            */
            remove_submenu_page( "upload.php", ITM_PLUGIN );
        }
        public function Display() {
            self::Authorize();
            $output = '<div class="wrap">';
            $output .= '<div id="icon-users" class="icon32"><br/></div>';
            $output .= '<h2><a rel="noreferrer" target="_blank" href="'.ITM_URI.'"><span class="red">Image</span>  Tag Manager</a> <small>Version ( '.ITM_VERSION.' ) </small></h2>';
            $output .= '<p>'.ITM_DESCRIPTION.'</p>';
            $output .= '<hr />';
                        ob_start();
                        self::View();
            $output .=  ob_get_clean();
            $output .='</div>';
            echo $output;
        }
        public static function View(){
            if(isset($_GET['view'])){
                switch($_GET['view']){
                    case "how-it-works":
                        require_once ITM_RELPATH . 'admin/inc/how-it-works.php';
                    break;
                    case "support":
                        require_once ITM_RELPATH . 'admin/inc/support.php';
                    break;
                    default:
                        require_once ITM_RELPATH . 'admin/inc/settings.php';
                    break;
                }
            }
            else{
                require_once ITM_RELPATH . 'admin/inc/settings.php';
            }
        }
        public function Scripts($hook_suffix) {
            /**
            * Plugin Backend Scripts and Styles Inclusion
            */
            global $pagenow;
            /**
            * Donot Load Anywhere if Not in this Page, To Avoid Heavy Loads
            */
            if ($pagenow === 'upload.php' && ($hook_suffix ===ITM_PLUGIN || $hook_suffix ==='media_page_'.ITM_PLUGIN)) {
                wp_enqueue_style('itm-plugin', ITM_ABSPATH.'admin/css/itm-plugin.css');
                wp_enqueue_script('terebra-achates', ITM_ABSPATH.'admin/js/terebra-achates.js', null, 1.0, true);
                wp_enqueue_script('itm-admin', ITM_ABSPATH.'admin/js/itm-admin.js', array('terebra-achates'), 1.0, true);
            }
        }
        public function FrontScripts($hook_suffix) {
            /**
            * Plugin FrontEnd Scripts and Styles Inclusion
            */
            wp_enqueue_script('terebra_achates', ITM_ABSPATH.'admin/js/terebra-achates.js', null, 1.0, true);
            $ITMSettings = array(
                "data_saving"=>$this->data_saving,
                "override_alt"=>$this->override_alt,
                "override_title"=>$this->override_title,
                "image_caption"=>$this->image_caption,
                "image_description"=>$this->image_description,
                "strip_numbers"=>$this->strip_numbers,
                "use_post_title_as_default"=>$this->use_post_title_as_default,
                "add_post_title_to_alt"=>$this->add_post_title_to_alt,
                "add_post_title_to_title"=>$this->add_post_title_to_title,
                "add_class"=>$this->add_class,
                "default_class"=>$this->default_class,
                "remove_srcset_sizes"=>$this->remove_srcset_sizes,
                "string_trimmer"=>$this->string_trimmer,
                "remove_from_alt"=>$this->remove_from_alt,
                "remove_from_title"=>$this->remove_from_title,
                'blog_name'=>get_bloginfo('name'),
                'post_title'=>get_the_title()
            );
            $localize = array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                "nonce"=>wp_create_nonce("nonce"),
                "siteurl"=>get_site_url(),
                "options"=>$ITMSettings
            );
            /**
            * Localize this js for the purpose that the plugin settings can be access locally by the js and can read the json data
            * But this does not requires ajax request
            */
            wp_enqueue_script('ITM_plugin', ITM_ABSPATH.'admin/js/itm-plugin.js', array('terebra_achates', 'wp-util', 'json2'), 1.0, true);
            wp_localize_script( 'ITM_plugin', 'ITMplugin', $localize );
        }
        public function Title( $image_title, $post_title = '' ) {
            /**
            * This functions Transform the title into a valid and more decent Title
            * It remove unwanted characters
            */
            $image_title = $this->Sanitizer( $image_title);
            //Falback
            $post_title = $this->Sanitizer( $post_title );
            //Falback
            $blog_title = $this->Sanitizer( get_bloginfo('name') );
            /**
            * This functions Check the validity fo the filename to be used as Title and Alt Tags
            * 3 or more letters is valid as title
            */

            /* Count the letters of the title if still valid to set as title*/
            $count = preg_match_all('/[a-zA-Z]/smiU', $image_title, $result_match);
            if($count < 3) {
                if(boolval($this->use_post_title_as_default)) {
                    if(empty(trim($post_title))) {
                        $image_title = $blog_title;
                    }else{
                        $image_title = $post_title;
                    }
                }
            }
            /* Convert to lower case then Capitalize first letter of every word */
            return ucwords( strtolower( trim($image_title) ) );
        }
        public function Sanitizer($string) {
            /**
            * This functions Transform the title into a valid and more decent Title
            * It remove unwanted characters
            */
            $string = esc_attr($string);
            if(boolval($this->strip_numbers)) {
                /* Remove/Strip first dimensional resolution if present in the filename like "Bradley Dalina 1024x768.jpg" */
                $string = preg_replace( '%\s{0,}\d{1,}?\s{0,}x?\s{0,}\d{1,}?\s{0,}?%smiU', ' ',  $string );
                $string = preg_replace('/[0-9]/smiU', '', $string);
            }
            /* Remove any non-word chacacter accepts [a-zA-Z0-9]*/
            $string = preg_replace( '%[^\w]%', ' ', $string );//,!?
            /* Remove multiple underscore & hypens */
            $string = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $string );
            /* Remove multiple spaces & tabs */
            $string = preg_replace( '%\s\s+%', ' ', $string );
            /* Trim spaces in the start and end of string */
            return trim( $string );
        }
        public function Filter($content) {
            /**
            * This functions Run the filter in every img occurence
            */
            if(boolval($this->data_saving)) {
                $content = preg_replace_callback("/<img[^>]+>/smiU", array( $this, 'Replace'), $content, -1, $count);
            }
            return $content;
        }
        public function Append($image_title,$post_title, $attribute="alt"){
            /* Run if plugin option for to add blog post title is set to true */
            if($attribute =="alt"){
                // Run for alt settings
                if(boolval($this->add_post_title_to_alt)) {
                    /* Check if Post title is already present in the title */
                    if(stripos($image_title, $post_title) === false) {
                        $image_title .= (!empty(trim($post_title))) ? ' - '.$post_title : '';
                    }
                    else {
                        $image_title = strireplace($post_title, $post_title, $image_title);
                    }
                }
                // check trimmer
                if(boolval($this->string_trimmer)) {
                    $trim_from_alt = explode(",", $this->remove_from_alt);
                    if(count($trim_from_alt) > 0) {
                        for($i=0; $i < count($trim_from_alt); $i++){
                            $image_title=preg_replace("%(?<![\w\d])".trim($trim_from_alt[$i])."(?![\w\d])%i", "", $image_title);
                        }
                        $image_title = trim(preg_replace( '%\s\s+%', ' ', $image_title ));
                    }
                }

            }else{
                // Run for title settings
                if(boolval($this->add_post_title_to_title)) {
                    /* Check if Post title is already present in the title */
                    if(stripos($image_title, $post_title) === false) {
                        $image_title .= (!empty(trim($post_title))) ? ' - '.$post_title : '';
                    }
                    else {
                        $image_title = strireplace($post_title, $post_title, $image_title);
                    }
                }
                // check trimmer
                if(boolval($this->string_trimmer)) {
                    $trim_from_title = explode(",", $this->remove_from_title);
                    if(count($trim_from_title) > 0) {
                        for($i=0; $i < count($trim_from_title); $i++){
                            $image_title=preg_replace("%(?<![\w\d])".trim($trim_from_title[$i])."(?![\w\d])%ims", "", $image_title);
                        }
                        $image_title = trim(preg_replace( '%\s\s+%', ' ', $image_title ));
                    }
                }
            }
            return $image_title;
        }
        public function Upload( $post_id ) {
            /**
            * This functions Run the filter on upload, it sets the Alt, Title by deafult and Caption and desctio  if set true in the settings
            */
            /* Run if uploaded file type is image */
            if ( wp_attachment_is_image( $post_id ) ) {
                $image_title = get_post( $post_id )->post_title;
                $post_title='';
                $post_parent = get_post( $post_id )->post_parent;

                if($post_parent) {
                    $post_title = get_post( $post_parent )->post_title;
                }
                if(empty(trim($image_title))) {
                    $image_title = $this->Title(pathinfo(get_permalink($post_ID))['filename'], $post_title);
                }
                else {
                    $image_title = $this->Title( $image_title, $post_title);
                }
                $caption = (boolval($this->image_caption)) ? $image_title : '';
                $description = (boolval($this->image_description )) ? $image_title : '';

                $meta = /* Create an array with the image meta (Title, Caption, Description) to be updated */
                array(
                    // Specify the image (ID)
                    'ID' => $post_id,
                    // Set image Title
                    'post_title' => $this->Append($image_title, $post_title, "title"),
                    // Set image Caption
                    'post_excerpt' => $caption,
                    // Set image Description
                    'post_content' => $description
                );
                // Set the image Alt-Text
                update_post_meta( $post_id, '_wp_attachment_image_alt', $this->Append($image_title, $post_title, "alt") );
                // Set the image meta (e.g. Title, Excerpt, Content)
                wp_update_post( $meta );
            }
        }
        public function BeforeUpload( $file ) {
            /**
            * This functions Run the filter on upload, it sets the Alt, Title by default and Caption and description  if set true in the settings
            */
            /* Run if uploaded file type is image */
            if ( isset( $_REQUEST['post_id'] ) ) {
                // get the ID
                $post_id  = absint( $_REQUEST['post_id'] );
                // get the post OBJECT
                $post_obj  = get_post( $post_id );
                // get the post slug
                $post_title = sanitize_title($post_obj->post_title);

                $file['name'] = $this->StandardizedFileName($file['name'], $post_title);
            }
            else {
                $file['name'] = $this->StandardizedFileName($file['name']);
            }
            return $file;
        }
        public function StandardizedFileName($image_filename, $post_title='') {
            /*
            * This function standadized the filename of an image
            */
            $image_ext = pathinfo( $image_filename, PATHINFO_EXTENSION );
            $image_name = pathinfo( $image_filename, PATHINFO_FILENAME );

            $image_name = $this->Sanitizer( $image_name );
            $blog_title = $this->Sanitizer( get_bloginfo('name') );
            $post_title = $this->Sanitizer( $post_title );

            $uploads_dir = wp_upload_dir()['path'];

            if(boolval($this->strip_numbers)) {
                /* Count the letters of the title if still valid to set as title*/
                $count = preg_match_all('/[a-zA-Z]/smiU', $image_name, $result_match);

                if($count >= 3) {
                    /* Return if Morethan 3 letters */
                    return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
                }

                if(boolval($this->use_post_title_as_default)) {
                    if(empty(trim($post_title))) {
                        return wp_unique_filename( $uploads_dir, strtolower($blog_title.'.'.$image_ext) );
                    }
                    return wp_unique_filename( $uploads_dir, strtolower($post_title.'.'.$image_ext) );
                }
                return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
            }
            return wp_unique_filename( $uploads_dir, strtolower($image_name.'.'.$image_ext) );
        }
        public function Replace($image_row) {
            //Match with img source attribute to get the filename
            preg_match('/(?<=src=\\")[^\\"].*(?=\\")/ismU', stripslashes($image_row[0]), $image_url);
            // Extract the filename
            $image_filename = pathinfo($image_url[0]);
            // get the image id in the class
            if(preg_match('/class="([^"]*wp-image-\d*)"/ims', stripslashes($image_row[0]), $all_class)) {
                $get_id = preg_match('/wp-image-\d+/i', $all_class[0], $filtered_class);
                $image_id = trim(preg_replace('/wp-image-/i', '', $filtered_class[0]));
            }
            // else get the image id using the attachment_url_to_postid
            else{
                $image_id = attachment_url_to_postid($image_url[0]);
            }
            // get the image post parent
            $post_parent = get_post( $image_id )->post_parent;
            // get the image post parent title
            $post_title = ($post_parent) ? get_post( $post_parent )->post_title : '';

            // Sanitize and Transform into valid title format
            $image_formatted_name = $this->Title( $image_filename['filename'], $post_title );

            $new_image_alt = $this->Append($image_formatted_name, $post_title, "alt");
            $new_image_title = $this->Append($image_formatted_name, $post_title, "title");

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
                if(preg_match( '~(alt=\\\")(.*?)(\\\")~is' ,$image_row[0], $current_alt)) {
                    //Remove space for checking valid content
                    $old_alt = trim($current_alt[2]);
                    //Check if empty or not set
                    if(!empty($old_alt)){
                        //If not empty, check if we override is on
                        if(boolval($this->override_alt)){
                            //We are allowed to overide it
                            $new_attributes = sprintf( 'alt=\"%s\"', $new_image_alt);
                            $new_content = str_replace( $current_alt[0], $new_attributes , $new_content);
                        }
                        else{
                            //We are not allowed to overide it, lets just capitalized its word
                            $new_attributes = sprintf( 'alt=\"%s\"', $new_image_alt);
                            $new_content = str_replace( $current_alt[0], ucwords($current_alt[0]), $new_content);
                        }
                    }
                    else{
                        //Add since its empty
                        $new_attributes = sprintf( 'alt=\"%s\"', $new_image_alt);
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
                if(preg_match('~(title=\\\")(.*?)(\\\")~is',$image_row[0], $current_title)) {
                    //Remove space for checking valid content
                    $old_title = trim($current_title[2]);
                    if(!empty($old_title)){
                        //If not empty, check if we override is on
                        if(boolval($this->override_title)){
                            //We are allowed to overide it
                            $new_attributes = sprintf( 'title=\"%s\"', $new_image_title);
                            $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                        }
                        else{
                            //We are not allowed to overide it, lets just capitalized its word
                            $new_attributes = sprintf( 'title=\"%s\"', $new_image_title);
                            $new_content = str_replace( $current_title[0], ucwords($current_title[0]), $new_content);
                        }
                    }
                    else{
                        //Add since its empty
                        $new_attributes = sprintf( 'title=\"%s\"', $new_image_title);
                        $new_content = str_replace( $current_title[0], $new_attributes , $new_content);
                    }
                }
            }
            //return new content with appended and updated tags
            return $new_content;
        }
        public function Render($content) {
            /**
            * This functions Run the filter to update the image meta tag attributes the Output runtime
            * Onload of the page or post
            * No touching in the database
            */
            global $post;
            $new_image_alt ='';   // Declare new alt variable
            $new_image_title =''; // Declare new title variable
            $post_title = $post->post_title;  //Get Post title

            // Count Image attachments
            $count = preg_match_all('/<img[^>]+>/smi', $content, $all_images);
            // Proceed is there is any
            if($count>0) {
                // Loop each image result
                foreach($all_images[0] as $single_image) {
                    $output = preg_match_all( '/src="([^"]*)"/mi', $single_image, $image_src);

                    for($i = 0; $i < count($image_src[1]); $i++) {
                        $image_filename = pathinfo($image_src[1][$i]);
                        $image_formatted_name = $this->Title($image_filename['filename'], $post_title);
                        /**
                        * Adds alt and title in the output rending content
                        */
                        $new_image_alt = $this->Append($image_formatted_name,$post_title, "alt");
                        $new_image_title = $this->Append($image_formatted_name,$post_title, "title");

                        //Check the presence of the alt
                        $with_alt = preg_match_all('/alt="([^"]*)"/i', $single_image, $old_alt);

                        if($with_alt == 0) {
                            //No current alt
                            $image_alt_attribute = sprintf( ' alt="%s"', $new_image_alt);
                            $alt_was_added = str_replace('<img', "<img{$image_alt_attribute}" , $single_image);
                            $content = str_replace($single_image, $alt_was_added, $content);
                        }
                        else{
                            //There is a current alt
                            if(boolval($this->override_alt) && ucwords(strtolower( trim($old_alt[1][0]))) != ucwords( strtolower( trim($new_image_alt)))){
                                //We are allowed to override and the alt is not equal to plugin recommended alt
                                $image_alt_attribute = sprintf( 'alt="%s"', $new_image_alt);
                                $alt_was_added = str_replace($old_alt[0][0], $image_alt_attribute, $single_image);
                                $content = str_replace($single_image, $alt_was_added, $content);
                            }
                            else{
                                //We are not allowed to override so lets capitalized the alt atleast
                                $image_alt_attribute = sprintf( 'alt="%s"', ucwords($old_alt[1][0]) );
                                $alt_was_added = str_replace($old_alt[0][0], $image_alt_attribute, $single_image);
                                $content = str_replace($single_image, $alt_was_added, $content);
                            }
                        }

                        /**
                        * Check if above was executed and the content has been modified
                        */
                        $single_image = (!isset($alt_was_added)) ? $single_image : $alt_was_added;
                        $with_title = preg_match_all('/title="([^"]*)"/i', $single_image, $old_title);

                        if($with_title == 0) {
                            // No current title so lets create title tag and insert it
                            $image_title_attribute = sprintf( ' title="%s"', $new_image_title);
                            $title_was_added = str_replace('<img',"<img{$image_title_attribute}", $single_image);
                            $content = str_replace($single_image, $title_was_added, $content);
                        }
                        else{
                            //There is a current title
                            if(boolval($this->override_title) && ucwords(strtolower( trim($old_title[1][0]))) != ucwords( strtolower( trim($new_image_title))) ){
                                //We are allowed to override and the title is not equal to plugin recommended title
                                //$image_title_attribute = sprintf( 'title="%s"', "".strtolower(($old_title[1][0])) ."!=". strtolower($new_image_title)."" );
                                $image_title_attribute = sprintf( 'title="%s"', $new_image_title);
                                $title_was_added = str_replace($old_title[0][0], $image_title_attribute, $single_image);
                                $content = str_replace($single_image, $title_was_added, $content);
                            }
                            else{
                                //We are not allowed to override so lets capitalized the title atleast
                                $image_title_attribute = sprintf( 'title="%s"', ucwords($old_title[1][0]));
                                $title_was_added = str_replace($old_title[0][0], $image_title_attribute, $single_image);
                                $content = str_replace($single_image, $title_was_added, $content);
                            }
                        }
                        $single_image = (!isset($title_was_added)) ? $single_image : $title_was_added;
                    }

                    if(boolval($this->add_class)) {
                        /**
                        * Check if above was executed and the content has been modified
                        */
                        $with_class = preg_match_all('/class="([^"]*)"/imsU', $single_image, $old_class);
                        if($with_class == 0) {
                             // create the class tag and insert the value
                             $image_class_attribute = sprintf( ' class="%s"', $this->default_class);
                             $class_was_added = str_replace('<img',"<img{$image_class_attribute}", $single_image);
                             $content = str_replace($single_image, $class_was_added, $content);
                        }
                        else {
                              $image_class_attribute = sprintf( 'class="%s ', $this->default_class);
                              $class_was_added = str_replace('class="', $image_class_attribute, $single_image);
                              $content = str_replace($single_image, $class_was_added, $content);
                        }
                        $single_image = (!isset($class_was_added)) ? $single_image : $class_was_added;
                    }

                    /**
                    * If Remove Srcset and sizes is active
                    * Git rid of this attributes
                    */
                    if(boolval($this->remove_srcset_sizes)) {
                        /**
                        * Check if above was executed and the content has been modified
                        */
                        /**
                        * Remove srcset attribute
                        */
                        $with_srcset = preg_match_all('/srcset="([^"]*)"/ismU', $single_image, $old_srcset);
                        if($with_srcset != 0) {
                            $srcset_was_removed = str_replace($old_srcset[0][0], '', $single_image);
                            $content = str_replace($single_image, $srcset_was_removed, $content);
                        }
                        /**
                        * Check if srcset has been removed
                        */
                        $single_image = (!isset($srcset_was_removed)) ? $single_image : $srcset_was_removed;
                        /**
                        * Remove sizes attribute
                        */
                        $with_sizes = preg_match_all('/sizes="([^"]*)"/ismU', $single_image, $old_sizes);
                        if($with_sizes != 0) {
                            $sizes_was_removed = str_replace($old_sizes[0][0], '', $single_image);
                            $content = str_replace($single_image, $sizes_was_removed, $content);
                        }
                    }
                }
            }
            return $content;
        }
    }
}
$ITMPlugin  = new ITMPlugin();
