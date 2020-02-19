<?php
namespace ElementalMembership;

use ElementalMembership\Admin;
use ElementalMembership\Widgets\Forms\Classes;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */

class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {

		wp_enqueue_script( 'em-js', EM_ASSETS . 'js/em.js', [ 'jquery' ], false, true );

		$translation_array = array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'em-js', 'em_ajax', $translation_array );

		wp_enqueue_script('em-js');

	}

	/**
	 * widget_editor_styles
	 *
	 * Load required plugin editor styles.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_editor_styles() {
		wp_enqueue_style(
			'em-icons',
			EM_ASSETS . 'icons/elemental-membership-icons/css/elemental-membership-icons.css',
			array()
		);
	}


	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/forms/widgets/registration-form.php' );
		require_once( __DIR__ . '/widgets/forms/widgets/login-form.php' );
		require_once( __DIR__ . '/widgets/logout/logout.php' );
		require_once( __DIR__ . '/widgets/profile-header/profile-header.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Forms\Registration_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Forms\Login_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Logout\Logout() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProfileHeader\Profile_Header() );
	}

	function add_elemental_membership_category($elements_manager){

		$elements_manager->add_category(
			'elemental-membership-category',
			[
				'title' => __('Elemental Membership', 'elemental-membership'),
				'icon' => 'fa fa-plug'
			]
		);
	
	}

	function autoload($classname){

		if(false === strpos( $classname, 'ElementalMembership' )){
			return;
		}

		$namespace = "";
		$file_parts = explode('\\', $classname);
		$file_name = "";

		for($i = count($file_parts) - 1; $i > 0; $i--){
			$current = strtolower($file_parts[$i]);
			$current = str_ireplace('_', '-', $current);

			if ( count( $file_parts ) - 1 === $i ) {

				$file_name = "$current.php";

			} else {
				$namespace = '/' . $current . $namespace;
			}

		}

		$filepath  = trailingslashit( dirname( dirname( __FILE__ ) ) . '/elemental-membership' . $namespace );
		$filepath .= $file_name;

		if ( file_exists( $filepath ) ) {
			include_once( $filepath );
		} else {
			wp_die(
				esc_html( "The file attempting to be loaded at $filepath does not exist." )
			);
		}

	}
	
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 0.0.1
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		add_action('elementor/editor/before_enqueue_scripts', function() {
			wp_enqueue_style('em-frontend', EM_ASSETS . 'css/em-frontend.css');
			wp_enqueue_script('em-frontend', EM_ASSETS . 'js/em-editor.js');
		});

		add_action('elementor/frontend/after_enqueue_styles', function() {
			wp_enqueue_style('em-frontend', EM_ASSETS . 'css/em-frontend.css');
		});

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Create EM membership
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elemental_membership_category'] );

		//Custom EM icons
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'widget_editor_styles' ), 10 );

		spl_autoload_register( array($this, 'autoload') );

		new Classes\Register_User();
		new Admin\Admin();
				
	}
}

Plugin::instance();
