<?php
/*
Plugin Name: Simple Custom Login
Plugin URI: http://tylerdigital.com
Description: Quickly apply some fun or custom branding to your login screen
Version: 1.0.3
Author: Tyler Digital
Author URI: http://tylerdigital.com
Text Domain: simple-custom-login
License:

  Copyright 2013 Tyler Digital

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class TDCustomLogin {

	public $settings;
	public $login_logo;
	public $login_background;
	protected static $instance = null;

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );
		add_filter( 'login_body_class', array( $this, 'apply_color_style' ) );

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		add_action( 'login_head', array( $this, 'register_login_styles' ), 20 );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = 'simple-custom-login' . '.php' ;
		add_filter( 'plugin_action_links_simple-custom-login/simple-custom-login.php', array( $this, 'add_action_links' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( 'TDCustomLogin', 'activate' ) );
		register_deactivation_hook( __FILE__, array( 'TDCustomLogin', 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( 'TDCustomLogin', 'uninstall' ) );

		include_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';
		$this->settings = new TDCustomLogin_Settings( $this );
		if ( !class_exists( 'CWS_Login_Logo_Plugin' ) ) {
			include_once( 'lib/login-logo/login-logo.php' );
		}
		$this->login_logo = new CWS_Login_Logo_Plugin();
		$this->login_logo->init();
		
		if ( !class_exists( 'TD_Login_Background_Plugin' ) ) include_once( 'lib/login-background/login-background.php' );
		$this->login_background = new TD_Login_Background_Plugin();
		$this->login_background->init();

	} // end constructor

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public static function activate( $network_wide ) {
		// TODO: Define activation functionality here
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
	} // end deactivate

	/**
	 * Fired when the plugin is uninstalled.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public static function uninstall( $network_wide ) {
		// TODO: Define uninstall functionality here
	} // end uninstall

	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {

		// TODO: replace "simple-custom-login-locale" with a unique value for your plugin
		$domain = 'simple-custom-login';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	} // end plugin_textdomain

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_login_styles() {

		wp_enqueue_style( 'simple-custom-login-login-styles', plugins_url( 'simple-custom-login/css/login.css' ) );
		include_once plugin_dir_path( __FILE__ ) . 'css/login.php';
	} // end register_admin_styles

	public function register_admin_styles() {

		wp_enqueue_style( 'simple-custom-login-admin-styles', plugins_url( 'simple-custom-login/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( 'simple-custom-login-admin-script', plugins_url( 'simple-custom-login/js/admin.js' ) );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues plugin-specific styles.
	 */
	public function register_plugin_styles() {

		// TODO: Change 'simple-custom-login' to the name of your plugin
		wp_enqueue_style( 'simple-custom-login-plugin-styles', plugins_url( 'simple-custom-login/css/display.css' ) );

	} // end register_plugin_styles

	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {

		// TODO: Change 'simple-custom-login' to the name of your plugin
		wp_enqueue_script( 'simple-custom-login-plugin-script', plugins_url( 'simple-custom-login/js/display.js' ) );

	} // end register_plugin_scripts

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=options-custom-login' ) . '">' . __( 'Settings', 'simple-custom-login' ) . '</a>'
			),
			$links
		);

	}

	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	public static function get_option( $option, $default='' ) {
		global $td_custom_login;
		$value = $td_custom_login->settings->framework->get_option( $option, $default );
		if( empty( $value ) ) $value = $default;

		return $value;
	}

	public function apply_color_style( $classes ) {
		$classes[] = $this->settings->framework->get_option( 'color_scheme' );
		return $classes;
	} // end action_method_name


} // end class

$td_custom_login = new TDCustomLogin();
