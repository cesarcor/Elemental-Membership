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
        if(!wp_verify_nonce($_POST['em_register_user_nonce'], 'em_register_user')):
            $errors['invalid_nonce'] = __('Security token not valid, try refreshing', 'elemental-membership');
            wp_send_json_error(wp_die($errors['invalid_nonce']));
        endif;
        
        $errors = array();

        $page_id = $widget_id = 0;

        $user_role = '';
        $user_login = '';
        $user_password = '';
        $user_password_confirm = '';
        $user_email = '';
        $first_name = '';
        $last_name = '';
        $user_description = '';
        $terms_accepted = '';

        if (!empty($_POST['page_id'])):
            $page_id = intval($_POST['page_id'], 10);
        endif;

        if (!empty($_POST['widget_id'])):
            $widget_id = sanitize_text_field($_POST['widget_id']);
        endif;

        $settings = $this->em_get_widget_settings($page_id, $widget_id);

        if (!empty($settings)):
            $user_role = sanitize_text_field($settings['em_user_role']);
        endif;

        foreach ($_POST['form_fields'] as $field => $value):

            if (isset($field)):

                switch ($field):

                    case 'username':
                        $user_login = sanitize_user($value);
                    break;
                    case 'user_password':
                                    $user_password = $value;
                    break;
                    case 'user_password_confirm':
                        $user_password_confirm = $value;
                    break;
                    case 'user_email':
                                    $user_email = sanitize_email($value);
                    break;
                    case 'first_name':
                                    $first_name = sanitize_text_field($value);
                    break;
                    case 'last_name':
                                    $last_name = sanitize_text_field($value);
                    break;
                    case 'user_description':
                        $user_description = sanitize_text_field($value);
                    break;
                    case 'accept_tnc':
                        $terms_accepted = $value;
                    endswitch;
                endif;

        endforeach;

        if($user_password !== $user_password_confirm):
            $errors['password_mismatch'] = $settings['vm_password_confirm'];
            wp_send_json_error(esc_html($errors['password_mismatch']));
            wp_die();
        endif;

        $tnc_enabled = $settings['show_tnc'];
        if('yes' === $tnc_enabled && !isset($_POST['form_fields']['accept_tnc'])):
            $errors['tnc_not_accepted'] = $settings['vm_tnc_acceptance'];
            wp_send_json_error(esc_html($errors['tnc_not_accepted']));
            wp_die();
        endif;

        $userdata = [
            'user_login' => $user_login,
            'user_pass' => $user_password,
            'user_email' => $user_email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'description' => $user_description,
            'role' => $user_role
        ];

        $user_id = wp_insert_user($userdata);

        if (is_wp_error($user_id)):
            $errors['wp_inser_user_error'] = $user_id->get_error_message();
            wp_send_json_error($errors['wp_inser_user_error']);
            return;
        endif;

        $login_user = wp_signon([
            'user_login' => $user_login,
            'user_password' => $user_password
        ],
        true);

        if(is_wp_error($login_user)):
            $errors['wp_login_error'] = $user_id->get_error_message();
            wp_send_json_error($errors['wp_login_error']);
            return;
        endif;

        wp_send_json_success(['form_redirect' => esc_url(home_url() . '/profile/' . $user_login)]);

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
    function find_element_recursive($elements, $form_id) {
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
    function em_get_widget_settings($page_id, $widget_id) {
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
