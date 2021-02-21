<?php

namespace ElementalMembership\Widgets\Forms\Traits;

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
            $errors['password_mismatch'] = __('Passwords don\'t match', 'elemental-membership');
            wp_send_json_error($errors['password_mismatch']);
            return;
        endif;

        if (!wp_check_password($current_password, $user->user_pass, $user->ID)):
            $errors['password_incorrect'] = __('Current password is incorrect', 'elemental-membership');
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

}
