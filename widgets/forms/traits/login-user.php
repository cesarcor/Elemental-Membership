<?php

namespace ElementalMembership\Widgets\Forms\Traits;

use Elementor\Plugin;

trait Login_User {
    public function ajax_login_user() {
        add_action('wp_ajax_em_login_user', [$this, 'em_login_user']);
        add_action('wp_ajax_nopriv_em_login_user', [$this, 'em_login_user']);
    }

    /**
     *
     * User login
     *
     * @package ElementalMembership\Widgets\Forms\Traits
     */
    public function em_login_user() {

        $errors = array();

        $page_id = $widget_id = 0;

        $user_login = '';
        $user_password = '';
        $remember_me = '';

        $redirect_url = '';

        if (!wp_verify_nonce($_POST['em_login_nonce'], 'em_login_user')){
            $errors['invalid_nonce'] = __('Security token not valid, try refreshing', 'elemental-membership');
            wp_send_json_error($errors['invalid_nonce']);
            wp_die();
        }

        if (!empty($_POST['page_id'])){
            $page_id = intval($_POST['page_id'], 10);
        }

        if (!empty($_POST['widget_id'])){
            $widget_id = sanitize_text_field($_POST['widget_id']);
        }

        $settings = $this->em_get_login_widget_settings($page_id, $widget_id);

        if (!empty($settings)){
            $redirect_url = $settings['login_redirect_link']['url'];
        }

        if (isset($_POST['login_fields'])){
            foreach ($_POST['login_fields'] as $field => $value){
                switch ($field){
                    case 'user_login':
                        $user_login = sanitize_text_field($value);
                    break;
                    case 'user_login_pwd':
                        $user_password = $value;
                    break;
                    case 'user_remember_me':
                        $remember_me = $value == 'yes' ? true : false;
                    break;
                }
            }
        }

        $login_user = wp_signon(
            [
                'user_login' => $user_login,
                'user_password' => $user_password,
                'remember' => $remember_me
            ],
            true
        );

        if (is_wp_error($login_user)){
            wp_send_json_error($login_user->get_error_messages());
            return;
        }

        wp_send_json_success(!empty($redirect_url) ? ['form_redirect' => esc_url($redirect_url)] : ['form_redirect' => esc_url(home_url() . '/profile/' . $user_login)]);
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
    public function login_form_find_element_recursive($elements, $form_id) {
        foreach ($elements as $element){
            if ($form_id === $element['id']){
                return $element;
        }

        if (!empty($element['elements'])){
                $element = $this->login_form_find_element_recursive($element['elements'], $form_id);

        if ($element){
                    return $element;
        }
        }
        }

        return false;
    }

    /**
     *
     * Get form settings from EL.
     *
     * @since 1.0.0
     * @access public
     */
    public function em_get_login_widget_settings($page_id, $widget_id) {
        $document = Plugin::$instance->documents->get($page_id);
        $settings = [];
        if ($document){
            $elements = Plugin::instance()->documents->get($page_id)->get_elements_data();
        $widget_data = $this->login_form_find_element_recursive($elements, $widget_id);
        $widget = Plugin::instance()->elements_manager->create_element_instance($widget_data);
        if ($widget){
                $settings = $widget->get_settings_for_display();
        }
        }
        return $settings;
    }
}
