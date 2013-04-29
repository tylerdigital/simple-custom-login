<?php
$options = array();

$options[] = array( 'name' => __( 'General' ), 'type' => 'heading' );
$options[] = array( 'name' => __( 'Styling' ), 'type' => 'title', 'desc' => __( '' ) );
$options[] = array(
	'name' => __( 'Color scheme' ),
	'id'   => 'color_scheme',
	'type' => 'select',
	'tip' => 'Changes the button colors on the login screen',
	'options' => array(
		'' => 'Default (blue)',
		'red' => 'Red',
		'green' => 'Green',
	)
);