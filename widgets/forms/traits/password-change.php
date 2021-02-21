<?php
namespace ElementalMembership\Widgets\Forms\Traits;

trait Password_Change{

    public function ajax_change_password(){
        add_action('wp_ajax_em_change_password', array($this, 'em_change_password'));
        add_action('wp_ajax_nopriv_em_change_password', array($this, 'em_change_password'));
    }

    /**
     * change user password
     *
     * @since 1.0.0
     *
     */
    public function em_change_password(){

        $errors = array();

        $current_password = '';
        $new_password = '';
        $new_password_confirm = '';

        if (isset($_POST['pwd_change_form_fields'])):
            foreach ($_POST['pwd_change_form_fields'] as $field => $value):

                switch ($field):
                    case 'current_password':
                        $current_password = sanitize_text_field($value);
                    break;
                    case 'new_password':
                        $new_password = sanitize_text_field($value);
                    break;
                    case 'new_password_confirm':
                        $new_password_confirm = sanitize_text_field($value);
                    break;
                endswitch;

            endforeach;
        endif;

        if(!wp_verify_nonce($_POST['em_change_password_nonce'], 'em_change_password')):
            $errors['invalid_nonce'] = __('Security token not valid', 'elemental-membership');
            wp_send_json_error($errors['invalid_nonce']);
            wp_die();
        endif;

        if($new_password !== $new_password_confirm):
            $errors['password_mismatch'] = __('Passwords don\'t match', 'elemental-membership');
            wp_send_json_error($errors['password_mismatch']);
            return;
        endif;

        $user = wp_get_current_user();
        $user_update = wp_update_user(array('ID' => $user->ID, 'user_pass' => $new_password));

        if(is_wp_error($user_update)):
            error_log($user_update->get_error_message());
        else:
            wp_set_auth_cookie($user->ID);
            wp_set_current_user($user->ID);
        endif;

    }

}