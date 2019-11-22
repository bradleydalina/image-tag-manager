<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
* Main Class
*/
class ITMPluginWorks {
    public function __construct() {
        self::html();
    }
    public static function html(){
        ?>
            <?php
                /**
                * Get the current upload directory
                */
                $uploads_dir= trailingslashit(wp_get_upload_dir()["url"]);
            ?>
            <nav><h3>How it works</h3><a href="?page=<?php echo ITM_PLUGIN; ?>&view=plugin-settings">Plugin Settings</a><a href="?page=<?php echo ITM_PLUGIN; ?>&view=support">Support</a></nav>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="float-right">
                <input type="hidden" name="cmd" value="_s-xclick" />
                <input type="hidden" name="hosted_button_id" value="QX8K5XTVBGV42" />
                <input type="image" src="<?php echo ITM_ABSPATH;?>admin/img/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                <img alt="" border="0" src="https://www.paypal.com/en_PH/i/scr/pixel.gif" width="1" height="1" />
                </form>
            <div id="how-it-works" class="itm-wrap">
                <strong>Basic Settings</strong>
                <!--Start Basic Settings-->
                    <br/><br/>
                    <span class="status">Once the plugin is activated, alt and title attributes will automatically be applied in the images globally. While caption and description are optional. <br /><br />This plugin has also an option for overriding the current alt or title attributes.</span><br/>
                    <br/>
                    <small class="guide">Before:</small>
                    <div class="demo">&lt;img src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" class="wp-image-3427"&gt;</div>
                    <br/>
                    <small class="guide">After:</small>
                    <pre class="code">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
                <!--End Basic Settings-->
                <br/><br/>
                <strong>Name/Title Settings</strong>
                <!--Start Name/Title Settings-->
                    <br/><br/>
                    <span class="status">If "Strip Numbers" is checked, <u>every new file uploads</u> will have the numbers stripped off from the filename, but if the same filename already exists, it will generates a unique filename by adding an increament.
                    <br/><br/>NOTE: This only works for the <u>new uploads</u>, the filename of the images that has already been uploaded before this plugin will remain in the <u>original filenames</u> but there alt and title attributes will be stripped and transformed.</span><br/>
                    <br/>
                    <small class="guide">Image file to be uploaded:</small>
                    <div class="demo"><b>bradley-dalina-3427</b>.jpg</div>
                    <br/>
                    <small class="guide">After:</small>
                    <pre class="code">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
                    <br/><br/>
                    <span class="status">If "Use Post/Page title as fallback" is checked, the plugin will check the image filename on every upload, if id does not contain more than 3 letters to be a valid or meaningful name, the plugin will use the <u>post/page attachment title or the site title</u> as the filename of the image.</span><br/>
                    <br/>
                    <small class="guide">Image file to be uploaded in the <u>Hello World!</u> post:</small>
                    <div class="demo"><b>br3427</b>.jpg</div>
                    <br/>
                    <small class="guide">After:</small>
                    <pre class="code">&lt;img <b>title="<strong>Hello World</strong>"</b> src="<?php echo $uploads_dir;?><b>hello-world</b>.jpg" <b>alt="<strong>Hello World</strong>"</b> class="wp-image-3427"&gt;</pre>
                    <br/><br/>
                    <span class="status">If "Add Post/Page title to alt or title attibute" is checked, this will append the attachment page title at the end of the image alt or title attribute. <br/><br/>
                        NOTE: Applicable on the entry post or page article only.</span><br/>
                    <br/>
                    <small class="guide">After:</small>
                    <pre class="code">&lt;img title="<b>Bradley Dalina</b>" src="<?php echo $uploads_dir;?>/bradley-dalina.jpg" alt="<b>Bradley Dalina<strong> - Hello World</strong></b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>- Hello World</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina</b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>- Hello World</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina <strong>- Hello World</strong></b>" class="wp-image-3427"&gt;</pre>
                    <br/><br/>
                    <span class="status">This plugin has an <u>String Trimmer</u> in the alt or title attibute", this allows you to trim unnecessary words to be used in the image attibute. <br/><br/>
                        NOTE: This only trims the attributes not the filename.</span><br/>
                    <br/>
                    <small class="guide">You want to remove "Header, Banner, Image":</small>
                    <div class="demo">&lt;img title="<b>Bradley Dalina Header Banner Image</b>" src="<?php echo $uploads_dir;?><b>bradley-dalina-header-banner-image</b>.jpg" alt="<b>Bradley Dalina Header Banner Image</b>" class="wp-image-3427"&gt;</div>
                    <br/>
                    <small class="guide">After:</small>
                    <pre class="code">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina-header-banner-image</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>

                <!--End Name/Title Settings-->
                <br/><br/>
                <strong class="t-extra-title" style="display:block;">Extra Settings</strong>
                <!--Start Extra Settings-->
                <br/>
                <span class="status">This plugin allows you to add multiple classes in the image.<br/><br/>
                NOTE: applicable on the entry post or page article only.</span><br/>
                <br/><small class="guide">Before:</small>
                <div class="demo">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="wp-image-3427"</b>&gt;</div>
                <br/><small class="guide">After:</small>
                <pre class="code">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="<strong>lazy-image beautify</strong> wp-image-3427"</b>&gt;</pre>
                <br/><br/>
                <span class="status">This plugin also allows you to remove srcset and sizes attribute.<br/><br/>
                    NOTE: Applicable on the entry post or page article only.</span><br/>
                <br/><small class="guide">Before:</small>
                <div class="demo">&lt;img src="<?php echo $uploads_dir;?>bradley-dalina.jpg" class="wp-image-147" <b>srcset="<?php echo $uploads_dir;?>bradley-dalina.jpg 210w, <?php echo $uploads_dir;?>bradley-dalina-150x150.jpg 150w, <?php echo $uploads_dir;?>bradley-dalina-90x90.jpg 90w, <?php echo $uploads_dir;?>bradley-dalina-170x170.jpg 170w" sizes="(max-width: 210px) 100vw, 210px"</b>/&gt;</div><br/>
                <small class="guide">After:</small>
                <pre class="code">&lt;img title="Bradley Dalina" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="Bradley Dalina" class="wp-image-147"/&gt;</pre>
                <!--End Extra Settings-->
                <br/><br/>
                <strong class="t-extra-title" style="display:block;">Advance Settings</strong>
                <!--Start Extra Settings-->
                <br/>
                <span class="status">This plugin gives you an option to save the alt and title attribute in the database along with the post, this modifies the content of the post before saving it.<br/><br/>
                PROS: By checking this option, even if you remove the plugin in the future, the alt and title attribute will remain and still will work.<br/><br/>
                CONS: If this is set to false and you remove the plugin, alt's and title attributes will not work the same unless you manually add it or use another plugin, however adding title attribute is not recognized as valid attibute by the gutenberg content editor.<br/><br/>
                NOTE: Please read carefully and apply the settings if you clearly understand, if you don't trust this plugin's ability and don't want this to modify the post. Just ignore this option.</span><br/>
                <br/><small class="guide">Before:</small>
        </div>
        <?php
    }
}
$ITMPluginWorks = new ITMPluginWorks();
