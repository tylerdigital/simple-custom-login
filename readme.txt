=== Simple Custom Login ===
Contributors: tylerdigital, croixhaug, scampanella
Tags: custom login, login background, login logo, login, wp-login, branding, login screen, theme login, style login
Requires at least: 3.5.1
Tested up to: 4.5
Stable tag: 1.0.3

Quickly apply some fun or custom branding to your login screen

== Description ==

Simple Custom Login allows you to set a custom login for your WordPress site without any code.

Simple Custom Login allows you to: 
* Upload a background image – it fills the space on any device
* Choose from basic color options – in case your image doesn't look good with the default blue buttons & links

Make your login screen uniquely yours in under 2 minutes (no frustration necessary)

== Installation ==

1. Install the plugin using the plugin installer within WordPress (or, upload the `simple-custom-login` folder to the `/wp-content/plugins/` directory)

2. Activate the plugin through the 'Plugins' menu in WordPress.

== Usage ==

An options page can be found within Settings -> Simple Custom Login

Within the Simple Custom Login options page select the color scheme that you would like the button and link colors to be.

Upload a background image file that you would like to be used for the background of your WordPress login.

Be sure to Save Changes once you are done with your customizations.

== Frequently Asked Questions ==

= Can I upload files to my theme rather than placing them in the plugin settings? =

Yes! You can place login-logo.png and login-background.jpg (or login-background.png) into your wp-content/ directory and Simple Custom Login will find them there!

If you set an image within the plugin settings, Simple Custom Login will always prefer that one, but it will check the wp-content/ directory before defaulting to a blank image.

This means you can set a default for all your new WP installs, just place images at wp-content/login-logo.png and wp-content/login-background.jpg & activate the plugin!

Thanks to code from Mark Jaquith's [Login Logo](https://wordpress.org/plugins/login-logo/) plugin for this functionality

= Can I customize the position of the login box? =

We want to keep this plugin really simple, we chose a default location offset from the center that works well in the majority of cases. If you want to tweak the exact position of the box, this can be done with CSS (or there are more complex plugins available that might allow this control)

= Can I customize the cropping of the image on my phone/tablet/etc? =

Unfortunately not, we're using a CSS property called backround-size: cover; that works nicely on a variety of sizes. This will not be perfect for all images or all screen dimensions. Often this can be solved by finding another image :)

== Screenshots ==

1. Really simple settings
2. Customize your login screen for your company or your client's brand
3. Upload a custom background without a logo
4. It even scales down for mobile
5. Be happy to see your login screen

== Changelog ==

= 1.0.3 =
* New: Added i18n Support
* New: Added Spanish language support
* New: Added Portguuese language support (pt_PT, pt_BR)
* Fixed: PHP7 Compatibility

= 1.0.2 =
* Fixed: Delete erroneous trunk included in distributed versions

= 1.0.1 =
* Fixed: Fix error on login screen

= 1.0 =
* Initial Release
