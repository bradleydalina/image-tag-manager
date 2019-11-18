<?php
/**
* Restrict Direct Access
*/
defined( 'ABSPATH' ) or die( 'The wrong way access...' );
/**
* Main Class
*/
class ITMPluginSettings {
    public function __construct() {
        /**
        * Check for post action
        */
        if ( ! empty( $_POST ) && isset( $_POST['ITMPlugin_action'] ) ) {
            $this->HandleForm();
        }
        /**
        * Show the form
        */
        $this->RenderForm();
    }

    public function HandleForm() {
        /**
        * Verify user permission and access level
        */
        ITMPlugin::Authorize();
        /**
        * Verify nonce submitted within the form
        */
        if(! isset( $_POST['ITMPlugin_action'] ) || ! wp_verify_nonce( $_POST['ITMPlugin_action'], 'ITMPlugin_nonce' )) {
            ?>
            <div class="t-message-box settings_tab">
                <div class="error is-dismissible">
                   <p>Sorry, your nonce was incorrect. Please try again.</p>
                </div>
            </div>
            <?php
            exit;
        }
        else {
            /**
            * Validate Post values
            */
            $image_caption = intval($_POST['image_caption']);
            $image_description = intval($_POST['image_description']);

            $strip_numbers = intval($_POST['strip_numbers']);
            $use_post_title_as_default = intval($_POST['use_post_title_as_default']);
            // $add_blog_name = intval($_POST['add_blog_name']);
            // $add_post_title = intval($_POST['add_post_title']);

            $add_class = intval($_POST['add_class']);
            $default_class = sanitize_text_field($_POST['default_class']);
            $remove_srcset_sizes = intval($_POST['remove_srcset_sizes']);

            /**
            * Update Plugin Options
            */
            update_option( 'image_caption', $image_caption );
            update_option( 'image_description', $image_description );

            update_option( 'strip_numbers', $strip_numbers );
            update_option( 'use_post_title_as_default', $use_post_title_as_default );
            // update_option( 'add_blog_name', $add_blog_name );
            // update_option( 'add_post_title', $add_post_title );

            update_option( 'add_class', $add_class );
            update_option( 'default_class', $default_class );
            update_option( 'remove_srcset_sizes', $remove_srcset_sizes );

            ?>
            <div class="t-message-box settings_tab">
                <div class="updated notice is-dismissible">
                    <p>Your plugin settings were saved!</p>
                </div>
            </div>
            <?php
        }
    }

    public function RenderForm() {
        ?>
        <form id="tag-settings" class="t-tabs t-show" method="POST">
            <h2>Plugin Settings</h2>
            <div class="t-wrap">
                    <?php wp_nonce_field( 'ITMPlugin_nonce', 'ITMPlugin_action' ); ?>
                    <input type="hidden" name="ITMPlugin_nonce" value=1 />
                    <br/>
                    <strong>Basic Settings <small>( Global ) </small></strong>
                    <!--Start Basic Settings-->
                        <span class="t-formgroup t-inline">
                            <label for="image_alt">Set Image Alt on Upload <small>( Default )</small></label>
                            <input onClick="return false;" disabled name="image_alt" id="image_alt" type="checkbox" value=1 class="" checked/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="image_title">Set Image Title on Upload <small>( Default )</small></label>
                            <input onClick="return false;" disabled only name="image_title" id="image_title" type="checkbox" value=1 class="" checked/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="image_caption">Set Image Caption on Upload <small>( Optional )</small></label>
                            <input name="image_caption" id="image_caption" type="checkbox" value=1 class="" <?php echo (boolval(get_option('image_caption'))) ? 'checked' : ''; ?>/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="image_description">Set Image Description on Upload <small>( Optional )</small></label>
                            <input name="image_description" id="image_description" type="checkbox" value=1 class="" <?php echo (boolval(get_option('image_description'))) ? 'checked' : ''; ?>/>
                        </span>
                    <!--End Basic Settings-->
                    <br/><br/>
                    <strong>Name/Title Settings <small>( Global ) </small></strong>
                    <!--Start Name/Title Settings-->
                        <span class="t-formgroup t-inline">
                            <label for="strip_numbers">Strip Numbers<small> ( Remove numbers in the filename: "filename 300x450.jpg" becomes "Filename" )</small></label>
                            <input name="strip_numbers" id="strip_numbers" type="checkbox" value=1 class="" <?php echo (boolval(get_option('strip_numbers'))) ? 'checked' : ''; ?>/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="use_post_title_as_default">Use Post/Page title as fallback to image tags<small> ( For randomly generated filenames like 1127.jpg or with less than 3 letters)</small></label>
                            <input name="use_post_title_as_default" id="use_post_title_as_default" type="checkbox" value=1 class="" <?php echo (boolval(get_option('use_post_title_as_default'))) ? 'checked' : ''; ?>/>
                        </span>
                        <!-- <small> Applicable inside the entry post content or page articles only </small>
                        <span class="t-formgroup t-inline">
                            <label for="add_post_title">Add Post/Page title in the image tags<small> ( Ex: Image Name - Post Title )</small></label>
                            <input name="add_post_title" id="add_post_title" type="checkbox" value=1 class="" <?php //echo (boolval(get_option('add_post_title'))) ? 'checked' : ''; ?>/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="add_blog_name">Add Blog name or Site title in the image tags<small> ( Ex: Image Name - My Website Title )</small></label>
                            <input name="add_blog_name" id="add_blog_name" type="checkbox" value=1 class="" <?php //echo (boolval(get_option('add_blog_name'))) ? 'checked' : ''; ?>/>
                        </span> -->
                    <!--End Name/Title Settings-->
                    <br/><br/>
                    <strong class="t-extra-title" style="display:block;">Extra Settings <small>( Applicable inside the entry post content or page articles only )</small></strong>
                    <!--Start Extra Settings-->
                        <span class="t-formgroup t-inline">
                            <label for="add_class">Add default class<small> ( class="your-default-class" )</small></label>
                            <input name="add_class" id="add_class" type="checkbox" value=1 class="" <?php echo (boolval(get_option('add_class'))) ? 'checked' : ''; ?>/>
                        </span>
                        <span class="t-formgroup" <?php echo (get_option('add_class')) ? 'style="display:none;"' : ''; ?> >
                            <label for="default_class">Default Class <small> ( Separated by single space )</small></label>
                            <input placeholder="your-class" size="25" name="default_class" id="default_class" type="text" value="<?php echo (get_option('default_class')!==false) ? get_option('default_class') : ''; ?>" class=""/>
                        </span>
                        <span class="t-formgroup t-inline">
                            <label for="remove_srcset_sizes">Remove srcset & sizes attribute<small> ( Get rid of srcset="" sizes="" attribute )</small></label>
                            <input name="remove_srcset_sizes" id="remove_srcset_sizes" type="checkbox" value=1 class="" <?php echo (boolval(get_option('remove_srcset_sizes'))) ? 'checked' : ''; ?>/>
                        </span>
                    <!--End Extra Settings-->
                    <p class="t-submit">
                        <input type="submit" name="settings-submit" id="settings-submit" class="button button-primary" value="Save Settings">
                    </p>
            </div>
        </form>
        <?php
    }
}
/**
* Initialized
*/
$ITMPluginSettings = new ITMPluginSettings();
