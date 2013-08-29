<?php $background_image_url = TDCustomLogin::get_option( 'background', plugins_url( 'img/loginbackground.jpg', dirname( __FILE__ ) ) ); ?>

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
</style>