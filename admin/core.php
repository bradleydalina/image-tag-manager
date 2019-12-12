<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
* Plugin Main Class
*/
class ITMPlugin{
    /**
    * Declare Private Variables For This Plugin Use Only
    * Settings
    */
    public function __construct(){
        /**
        * Activation, Deactivation And Uninstall Hooks
        */
        $this->itm_initialized();
    }
    public function itm_initialized(){
        /**
        * Plugin Menu & Scripts and Css Styles Registration
        */
        add_action( "admin_menu", array($this,"itm_register_menu") );
        add_action( 'admin_enqueue_scripts', array($this,"itm_scripts") );
        add_action( 'admin_head', array( __CLASS__,'itm_filter_screen_tab'));
        /**
        * Call only once on every activation of the plugin only
        */
        register_activation_hook(  plugin_basename( ITM_RELPATH . ITM_PLUGIN .'.php' ) , 'itm_filter_activation' );
		register_uninstall_hook(  plugin_basename( ITM_RELPATH . ITM_PLUGIN .'.php' ) , 'itm_filter_uninstallation' );
    }
    public static function itm_filter_screen_tab() {
        $screen = get_current_screen();
        if ( 'media_page_image-tag-manager' != $screen->id )
            return;

        $help_args = [
                        'id'      => 'itm-plugin-issues',
                        'title'   => __('Plugin Issues'),
                        'content' =>
                                '<h3>'. __( 'Plugin Issues' ) . '</h3>' .
                                '<p>' . __( 'If by any chance you encountered plugin issues, please submit a brief report and provide a screenshot if possible so that I may be able to include them in the next plugin update, thank you.') . '</p>'
                     ];
        $user_support_args = array(
                        'id'      => 'itm-plugin-user-support',
                        'title'   => __('User Support'),
                        'content' =>
                                '<h3>' . __('User Support') . '</h3>' .
                                '<p>'  . __('For as long as there are users who found this plugin helpful, by doing there part thru feedback and reviews the development support will continue.') . '</p>'
                        );
        $development_support_args = array(
                        'id'      => 'itm-plugin-development-support',
                        'title'   => __('Development Support'),
                        'content' =>
                                '<h3>' . __('Development Support'). '</h3>' .
                                '<p>'  . __('Your positive reviews and ratings can be very helpful to me, it would also be nice if you can <a rel="referrer" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=QX8K5XTVBGV42&amp;source=url">donate</a> any amount for funding.') . '</p>'
                        );


        $screen->add_help_tab( $help_args );
        $screen->add_help_tab( $user_support_args );
        $screen->add_help_tab( $development_support_args );
    	$screen->set_help_sidebar(
    		'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
    		'<p>' . __( '<a target="_blank" href="http://wordpress.org/plugins/image-tag-manager/">Documentation Page</a>' ) . '</p>' .
    		'<p>' . __( '<a href="mailto:bradleydalina@gmail.com">bradleydalina@gmail.com</a>' ) . '</p>'
    	);
        //print_r($screen->_help_sidebar);
    }
    public static function itm_authorize(){
        /**
        * Check User Capability
        */
        if ( ! is_user_logged_in() ) {
            add_action( 'admin_menu', array($this,'itm_remove_menu') );
            wp_die( ( 'You do not have sufficient permissions to access this page.' ) );
        }
        if ( !current_user_can( 'manage_options' ) ) {
            add_action( 'admin_menu', array($this,'itm_remove_menu') );
            wp_die( ( 'You do not have sufficient permissions to access this page.' ) );
        }
        if ( ! is_admin() ) {
            add_action( 'admin_menu', array($this,'itm_remove_menu') );
            wp_die( ( 'You do not have sufficient permissions to access this page. Please contact your administrator.' ) );
        }
    }
    public function itm_register_menu() {
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
            array($this,"itm_display")
        );
    }
    public function itm_remove_menu() {
        /**
        * The Plugin Unregister Menu
        */
        remove_submenu_page( "upload.php", ITM_PLUGIN );
    }
    public function itm_display() {
        self::itm_authorize();
        $output = '<div class="wrap">';
        $output .= '<div id="icon-users" class="icon32"><br/></div>';
        $output .= '<h2 class="itm-plugin-name"><a rel="noreferrer" target="_blank" href="'.ITM_URI.'"><span class="itm-orange">Image</span>  Tag Manager</a> <small>Version ( '.ITM_VERSION.' ) </small></h2>';
        $output .= '<p class="itm-plugin-description">'.ITM_DESCRIPTION.'</p>';
        $output .= '<nav class="itm-flex">';
        $output .= '<span class="itm-flex-left"><h3>'.(!isset($_GET['view']) ? 'Plugin Settings' : ucwords(str_replace('-', ' ', $_GET['view']))).'</h3></span>';
        $output .= '<span class="itm-flex-right">';
        $output .= '<a href="?page='.ITM_PLUGIN.'&view=plugin-settings" class="itm-nav-link '.(!isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='plugin-settings') ? 'active' : 'inactive').'">Plugin Settings</a>';
        $output .= '<a href="?page='.ITM_PLUGIN.'&view=how-it-works" class="itm-nav-link '.((isset($_GET['view']) && $_GET['view']=='how-it-works') ? 'active' : 'inactive').'">How it works</a>';
        $output .= '<a href="?page='.ITM_PLUGIN.'&view=support" class="itm-nav-link '.((isset($_GET['view']) && $_GET['view']=='support') ? 'active' : 'inactive').'">Support</a>';
        $output .= '</span>';
        $output .= '</nav>';
                    ob_start();
                    self::itm_view();
        $output .=  ob_get_clean();
        $output .='</div>';
        echo $output;
    }
    public static function itm_view(){
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
    public function itm_scripts($hook_suffix) {
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
}
$ITMPlugin  = new ITMPlugin();
