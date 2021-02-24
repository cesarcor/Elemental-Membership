<?php

namespace ElementalMembership\Widgets\Forms\Traits;

use Elementor\Plugin;

//Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

trait Password_Change {
    public function ajax_change_password() {
        add_action('wp_ajax_em_change_password', array($this, 'em_change_password'));
        add_action('wp_ajax_nopriv_em_change_password', array($this, 'em_change_password'));
    }

    /**
     * change user password
     *
     * @since 1.0.0
     *
     */
    public function em_change_password() {
        $errors = [];

        $current_password = '';
        $new_password = '';
        $new_password_confirm = '';

        $page_id = $widget_id = 0;

        if (!empty($_POST['page_id'])):
            $page_id = intval($_POST['page_id'], 10);
        endif;

        if (!empty($_POST['widget_id'])):
            $widget_id = sanitize_text_field($_POST['widget_id']);
        endif;

        $settings = $this->em_get_widget_settings_pc($page_id, $widget_id);

        if (isset($_POST['pwd_change_form_fields'])):
            foreach ($_POST['pwd_change_form_fields'] as $field => $value):

                switch ($field):
                    case 'current_password':
                        $current_password = $value;
                    break;
                    case 'new_password':
                        $new_password = $value;
                    break;
                    case 'new_password_confirm':
                        $new_password_confirm = $value;
                    break;
                endswitch;

            endforeach;
        endif;

        $user = wp_get_current_user();

        if (!wp_verify_nonce($_POST['em_change_password_nonce'], 'em_change_password')):
            $errors['invalid_nonce'] = __('Security token not valid, try refreshing', 'elemental-membership');
            wp_send_json_error($errors['invalid_nonce']);
            wp_die();
        endif;

        if ($new_password !== $new_password_confirm):
            $errors['password_mismatch'] = $settings['vm_passwords_mismatch'];
            wp_send_json_error($errors['password_mismatch']);
            return;
        endif;

        if (!wp_check_password($current_password, $user->user_pass, $user->ID)):
            $errors['password_incorrect'] = $settings['vm_current_pass'];
            wp_send_json_error($errors['password_incorrect']);
            return;
        endif;

        $user_update = wp_update_user(['ID' => $user->ID, 'user_pass' => $new_password]);

        if (is_wp_error($user_update)):
            $errors['wp_error'] = $user_update->get_error_message();
            wp_send_json_error($errors['wp_error']); 
        else:
            wp_send_json_success(__('Password successfully changed', 'elemental-membership'));
            wp_set_auth_cookie($user->ID);
            wp_set_current_user($user->ID);
        endif;
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
    function find_element_recursive_pc($elements, $form_id) {
        foreach ($elements as $element):
            if ($form_id === $element['id']):
                return $element;
        endif;

        if (!empty($element['elements'])):
                $element = $this->find_element_recursive_pc($element['elements'], $form_id);

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
    function em_get_widget_settings_pc($page_id, $widget_id) {
        $document = Plugin::$instance->documents->get($page_id);
        $settings = [];
        if ($document):
            $elements = Plugin::instance()->documents->get($page_id)->get_elements_data();
        $widget_data = $this->find_element_recursive_pc($elements, $widget_id);
        $widget = Plugin::instance()->elements_manager->create_element_instance($widget_data);
        if ($widget):
                $settings = $widget->get_settings_for_display();
        endif;
        endif;
        return $settings;
    }

}
