=== Simple Custom Login ===
Contributors: tylerdigital, croixhaug, scampanella
Tags: custom login, login background, login logo, login, wp-login, branding
Requires at least: 3.5.1
Tested up to: 4.2
Stable tag: 1.0

(Really) Easy login screen customization.

== Description ==

Simple Custom Login allows you to quickly apply some fun or custom branding to your login screen. The Simple Interface lets you add your own touch to the login screen without an overwhelming settings page.

Your customized page is fully responsive: simply upload your logo & background image and Simple Custom Login will automatically scale & crop your background image to work on every device

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `simple-custom-login` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Can I upload files to my theme rather than placing them in the plugin settings? =

Yes! You can place login-logo.png and login-background.jpg (or login-background.png) into your wp-content/ directory and Simple Custom Login will find them there!

If you set an image within the plugin settings, Simple Custom Login will always prefer that one, but it will check the wp-content/ directory before defaulting to a blank image.

This means you can set a default for all your new WP installs, just place images at wp-content/login-logo.png and wp-content/login-background.jpg & activate the plugin!

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

= 1.0 =
Initial Release
