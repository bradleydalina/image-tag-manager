<?php
/**
 * Restrict Direct Access
 */
defined( 'ABSPATH' ) or die( 'You\'re in the wrong way of access...' );
/**
* Main Class
*/
class ITMPluginSupport {
    public function __construct() {
        self::html();
    }
    public static function html(){
        ?>
        <div class="itm-flex" id="itm-support">
            <div class="itm-flex-left itm-settings-nav">
                <div class="itm-flex-left itm-settings-nav">
                    <a target="#issues-block" id="issues-support" class="itm-settings-tab active">Plugin Issues</a>
                    <a target="#user-block" id="user-support" class="itm-settings-tab inactive">User Support</a>
                    <a target="#development-block" id="development-support" class="itm-settings-tab inactive">Development Support</a>
                    <form class="itm-donation-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="QX8K5XTVBGV42" />
                        <input class="itm-donate-button itm-fullwidth" type="image" src="<?php echo ITM_ABSPATH;?>admin/img/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                        <img alt="" border="0" src="https://www.paypal.com/en_PH/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
            </div>
            <div class="itm-flex-right itm-settings-content">
                <!--Start Plugin Issues-->
                    <div id="issues-block" class="itm-settings-block show">
                        <h3 class="itm-support-h3">Plugin Issues</h3>
                        <span class="itm-settings-label">If by any chance you encountered plugin issues, please <strong><a rel="referrer" target="_blank" href="<?php echo "https://wordpress.org/support/plugin/".ITM_PLUGIN."/";?>">submit</a></strong> a brief report and provide a screenshot if possible so that I may be able to include them in the next plugin update, thank you.</span>
                        <p><span class="itm-mb5">Plugin URL: <a target="_blank" href="http://wordpress.org/plugins/image-tag-manager/">Image Tag Manager</a></span>
                        <span class="itm-mb5">Email: <a target="_blank" href="mailto:bradleydalina@gmail.com">bradleydalina@gmail.com</a></span>
                        <span class="itm-mb5">Author: <a target="_blank" href="https://www.bradley-dalina.tk/">Bradley Dalina</a></span></p>
                    </div>
                <!--End Plugin Issues-->
                <!--Start User Support-->
                    <div id="user-block" class="itm-settings-block hide">
                        <h3 class="itm-support-h3">User Support</h3>
                        <span class="itm-settings-label">For as long as there are users who found this plugin helpful, by doing there part thru feedback and <strong><a rel="noreferrer" target="_blank" href="<?php echo ITM_URI;?>#reviews">reviews</a></strong> the development support will continue.</span>
                        <p><span class="itm-mb5">Plugin URL: <a target="_blank" href="http://wordpress.org/plugins/image-tag-manager/">Image Tag Manager</a></span>
                        <span class="itm-mb5">Email: <a target="_blank" href="mailto:bradleydalina@gmail.com">bradleydalina@gmail.com</a></span>
                        <span class="itm-mb5">Author: <a target="_blank" href="https://www.bradley-dalina.tk/">Bradley Dalina</a></span></p>
                    </div>
                <!--End User Support-->
                <!--Start Development Support-->
                    <div id="development-block" class="itm-settings-block hide">
                        <h3 class="itm-support-h3">Development Support</h3>
                        <span class="itm-settings-label">Your positive reviews and ratings can be very helpful to me, it would also be nice if you can <a rel="referrer" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=QX8K5XTVBGV42&amp;source=url">donate</a> any amount for funding.</span>
                        <p><span class="itm-mb5">Plugin URL: <a target="_blank" href="http://wordpress.org/plugins/image-tag-manager/">Image Tag Manager</a></span>
                        <span class="itm-mb5">Email: <a target="_blank" href="mailto:bradleydalina@gmail.com">bradleydalina@gmail.com</a></span>
                        <span class="itm-mb5">Author: <a target="_blank" href="https://www.bradley-dalina.tk/">Bradley Dalina</a></span></p>
                    </div>
                <!--End Development Support-->
            </div>
            <?php
        }
    }
$ITMPluginSupport = new ITMPluginSupport();
