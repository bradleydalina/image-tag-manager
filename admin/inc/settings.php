<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
* Main Class
*/
class ITMPluginOptions {
    public function __construct() {
            /**
            * Show the form
            */
            self::itm_render_form();
    }
    public static function itm_handle_form() {
        /**
        * Verify user permission and access level
        */
        ITMPlugin::itm_authorize();
        /**
        * Verify nonce submitted within the form
        */
        if(! isset( $_POST['itm_plugin_action'] ) || ! wp_verify_nonce( $_POST['itm_plugin_action'], 'itm_plugin_nonce' )) {
            ?>
            <span class="error notice is-dismissible">
                 <p>Sorry, your nonce was incorrect. Please try again.</p>
            </span>
            <?php
        }
        else {
            /**
            * Validate Post values
            */
            $image_caption =  (isset($_POST['itm_image_caption']) ? intval($_POST['itm_image_caption']) : 0);
            $image_description =  (isset($_POST['itm_image_description']) ? intval($_POST['itm_image_description']) : 0);

            $preserved_char =  (isset($_POST['itm_preserved_char']) ? intval($_POST['itm_preserved_char']) : 0);
            $strip_numbers =  (isset($_POST['itm_strip_numbers']) ? intval($_POST['itm_strip_numbers']) : 0);
            $use_post_title_as_default =  (isset($_POST['itm_use_post_title_as_default']) ? intval($_POST['itm_use_post_title_as_default']) : 0);
            $string_case =  (isset($_POST['itm_string_case']) ? intval($_POST['itm_string_case']) : 0);

            $override_alt= (isset($_POST['itm_override_alt']) ? intval($_POST['itm_override_alt']) : 0);
            $override_title= (isset($_POST['itm_override_title']) ? intval($_POST['itm_override_title']) : 0);

            $bar_separator =  (isset($_POST['itm_bar_separator']) ? intval($_POST['itm_bar_separator']) : 0);
            $add_post_title_to_alt =  (isset($_POST['itm_add_post_title_to_alt']) ? intval($_POST['itm_add_post_title_to_alt']) : 0);
            $add_post_title_to_title =  (isset($_POST['itm_add_post_title_to_title']) ? intval($_POST['itm_add_post_title_to_title']) : 0);
            $add_post_category_to_alt =  (isset($_POST['itm_add_post_category_to_alt']) ? intval($_POST['itm_add_post_category_to_alt']) : 0);
            $add_post_category_to_title =  (isset($_POST['itm_add_post_category_to_title']) ? intval($_POST['itm_add_post_category_to_title']) : 0);

            $string_trimmer =  (isset($_POST['itm_string_trimmer']) ? intval($_POST['itm_string_trimmer']): 0);
            $remove_from_alt = (isset($_POST['itm_remove_from_alt']) ? sanitize_text_field($_POST['itm_remove_from_alt']) : '');
            $remove_from_title = (isset($_POST['itm_remove_from_title']) ? sanitize_text_field($_POST['itm_remove_from_title']) : '');

            $add_class =  (isset($_POST['itm_add_class']) ? intval($_POST['itm_add_class']) : 0 );
            $scope_class =  (isset($_POST['itm_scope_class']) ? intval($_POST['itm_scope_class']) : 0 );
            $default_class = (isset($_POST['itm_default_class']) ? sanitize_text_field($_POST['itm_default_class']) : '');
            $remove_srcset_sizes =  (isset($_POST['itm_remove_srcset_sizes']) ? intval($_POST['itm_remove_srcset_sizes']) : 0 );

            $data_saving= (isset($_POST['itm_data_saving']) ? intval($_POST['itm_data_saving']) : 0 );

            /**
            * Update Plugin Options
            */
            if ( is_multisite() ) {
                update_network_option( null, 'itm_image_caption', $image_caption );
                update_network_option( null, 'itm_image_description', $image_description );

                update_network_option( null, 'itm_preserved_char', $preserved_char);
                update_network_option( null, 'itm_strip_numbers', $strip_numbers );
                update_network_option( null, 'itm_use_post_title_as_default', $use_post_title_as_default );
                update_network_option( null, 'itm_string_case', $string_case );

                update_network_option( null, 'itm_override_alt', $override_alt );
                update_network_option( null, 'itm_override_title', $override_title );

                update_network_option( null, 'itm_bar_separator', $bar_separator);
                update_network_option( null, 'itm_add_post_title_to_alt', $add_post_title_to_alt );
                update_network_option( null, 'itm_add_post_title_to_title', $add_post_title_to_title );
                update_network_option( null, 'itm_add_post_category_to_alt', $add_post_category_to_alt );
                update_network_option( null, 'itm_add_post_category_to_title', $add_post_category_to_title );

                update_network_option( null, 'itm_string_trimmer', $string_trimmer );
                update_network_option( null, 'itm_remove_from_alt', $remove_from_alt );
                update_network_option( null, 'itm_remove_from_title', $remove_from_title );

                update_network_option( null, 'itm_add_class', $add_class );
                update_network_option( null, 'itm_scope_class', $scope_class );
                update_network_option( null, 'itm_default_class', $default_class );
                update_network_option( null, 'itm_remove_srcset_sizes', $remove_srcset_sizes );

                update_network_option( null, 'itm_data_saving', $data_saving );
            }

            update_option( 'itm_image_caption', $image_caption );
            update_option( 'itm_image_description', $image_description );

            update_option( 'itm_preserved_char', $preserved_char);
            update_option( 'itm_strip_numbers', $strip_numbers );
            update_option( 'itm_use_post_title_as_default', $use_post_title_as_default );
            update_option( 'itm_string_case', $string_case );

            update_option( 'itm_override_alt', $override_alt );
            update_option( 'itm_override_title', $override_title );

            update_option( 'itm_bar_separator', $bar_separator);
            update_option( 'itm_add_post_title_to_alt', $add_post_title_to_alt );
            update_option( 'itm_add_post_title_to_title', $add_post_title_to_title );
            update_option( 'itm_add_post_category_to_alt', $add_post_category_to_alt );
            update_option( 'itm_add_post_category_to_title', $add_post_category_to_title );

            update_option( 'itm_string_trimmer', $string_trimmer );
            update_option( 'itm_remove_from_alt', $remove_from_alt );
            update_option( 'itm_remove_from_title', $remove_from_title );

            update_option( 'itm_add_class', $add_class );
            update_option( 'itm_scope_class', $scope_class );
            update_option( 'itm_default_class', $default_class );
            update_option( 'itm_remove_srcset_sizes', $remove_srcset_sizes );

            update_option( 'itm_data_saving', $data_saving );
            ?>
            <span class="success notice is-dismissible">
                    <p>Your plugin settings were saved!</p>
            </span>
            <?php
        }
    }
    public static function itm_render_form() {
        ?>
        <div class="itm-flex" id="itm-settings">
            <div class="itm-flex-left itm-settings-nav">
                <a target="#basic-block" id="basic-settings" class="itm-settings-tab inactive">Basic Settings</a>
                <a target="#alt-title-block" id="alt-title-settings" class="itm-settings-tab active">Alt/Title Settings</a>
                <a target="#word-block" id="word-settings" class="itm-settings-tab inactive">Word Settings</a>
                <a target="#extra-block" id="extra-settings" class="itm-settings-tab inactive">Extra Settings</a>
                <a target="#advance-block" id="advance-settings" class="itm-settings-tab inactive">Advance Settings</a>
                <form class="itm-donation-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick" />
                    <input type="hidden" name="hosted_button_id" value="QX8K5XTVBGV42" />
                    <input class="itm-donate-button itm-fullwidth" type="image" src="<?php echo ITM_ABSPATH;?>admin/img/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                    <img alt="" border="0" src="https://www.paypal.com/en_PH/i/scr/pixel.gif" width="1" height="1" />
                </form>
            </div>
            <form class="itm-flex-right itm-settings-content" method="POST">
                <?php wp_nonce_field( 'itm_plugin_nonce', 'itm_plugin_action' ); ?>
                <?php
                    /**
                    * Check for post action
                    */
                    if ( ! empty( $_POST ) && isset( $_POST['itm_plugin_action'] ) ) {
                        self::itm_handle_form();
                    }
                ?>
                <input type="hidden" name="itm_plugin_nonce" value=1 />
                <!--Start Basic Settings-->
                    <div id="basic-block" class="itm-settings-block hide">
                        <span class="itm-settings-label">On upload image file</span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_image_alt">Set Image Alt <small>( Default )</small></label>
                                <input onClick="return false;" disabled name="itm_image_alt" id="itm_image_alt" type="checkbox" value=1 class="" checked/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm-image_title">Set Image Title <small>( Default )</small></label>
                                <input onClick="return false;" disabled only name="itm-image_title" id="itm-image_title" type="checkbox" value=1 class="" checked/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_image_caption">Set Image Caption <small>( Optional )</small></label>
                                <input name="itm_image_caption" id="itm_image_caption" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_image_caption')) ? 'checked' : ''): (intval(get_option('itm_image_caption')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_image_description">Set Image Description <small>( Optional )</small></label>
                                <input name="itm_image_description" id="itm_image_description" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_image_description')) ? 'checked' : ''): (intval(get_option('itm_image_description')) ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                    </div>
                <!--End Basic Settings-->
                <!--Start Alt/Title Settings-->
                    <div id="alt-title-block" class="itm-settings-block show">
                        <span class="itm-settings-label">Override Settings</span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_override_alt">Override Alt<small> ( Overrides the current/existing alt attributes of the image )</small></label>
                                <input name="itm_override_alt" id="itm_override_alt" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_override_alt')) ? 'checked' : ''): (intval(get_option('itm_override_alt')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_override_title">Override Title<small> ( Overrides the current/existing title attributes of the image )</small></label>
                                <input name="itm_override_title" id="itm_override_title" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_override_title')) ? 'checked' : ''): (intval(get_option('itm_override_title')) ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                        <span class="itm-settings-label"> Additional String in Attributes, Applicable inside the entry post content or page articles only </span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_bar_separator">Use bar ( | ) instead of hypen ( - )<small></small></label>
                                <input name="itm_bar_separator" id="itm_bar_separator" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_bar_separator')) ? 'checked' : ''): (intval(get_option('itm_bar_separator')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_add_post_title_to_alt">Add Post/Page title to image alt attributes<small> ( Ex: Image Alt - Post Title )</small></label>
                                <input name="itm_add_post_title_to_alt" id="itm_add_post_title_to_alt" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_add_post_title_to_alt')) ? 'checked' : ''): (intval(get_option('itm_add_post_title_to_alt')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_add_post_title_to_title">Add Post/Page title to image title attributes<small> ( Ex: Image Title - Post Title )</small></label>
                                <input name="itm_add_post_title_to_title" id="itm_add_post_title_to_title" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_add_post_title_to_title')) ? 'checked' : ''): (intval(get_option('itm_add_post_title_to_title')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_add_post_category_to_alt">Add Post/Page first category to image alt attributes<small> ( Ex: Image Alt - Category )</small></label>
                                <input name="itm_add_post_category_to_alt" id="itm_add_post_category_to_alt" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_add_post_category_to_alt')) ? 'checked' : ''): (intval(get_option('itm_add_post_category_to_alt')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_add_post_category_to_title">Add Post/Page first category to image title attributes<small> ( Ex: Image Title - Category )</small></label>
                                <input name="itm_add_post_category_to_title" id="itm_add_post_category_to_title" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_add_post_category_to_title')) ? 'checked' : ''): (intval(get_option('itm_add_post_category_to_title')) ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                        <span class="itm-settings-label"> Character or String Removal in Attributes (Global) </span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_string_trimmer">Enable String Trimmer<small> ( This allows you to trim/remove any part of the string from the alt or title attributes )</small></label>
                                <input name="itm_string_trimmer" id="itm_string_trimmer" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_trimmer')) ? 'checked' : ''): (intval(get_option('itm_string_trimmer')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup" <?php echo (get_option('string_trimmer')) ? 'style="display:none;"' : ''; ?> >
                                <label for="itm_remove_from_alt">Remove or trim this words if found from the alt attributes <small> ( Separated by comma )</small></label>
                                <input placeholder="banner, image, logo, icon" size="25" name="itm_remove_from_alt" id="itm_remove_from_alt" type="text" value="<?php echo (is_multisite() ? (get_network_option(null, 'itm_remove_from_alt')!==false ? get_network_option(null, 'itm_remove_from_alt') : ''): (get_option('itm_remove_from_alt')!==false ? get_option('itm_remove_from_alt') : '') ); ?>" class=""/>
                            </span>
                            <span class="itm-formgroup" <?php echo (get_option('string_trimmer')) ? 'style="display:none;"' : ''; ?> >
                                <label for="itm_remove_from_title">Remove or trim this words if found from the title attributes  <small> ( Separated by comma )</small></label>
                                <input placeholder="banner, image, logo, icon" size="25" name="itm_remove_from_title" id="itm_remove_from_title" type="text" value="<?php echo (is_multisite() ? (get_network_option(null, 'itm_remove_from_title')!==false ? get_network_option(null, 'itm_remove_from_title') : ''): (get_option('itm_remove_from_title')!==false ? get_option('itm_remove_from_title') : '') ); ?>" class=""/>
                            </span>
                        </div>
                    </div>
                <!--End Alt/Title Settings-->
                <!--Start Word Settings-->
                    <div id="word-block" class="itm-settings-block hide">
                        <span class="itm-settings-label">Special/Nonword Character Preservations </span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_clean_all"> Clean All<small> ( Remove any nonword characters in the entire string of the Alt/Title Attributes )</small></label>
                                <input name="itm_preserved_char" id="itm_clean_all" type="radio" value=0 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_preserved_char'))==0 ? 'checked' : ''): (intval(get_option('itm_preserved_char'))==0 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_preserved_all"> Preserved All<small> ( Preserved the entire string characters in the Alt/Title Attributes special or nonword characters including numbers)</small></label>
                                <input name="itm_preserved_char" id="itm_preserved_all" type="radio" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_preserved_char'))==1 ? 'checked' : ''): (intval(get_option('itm_preserved_char'))==1 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_preserved_special"> Preserved Special<small> ( Preserved special or nonword characters and make stripping numbers optional in the Alt/Title Attributes )</small></label>
                                <input name="itm_preserved_char" id="itm_preserved_special" type="radio" value=2 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_preserved_char'))==2 ? 'checked' : ''): (intval(get_option('itm_preserved_char'))==2 ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                        <span class="itm-settings-label"> Numerical Character Preservations </span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_strip_numbers"> Strip Numbers<small> ( Remove numbers in the filename: "filename 300x450.jpg" becomes "filename" )</small></label>
                                <input name="itm_strip_numbers" id="itm_strip_numbers" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_strip_numbers')) ? 'checked' : ''): (intval(get_option('itm_strip_numbers')) ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_use_post_title_as_default"> Use Post/Page title as fallback to image attributes<small> ( For randomly generated filenames like 1127.jpg or with less than 3 letters and image is not attached in a post)</small></label>
                                <input name="itm_use_post_title_as_default" id="itm_use_post_title_as_default" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_use_post_title_as_default')) ? 'checked' : ''): (intval(get_option('itm_use_post_title_as_default')) ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                        <span class="itm-settings-label"> String Case Manipulation </span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_leave_case"> Leave Unchanged</label>
                                <input name="itm_string_case" id="itm_leave_case" type="radio" value=0 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_case'))==0 ? 'checked' : ''): (intval(get_option('itm_string_case'))==0 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_lowercase"> Lowercase<small> ( Alt/Title Attributes will be converted to lowercase )</small></label>
                                <input name="itm_string_case" id="itm_lowercase" type="radio" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_case'))==1 ? 'checked' : ''): (intval(get_option('itm_string_case'))==1 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_uppercase"> Uppercase<small> ( Alt/Title Attributes will be converted to uppercase )</small></label>
                                <input name="itm_string_case" id="itm_uppercase" type="radio" value=2 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_case'))==2 ? 'checked' : ''): (intval(get_option('itm_string_case'))==2 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_capitalized"> Capitalized<small> ( Alt/Title Attributes will be capitalized each word )</small></label>
                                <input name="itm_string_case" id="itm_capitalized" type="radio" value=3 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_case'))==3 ? 'checked' : ''): (intval(get_option('itm_string_case'))==3 ? 'checked' : '')); ?>/>
                            </span>
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_sentence"> Sentence Case<small> ( Alt/Title Attributes will transform the first letter of the first word only )</small></label>
                                <input name="itm_string_case" id="itm_sentence" type="radio" value=4 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_string_case'))==4 ? 'checked' : ''): (intval(get_option('itm_string_case'))==4 ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                    </div>
                <!--End Word Settings-->
                <!--Start Extra Settings-->
                    <div id="extra-block" class="itm-settings-block hide">
                        <span class="itm-settings-label">Add Image Class</span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_add_class"> Add default class<small> ( class="your-default-class" )</small></label>
                                <input name="itm_add_class" id="itm_add_class" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_add_class')) ? 'checked' : ''): (intval(get_option('itm_add_class')) ? 'checked' : '')); ?>/>
                            </span>
                            <div <?php echo (get_option('add_class')) ? 'style="display:none;"' : ''; ?>>
                                <span class="itm-formgroup itm-inline">
                                    <label for="itm_global_class"> Global  <small> (Throughout the site ) </small></label>
                                    <input name="itm_scope_class" id="itm_global_class" type="radio" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_scope_class')) ? 'checked' : ''): (intval(get_option('itm_scope_class')) ? 'checked' : '')); ?>/>
                                </span>
                                <span class="itm-formgroup itm-inline">
                                    <label for="entry_class"> Entry Post Section <small> ( Applies in the entry post section only )</small></label>
                                    <input name="itm_scope_class" id="itm_entry_class" type="radio" value=0 class="" <?php echo (is_multisite() ? (!intval(get_network_option(null, 'itm_scope_class')) ? 'checked' : ''): (!intval(get_option('itm_scope_class')) ? 'checked' : '')); ?> />
                                </span>
                                <span class="itm-formgroup">
                                    <label for="itm_default_class"> Default Class <small> ( Separated by single space )</small></label>
                                    <input placeholder="your-class" size="25" name="itm_default_class" id="itm_default_class" type="text" value="<?php echo (is_multisite() ? (get_network_option(null, 'itm_default_class')!==false ? get_network_option(null, 'itm_default_class') : ''): (get_option('itm_default_class')!==false ? get_option('itm_default_class') : '') ); ?>" class=""/>
                                </span>
                                <br />
                            </div>
                        </div>
                        <span class="itm-settings-label">Disable Srcset and sizes</span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_remove_srcset_sizes">Remove srcset & sizes attribute<small> ( Get rid of srcset="" sizes="" attribute )</small></label>
                                <input name="itm_remove_srcset_sizes" id="itm_remove_srcset_sizes" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_remove_srcset_sizes')) ? 'checked' : ''): (intval(get_option('itm_remove_srcset_sizes')) ? 'checked' : '')); ?> />
                            </span>
                        </div>
                    </div>
                <!--End Extra Settings-->
                <!--Start Advance Settings-->
                    <div id="advance-block" class="itm-settings-block hide">
                        <span class="itm-settings-label">Applicable only on the post content generated by wordpress from content editor. The hardcoded image can't be save in the database. From more details please see <a href="?page=<?php echo ITM_PLUGIN; ?>&view=how-it-works#advance-settings">how it works?</a></span>
                        <div class="itm-settings-scope">
                            <span class="itm-formgroup itm-inline">
                                <label for="itm_data_saving">Use data saving attributes<small> ( This will be saved along with the post content and can work even when the plugin was removed. )</small></label>
                                <input name="itm_data_saving" id="itm_data_saving" type="checkbox" value=1 class="" <?php echo (is_multisite() ? (intval(get_network_option(null, 'itm_data_saving')) ? 'checked' : ''): (intval(get_option('itm_data_saving')) ? 'checked' : '')); ?>/>
                            </span>
                        </div>
                    </div>
                <!--End Advance Settings-->
                <p class="itm-submit">
                    <input type="submit" name="itm-settings-submit" id="itm-settings-submit" class="button button-primary" value="Save Settings">
                </p>
            </form>
        </div>
        <?php
    }
}
/**
* Initialized
*/
$ITMPluginOptions = new ITMPluginOptions();
