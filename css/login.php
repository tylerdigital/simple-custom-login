<?php
/* Check the settings page for an uploaded image */
$background_image_url = TDCustomLogin::get_option( 'background_image' );

/* If no image defined in settings, check for file */
if ( empty ( $background_image_url ) ) {
	$login_background = TDCustomLogin::get_instance()->login_background;
	if ( $login_background->background_file_exists() ) {
		$background_image_url = $login_background->background_location['url'];
	}
}
?>
<?php
/* Check the settings page for an uploaded image */
$logo_image_url = TDCustomLogin::get_option( 'login_logo' );

/* If no image defined in settings, check for file */
if ( empty( $logo_image_url ) ) {
	if ( TDCustomLogin::get_instance()->login_logo->logo_file_exists() ) {
		$logo_image_url = esc_url_raw( TDCustomLogin::get_instance()->login_logo->get_location( 'url' ) );
	}
}
?>

<style>
	body.login {
		background: url('<?php echo $background_image_url; ?>');
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		-moz-background-size:cover; 
		-webkit-background-size:cover;
		min-height: 450px;
		min-width: 40px;
	}
	.login h1 a {
		display: <?php echo ( empty( $logo_image_url ) ) ?  'none' : 'block'; ?>;
		background: url(<?php echo $logo_image_url; ?>) no-repeat top center;
		width: 255px;

		/* CWS Styles */
		margin-left: 8px;
		margin-bottom: 16px;
		background-size: contain;
		-o-background-size: contain;
		-webkit-background-size: contain;
		-khtml-background-size: contain;
		-moz-background-size: contain;
		-ms-background-size: contain;
	}
</style>
