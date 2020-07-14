<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Form_Validation {

    /**
	*
	* Validate submitted data
	*
	* @since 1.0.0
	* @access public
    */
    public function validate_fields($fields, $form_type){

        $errors = new \WP_Error();

        $user_login;
        $user_email;
        $user_password;
        $user_password_confirm;
        $first_name;
        $last_name;
        $biographical_info;
        $user_role = 'subscriber';

        $remember_me;

        $validated_fields = [];

        //Login form validation
        if($form_type == 'login'):

            foreach($fields as $field => $value):

                switch($field):
                    case "user_login":
                        $user_login = $value;
                    break;
                    case "user_login_pwd":
                        $user_password = $value;
                    case "user_remember_me":
                        $remember_me = $value == 'yes' ? true : false;
                    break;
                endswitch;
                
            endforeach;

        endif;

        //Registration form validation
        if($form_type == 'registration'):

            foreach($fields as $field => $value):

                switch($field):
                    case "username":
                        $user_login = $value;
                    break;
                    case "user_password":
                        $user_password = $value;
                    break;
                    case "user_email":
                        $user_email = $value;
                    break;
                    case "confirm-password":
                        $user_password_confirm = $value;
                endswitch;

            endforeach;

            if($user_password !== $user_password_confirm):
                $errors->add('password_match', __('Passwords do not match', 'elemental-membership'));           
            endif;

            if(!is_email($user_email)):
                $errors->add('not_email', __('Entered an invalid email', 'elemental-membership'));
            endif;

        endif;

        //General validation
        if (isset($user_login)):

            if(!validate_username($user_login)):
                $errors->add('invalid_username', __('The username is invalid', 'elemental-membership'));
            endif;

        endif;

        $validated_fields['user_login'] = $user_login;
        $validated_fields['user_email'] = $user_email;
        $validated_fields['user_password'] = $user_password;

        $error_code = $errors->get_error_code();
        if(!empty($error_code)):
            return $errors;
        endif;

        return $validated_fields;
    }

}