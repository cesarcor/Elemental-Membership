<?php

namespace ElementalMembership\Widgets\Forms\Traits;

use Elementor\Plugin;
use ElementalMembership\Widgets\Forms\Classes\Ajax_Handler;

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
            'role' => $user_role,
        ];

        $user_id = wp_insert_user($userdata);

        if (is_wp_error($user_id)):
                error_log($user_id->get_error_message());
        var_dump($_POST);
        endif;

        var_dump($_POST);

        wp_die();
    }

    /**
     * Gets widget data
     * 
     *  @since 1.0.0
     *
     * @param array  $elements Element array.
     * @param string $form_id  Element ID.
     *
     */
    public function find_element_recursive($elements, $form_id) {
        foreach ($elements as $element):
            if ($form_id === $element['id']):
                return $element;
        endif;

        if (!empty($element['elements'])):
                $element = $this->find_element_recursive($element['elements'], $form_id);

        if ($element):
                    return $element;
        endif;
        endif;
        endforeach;

        return false;
    }

    /**
     *
     * Get form settings from EL.
     *
     * @since 1.0.0
     * @access public
     */
    public function em_get_widget_settings($page_id, $widget_id) {
        $document = Plugin::$instance->documents->get($page_id);
        $settings = [];
        if ($document):
            $elements = Plugin::instance()->documents->get($page_id)->get_elements_data();
        $widget_data = $this->find_element_recursive($elements, $widget_id);
        $widget = Plugin::instance()->elements_manager->create_element_instance($widget_data);
        if ($widget):
                $settings = $widget->get_settings_for_display();
        endif;
        endif;
        return $settings;
    }
}
