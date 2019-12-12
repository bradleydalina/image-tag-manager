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
            <div class="itm-flex" id="itm-how-it-works">
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
                <div class="itm-flex-right itm-settings-content">
                    <?php wp_nonce_field( 'itm_plugin_nonce', 'itm_plugin_action' ); ?>
                    <input type="hidden" name="itm_plugin_nonce" value=1 />
                    <!--Start Basic Settings-->
                        <div id="basic-block" class="itm-settings-block hide">
                            <span class="itm-settings-label">Once the plugin is activated, on upload of image file, alt and title attributes will automatically be applied in the images globally while caption and description are optional.</span>
                            <small class="itm-guide itm-orange">Before:</small>
                            <pre class="itm-code itm-before">&lt;img src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" class="wp-image-3427"&gt;</pre>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
                        </div>
                    <!--End Basic Settings-->
                    <!--Start Alt/Title Settings-->
                        <div id="alt-title-block" class="itm-settings-block show">
                            <span class="itm-settings-label">Override Settings, for old/current alt or title attributes. If this is <b class="itm-orange">set to false the following settings below will not work</b> if the image has an old alt or title attributes.</span>
                            <br/><br/>
                            <span class="itm-settings-label">If "Add Post/Page title to alt or title attibute" is checked, this will append the attachment page title at the end of the image alt or title attribute. There is two available separator the hypen ( - ) and bar ( | ).<br/><br/>
                            <b class="itm-orange">NOTE:</b> Applicable on the entry post or page article only.</span><br/>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img title="<b>Bradley Dalina</b>" src="<?php echo $uploads_dir;?>/bradley-dalina.jpg" alt="<b>Bradley Dalina<strong> - Hello World</strong></b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>- Hello World</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina</b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>| Hello World</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina <strong>| Hello World</strong></b>" class="wp-image-3427"&gt;</pre>
                            <br/><br/>
                            <span class="itm-settings-label">If "Add Post/Page Category to alt or title attibute" is checked, this will append the attachment page first category at the end of the image alt or title attribute. There is two available separator the hypen ( - ) and bar ( | ).<br/><br/>
                            <b class="itm-orange">NOTE:</b> Applicable on the entry post or page article only.</span><br/>
                            <small class="itm-guide itm-blue">After: (eg. sample category is : developer)</small>
                            <pre class="itm-code itm-after">&lt;img title="<b>Bradley Dalina</b>" src="<?php echo $uploads_dir;?>/bradley-dalina.jpg" alt="<b>Bradley Dalina<strong> - Developer</strong></b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>- Developer</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina</b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>| Developer</strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina <strong>| Developer</strong></b>" class="wp-image-3427"&gt;</pre>
                            <br/><br/>
                            <span class="itm-settings-label">This plugin has an <u>String Trimmer</u> in the alt or title attibute", this allows you to trim unnecessary words to be used in the image attibute. <br/><br/>
                            <b class="itm-orange">NOTE:</b> This only trims the attributes not the filename, applicable globally.</span><br/>
                            <small class="itm-guide itm-orange">Before: You want to remove "Header, Banner, Image":</small>
                            <pre class="itm-code itm-before">&lt;img title="<b>Bradley Dalina Header Banner Image</b>" src="<?php echo $uploads_dir;?><b class="itm-solid">bradley-dalina-header-banner-image</b>.jpg" alt="<b>Bradley Dalina Header Banner Image</b>" class="wp-image-3427"&gt;</pre>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b class="itm-solid">bradley-dalina-header-banner-image</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
                            <br/><br/>
                        </div>
                    <!--End Alt/Title Settings-->
                    <!--Start Word Settings-->
                        <div id="word-block" class="itm-settings-block hide">
                            <span class="itm-settings-label">Special/Nonword Character Preservations </span><br/><br/>
                            <span class="status">Character Preservation for the Alt and Title attributes has 3 options: Clean All, Preserved All and Preserved Special, please note that this does not work on filenames because a valid filename must not contain [*,!/\^& etc..]</span>
                            <br/>
                            <small class="itm-guide itm-blue">Clean All will removed any non-word characters, and make stripping numbers optional: ex. strip_numbers true [Dalina, Bradley B. 09264482952]</small>
                            <pre class="itm-code itm-after"><b>Dalina Bradley B</b></pre>
                            <small class="itm-guide itm-blue">Preserved All will preserved the entire characters, and make stripping numbers disabled: [Dalina, Bradley B. 09264482952]</small>
                            <pre class="itm-code itm-after"><b>Dalina, Bradley B. 09264482952</b></pre>
                            <small class="itm-guide itm-blue">Preserved Special works the same with preserved all but allow to stripping numbers optional ex. strip_numbers true: [Dalina, Bradley B. 09264482952]</small>
                            <pre class="itm-code itm-after"><b>Dalina, Bradley B. </b></pre>
                            <br/><br/>
                            <span class="itm-settings-label"> Numerical Character Preservations </span><br/><br/>
                            <span class="itm-settings-label">If "Strip Numbers" is checked, <u>every new file uploads</u> will have the numbers stripped off from the filename, but if the same filename already exists, it will generates a unique filename by adding an increament.
                            <br/><br/><b class="itm-orange">NOTE:</b> This only works for the <u>new uploads</u>, the filename of the images that has already been uploaded before this plugin will remain in the <u>original filenames</u> but there alt and title attributes will be stripped and transformed.</span><br/>
                            <small class="itm-guide itm-orange">Image file to be uploaded:</small>
                            <pre class="itm-code itm-before"><b>bradley-dalina-3427</b>.jpg</pre>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
                            <br/><br/>
                            <span class="itm-settings-label">If "Use Post/Page title as fallback" is checked, the plugin will check the image filename on every upload, if id does not contain more than 3 letters to be a valid or meaningful name, the plugin will use the <u>post/page attachment title or the site title</u> as the filename of the image.</span><br/>
                            <small class="itm-guide itm-orange">Image file to be uploaded in the <u>Hello World!</u> post:</small>
                            <pre class="itm-code itm-before"><b>br3427</b>.jpg</pre>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img <b>title="<strong>Hello World</strong>"</b> src="<?php echo $uploads_dir;?><b>hello-world</b>.jpg" <b>alt="<strong>Hello World</strong>"</b> class="wp-image-3427"&gt;</pre>
                            <br/><br/>
                            <span class="status">This plugin has an <u>String Case</u> functionality", this allows you to choice the string capitalization of the alt ot title attributes.</span>
                            <small class="itm-guide itm-blue">Unchanged, Lowercase, Uppercase, Capitalized, Sentence:</small>
                            <pre class="itm-code itm-after"><b>Bradley daLina, bradley dalina, BRADLEY DALINA, Bradley Dalina, Bradley dalina</b></pre>


                        </div>
                    <!--End Word Settings-->
                    <!--Start Extra Settings-->
                        <div id="extra-block" class="itm-settings-block hide">
                            <span class="itm-settings-label">Add Image Class, this plugin allows you to add multiple classes in the image.<br/><br/>
                            <b class="itm-orange">NOTE:</b> Options to apply globally or in the entry post or page article only.</span><br/>
                            <small class="itm-guide itm-orange">Before:</small>
                            <pre class="itm-code itm-before">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="wp-image-3427"</b>&gt;</pre>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="<strong>lazy-image beautify</strong> wp-image-3427"</b>&gt;</pre>
                            <br/><br/>
                            <span class="itm-settings-label">Disable Srcset and sizes, this plugin also allows you to remove srcset and sizes attribute.</span><br/>
                            <small class="itm-guide itm-orange">Before:</small>
                            <pre class="itm-code itm-before">&lt;img src="<?php echo $uploads_dir;?>bradley-dalina.jpg" class="wp-image-147" <b>srcset="<?php echo $uploads_dir;?>bradley-dalina.jpg 210w, <?php echo $uploads_dir;?>bradley-dalina-150x150.jpg 150w, <?php echo $uploads_dir;?>bradley-dalina-90x90.jpg 90w, <?php echo $uploads_dir;?>bradley-dalina-170x170.jpg 170w" sizes="(max-width: 210px) 100vw, 210px"</b>/&gt;</pre><br/>
                            <small class="itm-guide itm-blue">After:</small>
                            <pre class="itm-code itm-after">&lt;img title="Bradley Dalina" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="Bradley Dalina" class="wp-image-147"/&gt;</pre>
                        </div>
                    <!--End Extra Settings-->
                    <!--Start Advance Settings-->
                        <div id="advance-block" class="itm-settings-block hide">
                            <span class="itm-settings-label">Applicable only on the post content generated by wordpress from content editor. The hardcoded image can't be save in the database, this plugin gives you an option to save the alt and title attribute in the database along with the post, this modifies the content of the post before saving it.<br/><br/>
                               <b class="itm-blue">PROS:</b> By checking this option, the alt and title attribute added to the images will remain and still will work in the future even if you remove the plugin.<br/><br/>
                               <b class="itm-orange">CONS:</b> If this is set to false and you remove the plugin, alt's and title attributes will not work the same unless you manually add it or use another plugin, however adding title attribute is not recognized as valid attibute by the gutenberg content editor.<br/><br/>
                        </div>
                    <!--End Advance Settings-->
                </form>
            </div>
        <?php
    }
}
$ITMPluginWorks = new ITMPluginWorks();
