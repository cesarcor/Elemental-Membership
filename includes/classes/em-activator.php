<?php
// namespace ElementalMembership\Classes;

use ElementalMembership\Includes\Classes\Pages;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class EM_Activator{

    public static function activate(){

        require_once plugin_dir_path( __FILE__ ) . 'pages.php';

        $pages = new Pages();
        $pages->create_default_pages();

    }

}