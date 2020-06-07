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

        $username = '';
        $user_email = '';
        $user_password = '';
        $user_password_confirm = '';

        foreach($fields['form_fields'] as $field => $value):
            if($field == 'user_password') $user_password = $value;
            if($field == 'confirm-password') $user_password_confirm = $value;
        endforeach;

        if($user_password === $user_password_confirm):
         return true;
        else:
         return false;
        endif;

    }

}