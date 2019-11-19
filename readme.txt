=== Image Tag Manager ===
Contributors: bradleydalina
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QX8K5XTVBGV42&source=url
Tags: seo, seo-image, image, image-tag, img-tag, media, tag, seo-optimize, title, alt, alternative text
Requires at least: 4.6
Tested up to: 5.3
Stable tag: 1.0
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Image Tag Manager is a WordPress plugin that allows to dynamically generates (alt, title, caption and description) in ***all or any images (except iframes content) for SEO enhancement.

== Description ==

Image Tag Manager is a WordPress plugin that allows to dynamically generates (alt, title, caption and description) in ***all or any images (except iframes content) for SEO enhancement.
It also fixed the filenames before saving, removing unnecessary characters to transform into more meaningful filename and SEO friendly.

"This plugin will is limited with its available settings. Before writing a reviews, please *mention that you read the whole description* and clearly understand the limit and usage of the plugin."

== Installation ==

This section describes how to install the plugin and get it working.

e.g.
1. Upload the entire `image-tag-manager` folder to the `/wp-content/plugins/` directory or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Media->Image Tag Manager screen to configure the plugin

== Frequently Asked Questions ==

= What will happen when I remove this plugin? =

This plugin has two options, the `permanent` and the `plugin dependent` use of tag which can be found in the under > Media> Image Tag manager > plugin settings.

* The **Permanent** use of tag applies on before saving of any post type e.g( pages, post ) so the the tags will be saved along with the content in the database, and when you remove this plugin the tag will remain.
* The **Plugin Dependent** option does not applies the above procedure, it only filters the content before it renders the page using wordpress filter hooks. So this does not affects your database or modify the original content of your post. This can be more safer if you don't want this plugin applies changes to your original post. But when you remove this plugin the tags will no longer take effect.

= Does it applies in * all images in the website? =

Yes! Though the wordpress hooks used to filter the contents of the post is limited only within the entry post section, this plugin has a javascript fallback function that all images that can be scanned within the page will have the same filter as the php hook patterns used in the entry post section.
So your logo's, footer badges can also have the alt and titles.

= What happens to the image `old or original` tags or titles attribute? =

This plugin has an override option if you want to override the old or original or current alt tag of the image same as the title. If set to false the plugin will no longer apply the tag transformation like text case and invalid characters in the alt.
e.g

Before : src="my-profile 250x250.jpg" alt="my-profile 250x250" title="my-profile 250x250"
After  : src="my-profile 250x250.jpg" alt="My Profile" title="My Profile"

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

Please read the **Change Log** before upgrading, so that you will know what changes that may apply. This plugin can be tweaked and reference updates enhanced.

== A brief Markdown Example ==

Ordered list:

1. During image upload, the plugin automatically renames the image filename into SEO friendly pattern by removing unnecessary characters.
1. Plugin uses the filename as meta-data reference for alt, title, caption and description.
1. It also sets the image alt and title attribute automatically

Unordered list:

* Strip numbers in the image alt or title (optional)
* Can use the post title or page title as fall-back for alt and title attribute (optional)
* Can add default image class attribute values in the entry-post section or articles only (optional)
* Can Remove srcset and sizes attributes (optional)

Languages: English
