<?php
class TD_Login_Background_Plugin {
	static $instance;
	const CUTOFF = 255;
	var $background_locations;
	var $background_location;
	var $width = 0;
	var $height = 0;
	var $original_width;
	var $original_height;
	var $background_size;
	var $background_file_exists;

	public function __construct() {
		self::$instance = $this;
		add_action( 'login_head', array( $this, 'login_head' ) );
	}

	public function init() {
		global $blog_id;
		$this->background_locations = array();
		if ( is_multisite() && function_exists( 'get_current_site' ) ) {
			// First, see if there is one for this specific site (blog)
			$this->background_locations['site_jpg'] = array(
				'path' => WP_CONTENT_DIR . '/login-background-site-' . $blog_id . '.jpg',
				'url' => $this->maybe_ssl( content_url( 'login-background-site-' . $blog_id . '.jpg' ) ),
			);
			$this->background_locations['site_png'] = array(
				'path' => WP_CONTENT_DIR . '/login-background-site-' . $blog_id . '.png',
				'url' => $this->maybe_ssl( content_url( 'login-background-site-' . $blog_id . '.png' ) ),
			);

			// Next, we see if there is one for this specific network
			$site = get_current_site(); // Site = Network? Ugh.
			if ( $site && isset( $site->id ) ) {

				$this->background_locations['network_jpg'] = array(
					'path' => WP_CONTENT_DIR . '/login-background-network-' . $site->id . '.jpg',
					'url' => $this->maybe_ssl( content_url( 'login-background-network-' . $site->id . '.jpg' ) ),
					);
				$this->background_locations['network_png'] = array(
					'path' => WP_CONTENT_DIR . '/login-background-network-' . $site->id . '.png',
					'url' => $this->maybe_ssl( content_url( 'login-background-network-' . $site->id . '.png' ) ),
					);
			}
		}
		// Finally, we do a global lookup

		$this->background_locations['global_jpg'] =  array(
			'path' => WP_CONTENT_DIR . '/login-background.jpg',
			'url' => $this->maybe_ssl( content_url( 'login-background.jpg' ) ),
			);
		$this->background_locations['global_png'] =  array(
			'path' => WP_CONTENT_DIR . '/login-background.png',
			'url' => $this->maybe_ssl( content_url( 'login-background.png' ) ),
			);
	}

	private function maybe_ssl( $url ) {
		if ( is_ssl() )
			$url = preg_replace( '#^http://#', 'https://', $url );
		return $url;
	}

	public function background_file_exists() {
		if ( ! isset( $this->background_file_exists ) ) {
			foreach ( $this->background_locations as $location ) {
				if ( file_exists( $location['path'] ) ) {
					$this->background_file_exists = true;
					$this->background_location = $location;
					break;
				} else {
					$this->background_file_exists = false;
				}
			}
		}
		return !! $this->background_file_exists;
	}

	public function get_location( $what = '' ) {
		if ( $this->background_file_exists() ) {
			if ( 'path' == $what )
				return $this->background_location[$what];
			elseif ( 'url' == $what )
				return $this->background_location[$what] . '?v=' . filemtime( $this->background_location['path'] );
			else
				return $this->background_location;
		}
		return false;
	}

	private function get_width() {
		$this->get_background_size();
		return absint( $this->width );
	}

	private function get_height() {
		$this->get_background_size();
		return absint( $this->height );
	}

	private function get_original_width() {
		$this->get_background_size();
		return absint( $this->original_width );
	}

	private function get_original_height() {
		$this->get_background_size();
		return absint( $this->original_height );
	}

	private function get_background_size() {
		if ( !$this->background_file_exists() )
			return false;
		if ( !$this->background_size ) {
			if ( $sizes = getimagesize( $this->get_location( 'path' ) ) ) {
				$this->background_size = $sizes;
				$this->width  = $sizes[0];
				$this->height = $sizes[1];
				$this->original_height = $this->height;
				$this->original_width = $this->width;
				if ( $this->width > self::CUTOFF ) {
					// Use CSS 3 scaling
					$ratio = $this->height / $this->width;
					$this->height = ceil( $ratio * self::CUTOFF );
					$this->width = self::CUTOFF;
				}
			} else {
				$this->background_file_exists = false;
			}
		}
		return array( $this->width, $this->height );
	}

	private function css3( $rule, $value ) {
		foreach ( array( '', '-o-', '-webkit-', '-khtml-', '-moz-', '-ms-' ) as $prefix ) {
			echo $prefix . $rule . ': ' . $value . '; ';
		}
	}

	public function login_headerurl() {
		return esc_url( trailingslashit( get_bloginfo( 'url' ) ) );
	}

	public function login_headertitle() {
		return esc_attr( get_bloginfo( 'name' ) );
	}

	public function login_head() {
		$this->init();
	}

}
