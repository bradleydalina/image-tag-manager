<div id="how-it-works" class="t-tabs t-hide">
    <?php
        /**
        * Get the current upload directory
        */
        $uploads_dir= trailingslashit(wp_get_upload_dir()["url"]);
    ?>
    <h2>How It Works?</h2>
    <div class="t-wrap">
        <br/>
        <strong>Basic Settings</strong>
        <!--Start Basic Settings-->
            <br/><br/>
            <span class="t-status">Once the plugin is activated, alt and title tag will automatically be applied in the images globally. While caption and description are optional.</span><br/>
            <br/>
            <small class="t-guide">Before:</small>
            <div class="t-demo">&lt;img src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" class="wp-image-3427"&gt;</div>
            <br/>
            <small class="t-guide">After:</small>
            <pre class="t-code">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
        <!--End Basic Settings-->
        <br/><br/><br/>
        <strong>Name/Title Settings</strong>
        <!--Start Name/Title Settings-->
            <br/><br/>
            <span class="t-status">If "Strip Numbers" is checked, every file uploads will stripped the numbers off, but generates unique filename and adds number increament if same filename already exists. This only works for the new uploads, the filename of the images that has already been uploaded before this plugin will remain in the original filenames but there alt and title tags will be stripped.</span><br/>
            <br/>
            <small class="t-guide">Image file to be uploaded:</small>
            <div class="t-demo"><b>bradley-dalina-3427</b>.jpg</div>
            <br/>
            <small class="t-guide">After:</small>
            <pre class="t-code">&lt;img <b>title="<strong>Bradley Dalina</strong>"</b> src="<?php echo $uploads_dir;?><b>bradley-dalina</b>.jpg" <b>alt="<strong>Bradley Dalina</strong>"</b> class="wp-image-3427"&gt;</pre>
            <br/><br/>
            <span class="t-status">If "Use Post/Page title as fallback" is checked and the image uploaded does not contain more than 3 letters to be a valid meaningful name, the site will use the post/page attachment title as the name of the image or the site title if not on a post page. Let say you add an image attachment on "Hello World!" post.</span><br/>
            <br/>
            <small class="t-guide">Image file to be uploaded:</small>
            <div class="t-demo"><b>br3427</b>.jpg</div>
            <br/>
            <small class="t-guide">After:</small>
            <pre class="t-code">&lt;img <b>title="<strong>Hello World</strong>"</b> src="<?php echo $uploads_dir;?><b>hello-world</b>.jpg" <b>alt="<strong>Hello World</strong>"</b> class="wp-image-3427"&gt;</pre>
            <!-- <br/><br/>
            <span class="t-status">If "Add Post/Page or Site title " is checked, this will append the attachment page title or the site title at the end of the image alt or title tag.  applicable on the entry post or page article only.</span><br/>
            <br/>
            <small class="t-guide">After:</small>
            <pre class="t-code">&lt;img title="<b>Bradley Dalina <strong>- Hello World</strong></b>" src="<?php echo $uploads_dir;?>/bradley-dalina.jpg" alt="<b>Bradley Dalina<strong> - Hello World</strong></b>" class="wp-image-3427"&gt;<br/><br/>&lt;img title="<b>Bradley Dalina <strong>- Hello World - <?php bloginfo('name');?></strong></b>" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="<b>Bradley Dalina<strong> - Hello World - <?php bloginfo('name');?></strong></b>" class="wp-image-3427"&gt;</pre> -->
        <!--End Name/Title Settings-->
        <br/><br/><br/>
        <strong class="t-extra-title" style="display:block;">Extra Settings</strong>
        <!--Start Extra Settings-->
        <br/>
        <span class="t-status">You can add multiple classes in the image applicable on the entry post or page article only.</span><br/>
        <br/><small class="t-guide">Before:</small>
        <div class="t-demo">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="wp-image-3427"</b>&gt;</div>
        <br/><small class="t-guide">After:</small>
        <div class="t-demo">&lt;img src="<?php echo $uploads_dir;?>3427.jpg" <b>class="<strong>lazy-image beautify</strong> wp-image-3427"</b>&gt;</div>
        <br/><br/>
        <span class="t-status">You can remove srcset and sizes tag applicable on the entry post or page article only.</span><br/>
        <br/><small class="t-guide">Before:</small>
        <div class="t-demo">&lt;img src="<?php echo $uploads_dir;?>bradley-dalina.jpg" class="wp-image-147" <b>srcset="<?php echo $uploads_dir;?>bradley-dalina.jpg 210w, <?php echo $uploads_dir;?>bradley-dalina-150x150.jpg 150w, <?php echo $uploads_dir;?>bradley-dalina-90x90.jpg 90w, <?php echo $uploads_dir;?>bradley-dalina-170x170.jpg 170w" sizes="(max-width: 210px) 100vw, 210px"</b>/&gt;</div><br/>
        <small class="t-guide">After:</small>
        <div class="t-demo">&lt;img title="Bradley Dalina" src="<?php echo $uploads_dir;?>bradley-dalina.jpg" alt="Bradley Dalina" class="wp-image-147"/&gt;</div>
    <!--End Extra Settings-->
    </div>
</div>
