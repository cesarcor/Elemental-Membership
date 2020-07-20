<?php

namespace ElementalMembership\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin {

    public function __construct(){
        add_action('admin_menu', [$this,'em_admin_menu']);
    }

    public function em_admin_menu(){

        add_menu_page(
            __('Elemental Membership', 'elemental-membership'),
            __('Elemental Membership', 'elemental-membership'),
            'manage_options',
            'elemental-membership',
            [$this, 'em_settings_page'],
            'dashicons-menu-alt',
            60
        );

        add_submenu_page(
            'elemental-membership', 
            __('Settings', 'elemental-membership'), 
            __('Settings', 'elemental-membership'),
            'manage_options',
            'elemental-membership',
            [$this, 'em_settings_page']
        );

        add_submenu_page(
            'elemental-membership', 
            __('Get Help', 'elemental-membership'), 
            __('Get Help', 'elemental-membership'),
            'manage_options',
            'em-help',
            [$this, 'em_get_help_page']
        );
    
    }

    function em_settings_page(){
        include( EM_DIR_PATH . '/admin/templates/settings-temp.php' );
    }

    function em_get_help_page(){
    }

}
