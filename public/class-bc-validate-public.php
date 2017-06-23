<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BC_Validate
 * @subpackage BC_Validate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    BC_Validate
 * @subpackage BC_Validate/public
 * @author     Your Name <email@example.com>
 */
class BC_Validate_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $bc_validate The ID of this plugin.
	 */
	private $bc_validate;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * @since 1.0.0
	 *
	 * @var array - list of email domians for bc instiutions
	 */
	private $bc_domains = array(
		'bccampus.ca',
		'bcit.ca',
		'camosun.ca',
		'camosun.bc.ca',
		'capilanou.ca',
		'cnc.bc.ca',
		'cotr.bc.ca',
		'douglascollege.ca',
		'ecuad.ca',
		'jibc.ca',
		'kpu.ca',
		'langara.bc.ca',
		'langara.ca',
		'nvit.bc.ca',
		'nic.bc.ca',
		'nlc.bc.ca',
		'nwcc.bc.ca',
		'okanagan.bc.ca',
		'royalroads.ca',
		'selkirk.ca',
		'sfu.ca',
		'tru.ca',
		'ubc.ca',
		'unbc.ca',
		'ufv.ca',
		'uvic.ca',
		'vcc.ca',
		'viu.ca',
		'yukoncollege.yk.ca',
	);
	private $bc_inst = array(
		""      => "-- Select Option --",
		"bcc"   => "BCcampus",
		"bcit"  => "BC Institute of Technology",
		"cam"   => "Camosun College",
		"capu"  => "Capilano University",
		"cnc"   => "College of New Caledonia",
		"cotr"  => "College of the Rockies",
		"dc"    => "Douglas College",
		"ecuad" => "Emily Carr University of Art and Design",
		"iig"   => "Institute of Indigenous Government",
		"jibc"  => "Justice Institute of B.C.",
		"kpu"   => "Kwantlen Polytechnic University",
		"lang"  => "Langara College",
		"nvit"  => "Nicola Valley Institute of Technology",
		"nic"   => "North Island College",
		"nlc"   => "Northern Lights College",
		"nwcc"  => "Northwest Community College",
		"okan"  => "Okanagan College",
		"rru"   => "Royal Roads University",
		"selk"  => "Selkirk College",
		"sfu"   => "Simon Fraser University",
		"tru"   => "Thompson Rivers University",
		"truo"  => "Thompson Rivers University - Open Learning",
		"ubc"   => "University of British Columbia",
		"unbc"  => "University of Northern British Columbia",
		"ufv"   => "University of the Fraser Valley",
		"uvic"  => "University of Victoria",
		"vcc"   => "Vancouver Community College",
		"viu"   => "Vancouver Island University",
		"yukc"  => "Yukon College"
	);

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string $bc_validate The name of the plugin.
	 * @var      string $version The version of this plugin.
	 */
	public function __construct( $bc_validate, $version ) {

		$this->bc_validate = $bc_validate;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BC_Validate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BC_Validate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//		wp_enqueue_style( $this->bc_validate, plugin_dir_url( __FILE__ ) . 'css/bc-validate-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BC_Validate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BC_Validate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//		wp_enqueue_script( $this->bc_validate, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Validates the user input and throws errors
	 *
	 * @param array $result
	 *
	 * @return type
	 */
	public function signupUserBC( $result ) {

		if ( isset( $_POST ) && 'validate-user-signup' != $_POST['stage'] ) {
			return $result;
		}

		$wp_error_email = $result['errors']->get_error_message( 'user_email' );

		// if WP finds an error with email
		if ( ! empty( $_POST['user_email'] ) && empty( $wp_error_email ) ) {
			$domain = $this->parseEmail( $_POST['user_email'] );
			$ok     = $this->checkDomain( $domain );

			if ( false == $ok ) {
				$result['errors']->add( 'user_email', 'Please use an email address from a post-secondary institution in British Columbia' );
			}
		}

		// check if they've indicated which bc institution they belong to
		if ( empty( $_POST['bc_inst'] ) ) {
			$result['errors']->add( 'bc_inst', 'Please indicate which BC institution you are currently employed with' );
		}

		// and now back to our regular programming
		return $result;
	}

	/**
	 * Parses an email address and returns the domain name
	 *
	 * @param string $email_address
	 *
	 * @return string
	 */
	private function parseEmail( $email_address ) {

		if ( empty( $email_address ) ) {
			return '';
		}
		//get rid of username
		$part = strstr( $email_address, '@' );

		// return everything but the @
		$domain = substr( $part, 1 );

		return $domain;
	}

	/**
	 * Compares the domain of the users email to a list of BC Institutional domains
	 *
	 * @param string $domain
	 *
	 * @return boolean
	 */
	private function checkDomain( $domain ) {

		if ( empty( $domain ) ) {
			return false;
		}

		if ( in_array( $domain, $this->bc_domains ) ) {
			return true;
		}

		// target subdomain, ex: geog.ubc.ca
		$parts = explode( '.', $domain );

		if ( count( $parts ) == 3 ) {
			$base_domain = $parts[1] . '.' . $parts[2];

			foreach ( $this->bc_domains as $inst ) {
				if ( false !== strpos( $inst, $base_domain ) ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Adds a dropdown list of BC Institutions to the signup form
	 *
	 * @param type $errors
	 */
	public function signupExtraBC( $errors ) {
		// Select list for BC Institutions
		$html = '<label for="bc_inst">' . __( 'BC Institution:' ) . '</label>';
		if ( $errmsg = $errors->get_error_message( 'bc_inst' ) ) {
			$html .= '<p class="error">' . $errmsg . '</p>';
		}
		$html .= '<p><select name="bc_inst" required="true">';

		foreach ( $this->bc_inst as $id => $val ) {
			$html .= "<option value='{$id}'>{$val}</option>";
		}
		$html .= '</select><br>'
		         . '(Must be a faculty member currently working at a post secondary institute in British Columbia)</p>';

		echo $html;
	}

	/**
	 *
	 * @param array $meta
	 *
	 * @return array
	 */
	public function signupMetaBC( $meta ) {
		if ( isset( $_POST['bc_inst'] ) ) {
			$add_meta = array(
				'bc_inst' => $_POST['bc_inst'],
			);
			$meta     = array_merge( $add_meta, $meta );
		}

		return $meta;
	}

	public function signupStyleBC() {

		$html = '<style type="text/css">
		.mu_register { width: 60%; margin:0 auto; }
		</style>';
		echo $html;
	}

}
