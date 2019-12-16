<?php
namespace ElementalMembership;

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
		// wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * widget_editor_styles
	 *
	 * Load required plugin editor styles.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_editor_styles()
	{
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

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Create EM membership
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elemental_membership_category'] );

		//Custom EM icons
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'widget_editor_styles' ), 10 );

	}
}



// Instantiate Plugin Class
Plugin::instance();
