<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/admin
 * @author     Hung Truong <admin@codesamples.info>
 */
class Wp_codesample_contact_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_admin_controller();
	}

	public function load_admin_controller() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/controllers/wp_codesample_contact_controller.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_codesample_contact_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_codesample_contact_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wp_codesample_contact-admin.css', array(), $this->version, false );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_codesample_contact_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_codesample_contact_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp_codesample_contact-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jquery-ui-sortable', false, array( 'jquery-ui-core', 'jquery' ) );
	}

	public function create_memu_admin()
	{
		add_menu_page(
			__('CS Contact','cs'),
			__('CS Contact','cs'),
			'administrator',
			'cs_contact',
			array('Wp_codesample_contact_controller', 'view_list_contact'), 
			'dashicons-email-alt',
			10
		);

		add_submenu_page( 
			'cs_contact',
			'Add New Contact Form',
			'Add New',
			'administrator',
			'add_cs_contact',
			array('Wp_codesample_contact_controller', 'view_add_new_contact'),
			''
		);

		add_submenu_page( 
			'cs_contact',
			'Setting CS Contact Form',
			'Setting',
			'administrator',
			'setting_cs_contact',
			array('Wp_codesample_contact_controller', 'view_setting_contact'),
			''
		);

		add_submenu_page( 
			'cs_contact',
			'Support & Documentation',
			'Support',
			'administrator',
			'support_cs_contact',
			array('Wp_codesample_contact_controller', 'view_support_contact'),
			''
		);
	}
}
