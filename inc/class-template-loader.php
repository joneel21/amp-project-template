<?php

class EXT_AMP_Post_Template {
    private $template_dir;

    public function __construct(){
         $this->template_dir =  EXT__AMP__DIR__ . '/template';   
    }

    public function load() {
		$this->load_parts( array( 'single' ) );
	}

    public function load_parts( $templates ) {
		foreach ( $templates as $template ) {
			$file = $this->get_template_path( $template );
			$this->verify_and_include( $file, $template );
		}
	}
    private function get_template_path( $template ) {
		return sprintf( '%s/%s.php', $this->template_dir, $template );
	}
    private function verify_and_include( $file, $template_type ) {
	
		if ( ! $this->is_valid_template( $file ) ) {
			_doing_it_wrong( __METHOD__, sprintf( __( 'Path validation for template (%s) failed. Path cannot traverse and must be located in `%s`.', 'ext_amp' ), esc_html( $file ), 'WP_CONTENT_DIR' ), '0.1' );
			return;
		}
		
		include( $file );
	}   

	private function is_valid_template( $template ) {
		if ( false !== strpos( $template, '..' ) ) {
			return false;
		}

		if ( false !== strpos( $template, './' ) ) {
			return false;
		}

		if ( ! file_exists( $template ) ) {
			return false;
		}

		return true;
	}
}
?>
