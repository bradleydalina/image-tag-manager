
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
        <nav><h3>Support</h3><a href="?page=<?php echo ITM_PLUGIN; ?>&view=plugin-settings">Plugin Settings</a><a href="?page=<?php echo ITM_PLUGIN; ?>&view=how-it-works">How it works</a></nav>
            <div id="support" class="itm-wrap">
                <div class="t-wrap">
                    <br/>
                    <span>Please <strong><a rel="noreferrer" target="_blank" href="<?php echo VIRGO_URI;?>#reviews">Rate</a></strong> the plugin base on its usage, and write a <strong><a rel="referrer" target="_blank" href="<?php echo VIRGO_URI;?>">Review</a></strong> for continues plugin improvement. </span>
                    <span>And don't forget also to <strong><a rel="referrer" target="_blank" href="<?php echo "https://wordpress.org/support/plugin/".VIRGO_TITM."/";?>">Submit</a></strong> or report any errors/bugs for fixes.</span>
                    <br/><br/>You can also help me by <strong><a rel="referrer" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QX8K5XTVBGV42&source=url">donating</a></strong> an amount at you're willingness to support continues plugin development for free.
                    <br/><br/>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick" />
                    <input type="hidden" name="hosted_button_id" value="QX8K5XTVBGV42" />
                    <input type="image" src="<?php echo ITM_ABSPATH;?>admin/img/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                    <img alt="" border="0" src="https://www.paypal.com/en_PH/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
            </div>
            <?php
        }
    }
$ITMPluginSupport = new ITMPluginSupport();
