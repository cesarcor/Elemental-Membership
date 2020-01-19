<?php

namespace ElementalMembership\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin {

    public function __construct(){
        add_action('admin_menu', array($this,'admin_menu'));
    }

    public function admin_menu(){

        add_menu_page(
            __('Elemental Membership', 'elemental-membership'),
            __('Elemental Membership', 'elemental-membership'),
            'manage_options',
            'elemental-membership',
            '',
            'dashicons-menu-alt',
            60
        );

    }

}
