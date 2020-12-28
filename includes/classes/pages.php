<?php
namespace ElementalMembership\Includes\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * EM page related functions
 *
 * @since      1.0.0
 * @author     Cesar Correchel <https://github.com/cesarcor>
 */
class Pages {

    public function create_page($page_title, $slug){

        global $current_user;

        $page_args = array(
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_author'    => $current_user->ID,
            'post_name'      => $slug,
            'post_title'     => $page_title,
            'post_content'   => '',
            'post_parent'    => '',
            'comment_status' => 'closed',
        );

        $page_id = wp_insert_post( $page_args );

        if(is_wp_error($page_id)):
            error_log($page_id->get_error_message());
        endif;

    }

    public function create_default_pages(){

        $this->create_page(__('Register', 'elemental-membership'), 'register');
        $this->create_page(__('Login', 'elemental-membership'), 'login');
        $this->create_page(__('User Profile', 'elemental-membership'), 'profile');
        $this->create_page(__('Password Reset', 'elemental-membership'), 'password-reset');

    }

}