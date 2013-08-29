<?php
// $options = array();

// $options[] = array( 'name' => __( 'General' ), 'type' => 'heading' );
// $options[] = array( 'name' => __( 'Styling' ), 'type' => 'title', 'desc' => __( '' ) );
// $options[] = array(
// 	'name' => __( 'Color scheme' ),
// 	'id'   => 'color_scheme',
// 	'type' => 'select',
// 	'tip' => 'Changes the button colors on the login screen',
// 	'options' => array(
// 		'' => 'Default (blue)',
// 		'red' => 'Red',
// 		'green' => 'Green',
// 	)
// );

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

		//set the settings

		$page = $this->framework;

		$page->add_section('basic_section', __( 'Basic Settings' ) );

		$page->get_section('basic_section')->add_fields(array( //remember, we registered basic section earlier
				array(
					'name' => 'color_scheme',
					'label' => __( 'Color scheme' ),//you already know it from previous example
					'desc' => __( 'Changes the button colors on the login screen' ),// this is used as the description of the field
					'type' => 'select',
					'default' => '',
					'options' => array(
						'' => 'Default (blue)',
						'red' => 'Red',
						'green' => 'Green',
					)
				),

				array(
					'name' => 'background',
					'label' => __( 'Background'),
					'desc' => __( 'Upload a large image to use as the background of your login screen' ),
					'type' => 'image',
					'default' => ''
				)
			));

		$page->init();

	}

	function admin_menu() {
		add_options_page( 'TDCustomLogin_Settings', 'Custom Login', 'delete_posts', 'options-custom-login', array($this->framework, 'render') );
	}

}