<?php

include_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/options-buddy-master/class.options-buddy.php';
class TDCustomLogin_Settings {
	public $parent;
	public $framework;

	function __construct( $parent ) {
		$this->framework = new OptionsBuddy_Settings_Page('options-custom-login');

		add_action( 'admin_init', array($this, 'admin_init'));
		add_action( 'admin_menu', array($this, 'admin_menu') );
	}

	function admin_init() {

		$page = $this->framework;

		$page->add_section('basic_section', __( 'Basic Settings', 'simple-custom-login' ) );

		$page->get_section('basic_section')->add_fields(array(
				array(
					'name' => 'color_scheme',
					'label' => __( 'Color scheme', 'simple-custom-login' ),
					'desc' => __( 'Changes the button colors on the login screen', 'simple-custom-login' ),
					'type' => 'select',
					'default' => '',
					'options' => array(
						'' => __( 'Default (blue)', 'simple-custom-login' ),
						'red' => __('Red', 'simple-custom-login' ),
						'green' => __( 'Green', 'simple-custom-login' ),
					)
				),

				array(
					'name' => 'background_image',
					'label' => __( 'Background Image', 'simple-custom-login' ),
					'desc' => __( 'Upload a large image to use as the background of your login screen', 'simple-custom-login' ),
					'type' => 'image',
					'default' => ''
				),

				array(
					'name' => 'login_logo',
					'label' => __( 'Logo Image', 'simple-custom-login' ),
					'desc' => __( 'Upload a logo image (260x80px recommended) to go above the login form (optional)', 'simple-custom-login' ),
					'type' => 'image',
					'default' => ''
				),
			));

		$page->init();

	}

	function admin_menu() {
		add_options_page( __( 'Custom Login Settings', 'simple-custom-login' ), __('Simple Custom Login', 'simple-custom-login' ), 'delete_posts', 'options-custom-login', array($this->framework, 'render') );
	}

}