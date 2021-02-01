<?php

namespace ElementalMembership\Widgets\Forms\Traits;

use Elementor\Plugin;

//Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

/**
 * 
 * User registration in WordPress for the Registration Form Widget
 *
 * @package ElementalMembership\Widgets\Forms\Traits
 */
trait Register_User {
    /**
     *
     * Executes user registration with Ajax
     *
     * @since 1.0.0
     * @access public
     */
    public function ajax_register_user() {
        add_action('wp_ajax_em_register_user', [$this, 'em_register_user']);
        add_action('wp_ajax_nopriv_em_register_user', [$this, 'em_register_user']);
    }

    /**
     *
     * Registers new users in Wordpress
     *
     * @since 1.0.0
     * @access public
     */
    public function em_register_user() {
        $page_id = $widget_id = 0;
        $user_role = '';

        $user_login = '';
        $user_password = '';
        $user_email = '';
        $first_name = '';
        $last_name = '';
        $user_bio = '';

        if (!empty($_POST['page_id'])):
            $page_id = intval($_POST['page_id'], 10);
        endif;

        if (!empty($_POST['widget_id'])):
            $widget_id = sanitize_text_field($_POST['widget_id']);
        endif;

        foreach ($_POST['form_fields'] as $field => $value):

            if (isset($field)):

                switch ($field):

                    case 'username':
                        $user_login = $value;
        break;
        case 'user_password':
                        $user_password = $value;
        break;
        case 'user_email':
                        $user_email = $value;
        break;
        case 'first_name':
                        $first_name = $value;
        break;
        case 'last_name':
                        $last_name = $value;
        break;
        case 'biographical_info':
            $user_bio = $value;
        default:

        endswitch;

        endif;

        endforeach;

        $settings = $this->em_get_widget_settings($page_id, $widget_id);

        if (!empty($settings)):
            $user_role = sanitize_text_field($settings['em_user_role']);
        endif;

        $userdata = [
            'user_login' => $user_login,
            'user_pass' => $user_password,
            'user_email' => $user_email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'description' => $user_bio,
            'role' => $user_role
        ];

        $user_id = wp_insert_user($userdata);

        if (is_wp_error($user_id)):
                error_log($user_id->get_error_message());
        var_dump($_POST);
        endif;

        var_dump($_POST);

        wp_die();
    }

}
