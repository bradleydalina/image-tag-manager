=== Image Tag Manager ===
Contributors: bradleydalina
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QX8K5XTVBGV42&source=url
Tags: seo, seo-image, image, image-tag, img-tag, media, tag, seo-optimize, title, alt, alternative text,image-title, image-alt
Requires at least: 4.6
Tested up to: 5.3
Stable tag: 1.0
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to dynamically generates (alt, title, caption and description) in any images of your site for SEO enhancement.

== Description ==

Image Tag Manager is a WordPress plugin that allows to dynamically generates (alt, title, caption and description) in ***all or any images (except iframes content) for SEO enhancement.
It also fixed the filenames before saving, removing unnecessary characters to transform into more meaningful filename and SEO friendly.

"This plugin will is limited with its available settings. Before writing a reviews, please *mention that you read the whole description* and clearly understand the limit and usage of the plugin."

1. During image upload, the plugin automatically renames the image filename into SEO friendly pattern by removing unnecessary characters.
1. Plugin uses the filename as primary meta-data reference for alt, title, caption and description but has an option to add the attachment post/page title.

**Plugin Options**

* Strip numbers in the image alt or title (optional)
* Can use the post title or page title as fall-back for alt and title attribute if the image filename does not contain more than 3 letter to be meaning or image has numbers as its name (optional)
* Can Add post/page title to the image alt or title attribute, if title already exists in the attribute it will be skip
* Can Override the alt or title attribute.
* Can Remove words in the title or alt attribute base on the specified sets.
* Can add default image class attribute values in the entry-post section or articles.
* Can Remove srcset and sizes attributes in the entry-post section or articles.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.
1. Upload the entire `image-tag-manager` folder to the `/wp-content/plugins/` directory or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Media->Image Tag Manager screen to configure the plugin

== Frequently Asked Questions ==

= What will happen when I remove this plugin? =

This plugin has an options, the `data_saving` which can be found in the under > Media> Image Tag manager > plugin settings.

* The **Data Saving** option applies on before saving of any post type e.g( pages, post ) so the the attributes will be saved along with the content in the database, and when you remove this plugin the (title) attribute will remain. However Gutenberg content editor does not recognized title as a valid attribute in an image tag.
* While setting this option to false does not applies the above procedure, it only filters the content before it renders the page using wordpress filter hooks. So this does not affects your database or modify the original content of your post. This can be more safer if you don't want this plugin applies changes to your original post. But when you remove this plugin the alt and title attributes will no longer take effect unless you do it manually or use another plugin.

= Does it applies in * all images in the website? =

Yes! Though the wordpress hooks used in this plugin to filter the contents of the post is limited only within the entry post section, this plugin has a javascript fallback function that captures all images that can be scanned within the page will have the same filter as the php hook patterns used in the entry post section.
So your logo's, footer badges can also have the alt's and title attributes.

= What happens to the image `old or original` attributes? =

This plugin has an override option if you want to override the old/original/current alt's and title attributes of the image. If set to false the plugin will skip the image will has already alt and title attributes.
e.g

Before Override Set False: src="my-profile 250x250.jpg" alt="my-profile 250x250" title="my-profile 250x250"
After Override Set True : src="my-profile 250x250.jpg" alt="My Profile" title="My Profile"

== Screenshots ==

1. screenshot-1.jpg
1. screenshot-2.jpg
1. screenshot-3.jpg
1. screenshot-4.jpg
1. screenshot-5.jpg

== Changelog ==

= 1.0 =
* Initial release

== Upgrade Notice ==

Please read the **Change Log** before upgrading, so that you will know what changes have been applied.

Languages: English
