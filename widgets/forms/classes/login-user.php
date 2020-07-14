<?php
namespace ElementalMembership\Widgets\Forms\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Login_User{

    public function __construct(){
        add_action('wp_ajax_em_login_user', [$this, 'em_login_user']);
        add_action('wp_ajax_nopriv_em_login_user', [$this, 'em_login_user']);
    }

    private function validated_fields(){
        $validation = new Form_Validation();
        return $validation->validate_fields($_POST['login_fields'], 'login');
    }

    public function em_login_user(){

        if (!check_ajax_referer( 'em_login_nonce' )):
            wp_die();
        endif;

        $validation_results = $this->validated_fields();

        if(is_wp_error($validation_results)):
            error_log($validation_results->get_error_message());
        else:

            $user_login = wp_signon(
                array(
                    'user_login' => $validation_results['user_login'],
                    'user_password' => $validation_results['user_password'],
                    'remember' => false
                ),
                false
            );
    
            wp_redirect(home_url());
            exit();

        endif;

    }
}