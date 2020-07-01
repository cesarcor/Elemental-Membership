<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Register_User{

    public function __construct(){
        add_action('wp_ajax_em_register_user', [$this, 'em_register_user']);
        add_action('wp_ajax_nopriv_em_register_user', [$this, 'em_register_user']);
    }

    public function em_validate_fields() {
        $validation = new Form_Validation();
        return $validation->validate_fields($_POST, 'registration');
    }

     /**
	 * EM Register User
	 *
	 * Register new user in Wordpress
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function em_register_user(){

        $validation_results = $this->em_validate_fields();

        if (!check_ajax_referer( 'em_reg_nonce' )):
            wp_die();
        endif;

        if(is_wp_error($validation_results)):

            $form_message = new Form_Message();
            
            $form_message->set_form_message($validation_results->get_error_message());

        else:

            $userdata = array(
                'user_login' => $validation_results['user_login'],
                'user_pass' => $validation_results['user_password'],
                'user_email' => $validation_results['user_email']
                // 'first_name' => $first_name,
                // 'last_name' => $last_name,
                // 'role' => $user_role,
            );

            wp_insert_user($userdata);

        endif;

        wp_die();

    }

}